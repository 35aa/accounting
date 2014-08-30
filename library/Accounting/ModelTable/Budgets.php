<?

class Accounting_ModelTable_Budgets extends Zend_Db_Table_Abstract {
	protected $_name = 'budgets';
	protected $_rowClass = 'Accounting_Model_Budget';

	public function getActiveBudgetForMember(Accounting_Model_Member $member, $requestTime) {
		$select = $this->select()->where('start_time < ?', $requestTime)
									 ->where('end_time > ?', $requestTime)
									 ->where('member_id = ?', $member->id);
		return $this->fetchRow($select);
	}

	public function getBudgetsForMember(Accounting_Model_Member $member) {
		$select = $this->select()
									 ->where('member_id = ?', $member->id);
		return $this->fetchAll($select);
	}
}
