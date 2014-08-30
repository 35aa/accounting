<?

class Accounting_Model_Goal_GoalsToBankAccounts extends Zend_Db_Table_Row_Abstract {

	public function createLink(Accounting_Model_Member $member, $data) {
		$this->goal_id = $data['goal_id'];
		$this->bank_account_id = $data['bank_account_id'];
		$this->save();
	}

	public function deleteGoalToBankAccountLink(Accounting_Model_Member $member) {
		$this->deleted = $_SERVER['REQUEST_TIME'];
		$this->save();
		return $this;
	}

}
