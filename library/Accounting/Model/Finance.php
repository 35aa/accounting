<?

class Accounting_Model_Finance extends Zend_Db_Table_Row_Abstract {

	public function saveFinance(Accounting_Model_Member $member, $data) {
		$date = new Zend_Date($data['date'], 'dd/MM/yyyy');
		$date->subTime($date->getTime());
		$this->member_id = $member->id;
		$this->amount = $data['amount'];
		$this->currency = $data['currency'];
		$this->date = $date->getTimestamp();
		$this->created = $_SERVER['REQUEST_TIME'];
		$this->save();
		return $this;
	}

	//TODO: replace method name with 'getInverseAmount'
	public function getPositiveAmountForBankAccounts() {
		return $this->amount * -1;
	}

	//TODO this method should go to Accounting_Locale_Format class
	public function formatAmount() {
		return Zend_Locale_Format::toNumber($this->amount, array('precision' => 2));
	}

}
