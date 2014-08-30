<?

class Accounting_ModelTable_Goal_GoalsToBankAccounts extends Zend_Db_Table {

	protected $_name = 'goals_to_bank_accounts';
	protected $_rowClass = 'Accounting_Model_Goal_GoalsToBankAccounts';

	public function createLinkGoalToBankAccount(Accounting_Model_Member $member, $data) {
		$row = $this->createRow();
		return $row->createLink($member, $data);
	}

	public function getAllGoalsToBankAccounts(Accounting_Model_Goal_Goal $goal) {
		$select = $this->select()->where('deleted is NULL')->where('goal_id = ?', $goal->id);
		return $this->fetchRow($select);
	}

	public function getAllBankAccounts(Accounting_Model_Goal_Goal $goal) {
		$select = $this->select()->where('deleted is NULL')->where('goal_id = ?', $goal->id);
		$bankAccounts = array();
		$bankAccountTable = new Accounting_ModelTable_Bank_Account();
		foreach ($this->fetchAll($select) as $goalBankAccount) {
			if ($bankAccount = $bankAccountTable->getBankAccountById($goalBankAccount->bank_account_id)) {
				$bankAccounts[] = $bankAccount;
			}
		}
		return $bankAccounts;
	}

}
