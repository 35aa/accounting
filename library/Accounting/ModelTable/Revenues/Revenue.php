<?

class Accounting_ModelTable_Revenues_Revenue extends Accounting_ModelTable_Revenues_Abstract {
	protected $_name = 'revenues';
	protected $_rowClass = 'Accounting_Model_Revenues_Revenue';

	public function createNewRecord(Accounting_Model_Member $member, $revenueData) {
		$row = $this->createRow();
		return $row->saveRevenue($member, $revenueData);
	}

	public function getRevenueHistoryMember(Accounting_Model_Member $member, $options = array()) {
		if (!isset($options['offset']) || !$options['offset']) $options['offset'] = 0;
		if (!isset($options['limit']) || !$options['limit']) $options['limit'] = 10;

		$select = $this->_generateSelect($member, $options)
			->limit($options['limit'], $options['offset'])
			->order('date DESC');

		return $this->fetchAll($select);
	}

	public function getRevenueHistoryMemberTotalRows(Accounting_Model_Member $member, $options = array()) {
		// $select = $this->_generateSelect($member, $options)->from($this->_name, array('count(*) as totalRows'));
		$select = $this->select()->from($this->_name,array('count(*) as totalRows') );
		return $this->fetchRow($select)->totalRows;
	}
	
	protected function _generateSelect($member, $options) {
		$select = $this->select()->setIntegrityCheck(false)
														 ->from(array('r' => 'revenues'),array('id as revenueId','member_id','finance_id','description') )
														 ->joinLeft(array('f' => 'finances'),'r.finance_id = f.id',array('amount','currency','date') )
														 ->where('r.member_id = ?', $member->id);

		$dateObject = new Zend_Date();
		//may be here should be date object
		if (isset($options['dateFrom']) && $options['dateFrom']) {
			$dateObject->setDate($options['dateFrom'], 'dd/MM/yyyy');
			$dateObject->subTime($dateObject->getTime());
			$select->where('date >= ?', $dateObject->getTimestamp());
		}
		//may be here should be date object
		//this date should include last day
		if (isset($options['dateTo']) && $options['dateTo']) {
			$dateObject->setDate($options['dateTo'], 'dd/MM/yyyy');
			$dateObject->subTime($dateObject->getTime());
			$dateObject->addDay(1); //add 24 hours
			$dateObject->subSecond(1); // minus 1 second should get 23:59:59 of current date
			$select->where('date < ?', $dateObject->getTimestamp());
		}

		if (isset($options['currency']) && $options['currency']) {
			$select->where('currency = ?', $options['currency']);
		}

		if (isset($options['searchString']) && $options['searchString']) {
			$select->where('r.description like ?', '%'.$options['searchString'].'%');
		}
		
		return $select;
	}

}
