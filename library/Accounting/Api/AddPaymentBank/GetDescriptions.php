<?

class Accounting_Api_AddPaymentBank_GetDescriptions extends Accounting_Api_Abstract {

	//it suppose that we will always return 10 last entered descriptions (should return more ... I don't think so)
	const NUM_RECORDS_TO_RETURN = 10;

	public function processRequest() {
		$session = new Zend_Session_Namespace('accounting');
		$bankPaymentsTable = new Accounting_ModelTable_Bank_AccountActivity();
		$this->_response = array();
		foreach ($bankPaymentsTable->getLastEnteredDescriptions($session->member, self::NUM_RECORDS_TO_RETURN) as $bankPayment) {
//			if (!preg_match('/\d\)\.*$/', $bankPayment->description)) continue;
			//remove custom message
//			$this->_response[] = preg_replace('/\ \(.*?\d\)\.*$/', '', $exchange->description);
			$this->_response[] = $bankPayment->description;
		}
		return true;
	}

}
