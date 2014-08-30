<?

class Accounting_ModelTable_Utilities_ProvidersView extends Zend_Db_Table_Abstract {
	protected $_name = 'view_utility_providers'; //use view but not table
	protected $_primary = 'id';

	public function getActiveProvidersForMember(Accounting_Model_Member $member) {
		$select = $this->select()->where('member_id = ?', $member->id)
														 ->where('active = 1');
		return $this->fetchAll($select);
	}

	public function getUtilityProvidersForMemberById(Accounting_Model_Member $member, $id) {
		
	}

}
