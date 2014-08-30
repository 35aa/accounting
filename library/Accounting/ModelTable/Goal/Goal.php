<?

class Accounting_ModelTable_Goal_Goal extends Zend_Db_Table {

	protected $_name = 'goal';
	protected $_rowClass = 'Accounting_Model_Goal_Goal';

	protected $_bankAccountName;

	public function createNewGoalToMember(Accounting_Model_Member $member, $goalData) {
		$row = $this->createRow();
		return $row->saveGoal($member, $goalData);
	}

	public function getAllGoalsForMember(Accounting_Model_Member $member) {
		$select = $this->select()->where('member_id = ?', $member->id)
														 ->where('deleted is NULL')
														 ->order(array('id DESC'));
		return $this->fetchAll($select);
	}

	public function getGoalForMemberById(Accounting_Model_Member $member, $goalId) {
		$select = $this->select()->where('id = ?', $goalId)
														 ->where('deleted is NULL')
														 ->where('member_id = ?', $member->id);
		return $this->fetchRow($select);
	}

}

