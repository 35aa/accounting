<?

class Accounting_ModelTable_Finances extends Zend_Db_Table_Abstract {

	protected $_name = 'finances';
	protected $_rowClass = 'Accounting_Model_Finance';

	public function saveFinance(Accounting_Model_Member $member, $revenueData) {
		$row = $this->createRow();
		return $row->saveFinance($member, $revenueData);
	}

	public function getFinanceDataById($id) {
		return $this->fetchRow($this->select()->where('id =?', $id));
	}

	public function getFinanceDataByIds($ids) {
		if (!$ids->count()) return new Zend_Db_Table_Rowset(array());
		$select = $this->select();
		foreach ($ids as $idContainer) {
			$select->orWhere('id = ?', $idContainer->finance_id);
		}
		return $this->fetchAll($select);
	}

	public function getCashBallaceForMember(Accounting_Model_Member $member) {
		$select = $this->select()->from(array('f' => $this->_name),array('amount'=>'sum(f.amount)','f.currency'))
														 ->joinLeft(array('baa' => 'bank_accounts_activity'),'f.id = baa.finance_id',array())
														 ->where('f.member_id =?', $member->id)
														 ->group('f.currency');
// error_log($select->__toString());
		return $this->fetchAll($select);
	}

	public function getBankBallaceForMember(Accounting_Model_Member $member) {
		$select = $this->select()->from(array('f' => $this->_name),array('amount'=>'sum(f.amount)','f.currency'))
														 ->joinLeft(array('baa' => 'bank_accounts_activity'),'f.id = baa.finance_id',array())
														 ->where('f.member_id =?', $member->id)
														 ->where('baa.bank_account_id IS NOT NULL')
														 ->group('f.currency');
		return $this->fetchAll($select);
	}

}
