<?

class Accounting_Model_Goal_GoalsToFinances extends Zend_Db_Table_Row_Abstract {

	public function addCashToGoal(Accounting_Model_Member $member, $data) {
		// get goal info
		$goalTable = new Accounting_ModelTable_Goal_Goal();
		$goalInfo = $goalTable->getGoalForMemberById($member, $data['goal_id']);
		// add expenses
		$expensesTable = new Accounting_ModelTable_Expenses_Expense();
		$expensesData = array(
			'date' => $_SERVER['REQUEST_TIME'],
			'amount' => $data['amount'],
			'currency' => $goalInfo['currency'],
			'description' => 'Goal: '.$goalInfo['name'].', '.$data['amount'].''.$goalInfo['currency']
		);
		$addGoalCash = $expensesTable->createNewRecord($member, $expensesData);
		// create link finances to goals
		$this->goal_id = $data['goal_id'];
		$this->finance_id = $addGoalCash['finance_id'];
		$this->save();
		return $this;
	}

	public function deleteGoalToCashLink(Accounting_Model_Member $member) {
		$this->deleted = $_SERVER['REQUEST_TIME'];
		$this->save();
		return $this;
	}

}
