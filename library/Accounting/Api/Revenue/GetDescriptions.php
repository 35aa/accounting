<?

class Accounting_Api_Revenue_GetDescriptions extends Accounting_Api_Abstract {
	
	//it suppose that we will always return 10 last entered descriptions (should return more ... I don't think so)
	const NUM_RECORDS_TO_RETURN = 10;

	public function processRequest() {
		$session = new Zend_Session_Namespace('accounting');
		$revenueTable = new Accounting_ModelTable_RevExp_Revenue();
		$this->_response = array();
		foreach ($revenueTable->getLastEnteredDescriptions($session->member, self::NUM_RECORDS_TO_RETURN) as $revenue) {
			$this->_response[] = $revenue->description;
		}
		return true;
	}

}
