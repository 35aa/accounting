<?

class Accounting_ModelTable_Bank_Exchange extends Accounting_ModelTable_Bank_Abstract {

	protected $_name = 'exchanges';
	protected $_rowClass = 'Accounting_Model_Bank_Exchange';

	public function getLastRecordsForMember(Accounting_Model_Member $member, $limit = 10) {
		$select = $this->select()->where('member_id = ?', $member->id)
														 ->limit($limit)
														 ->order(array('date DESC','id DESC'));
		return $this->fetchAll($select);
	}

	// public function getLastEnteredDescriptions(Accounting_Model_Member $member, $limit = 10) {
	// 	return $this->fetchAll($this->select()->where('member_id = ?', $member->id)->order('id DESC')->limit($limit));
	// }

	public function createNewExchange(Accounting_Model_Member $member, $exchangeData) {
		$row = $this->createRow();
		return $row->saveExchange($member, $exchangeData);
	}


	// public function addExchangeForMember(Accounting_Model_Member $member, $exchangeData) {

	// 	$data = array(
	// 				'amount'=>$exchangeData['amountFrom'],
	// 				'currency'=>$exchangeData['currencyFrom'],
	// 				'date'=>$exchangeData['date'],
	// 				'description'=>'Exchanges: Bought '.$exchangeData['amountTo'].' '.$exchangeData['currencyTo']
	// 			);
	// 	# save sold data
	// 	$expensesTable = new Accounting_ModelTable_RevExp_Expenses();
	// 	$expenses = $expensesTable->addExpensesForMember($member, $data);

	// 	$data = array(
	// 				'amount'=>$exchangeData['amountTo'],
	// 				'currency'=>$exchangeData['currencyTo'],
	// 				'date'=>$exchangeData['date'],
	// 				'description'=>'Exchanges: Sold '.$exchangeData['amountFrom'].' '.$exchangeData['currencyFrom']
	// 			);
	// 	# save bought data
	// 	$revenueTable = new Accounting_ModelTable_RevExp_Revenue();
	// 	$revenue = $revenueTable->addRevenueForMember($member, $data);

	// 	# save exchange data to db
	// 	$date = new Zend_Date($exchangeData['date'], 'dd/MM/yyyy');
	// 	$date->subTime($date->getTime());
	// 	$exchange = $this->createRow();
	// 	$exchange->member_id = $member->id;
	// 	$exchange->revenue_id = $revenue->id;
	// 	$exchange->expense_id = $expenses->id;
	// 	$exchange->rate = $expenses->amount / $revenue->amount;

	// 	$description = 'Exchanged '.$expenses->amount.' '.$expenses->currency.' to '. $revenue->amount.' '.$revenue->currency.' with rate '.$exchange->rate.' '.$expenses->currency.' to 1 '.$revenue->currency;

	// 	if (isset($exchangeData['description']) && ($exchangeData['description'] != '')) {
	// 		$exchange->description = $exchangeData['description'].' ('.$description.')';
	// 	} else {
	// 		$exchange->description = $description;
	// 	}
	// 	$exchange->date = $date->getTimestamp();
	// 	$exchange->created = $_SERVER['REQUEST_TIME'];
	// 	$exchange->save();
	// }

	public function getExchangesHistoryMember(Accounting_Model_Member $member, $options = array()) {
		if (!isset($options['offset']) || !$options['offset']) $options['offset'] = 0;
		if (!isset($options['limit']) || !$options['limit']) $options['limit'] = 10;

		$select = $this->_generateSelect($member, $options)
														 ->limit($options['limit'], $options['offset']);

		return $this->fetchAll($select);
	}
	
	public function getExchangesHistoryMemberTotalRows(Accounting_Model_Member $member, $options = array()) {
		$select = $this->_generateSelect($member, $options)->from($this->_name, array('count(*) as totalRows'));
		return $this->fetchRow($select)->totalRows;
	}
	
	protected function _generateSelect($member, $options) {
		$select = $this->select()->where('member_id = ?', $member->id);

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
			$select->where('description like ?', '%'.$options['searchString'].'%');
		}
		
		return $select;
	}

}
