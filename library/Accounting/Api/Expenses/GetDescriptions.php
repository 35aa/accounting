<?

class Accounting_Api_Expenses_GetDescriptions extends Accounting_Api_Abstract {
	
	//it suppose that we will always return 10 last entered descriptions (should return more ... I don't think so)
	const NUM_RECORDS_TO_RETURN = 10;

	public function processRequest() {
		$session = new Zend_Session_Namespace('accounting');
		$expensesTable = new Accounting_ModelTable_RevExp_Expenses();
		$this->_response = array();
		foreach ($expensesTable->getLastEnteredDescriptions($session->member, self::NUM_RECORDS_TO_RETURN) as $expense) {
			$this->_response[] = $expense->description;
		}
		return true;
	}

}
