<?

class Accounting_Model_Bank_List extends Accounting_Model_Bank_Abstract {

	public function saveBank(Accounting_Model_Member $member, $bankData) {
		$this->member_id = $member->id;
		$this->name = $bankData;
		$this->created = $_SERVER['REQUEST_TIME'];
		$this->save();
		return $this;
	}

}
