<?

class Accounting_Api_Exchanges_GetDescriptions extends Accounting_Api_Abstract {

	//it suppose that we will always return 10 last entered descriptions (should return more ... I don't think so)
	const NUM_RECORDS_TO_RETURN = 10;

	public function processRequest() {
		$session = new Zend_Session_Namespace('accounting');
		$exchangesTable = new Accounting_ModelTable_RevExp_Exchanges();
		$this->_response = array();
		foreach ($exchangesTable->getLastEnteredDescriptions($session->member, self::NUM_RECORDS_TO_RETURN) as $exchange) {
			if (!preg_match('/\d\)\.*$/', $exchange->description)) continue;
			//remove custom message
			$this->_response[] = preg_replace('/\ \(.*?\d\)\.*$/', '', $exchange->description);
		}
		return true;
	}

}
