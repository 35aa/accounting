<?

class Accounting_ModelTable_Goal_GoalsToFinances extends Zend_Db_Table {

	protected $_name = 'goals_to_finances';
	protected $_rowClass = 'Accounting_Model_Goal_GoalsToFinances';

	public function addCashToGoal(Accounting_Model_Member $member, $data) {
		$row = $this->createRow();
		return $row->addCashToGoal($member, $data);
	}

	public function getAllGoalsToFinances(Accounting_Model_Goal_Goal $goal) {
		$select = $this->select()->where('deleted is NULL')->where('goal_id = ?', $goal->id);
		return $this->fetchAll($select);
	}

	public function getAllGoalToFinances(Accounting_Model_Goal_Goal $goal) {
		$select = $this->select()->where('deleted is NULL')->where('goal_id = ?', $goal->id);
		return $this->fetchRow($select);
	}

}
