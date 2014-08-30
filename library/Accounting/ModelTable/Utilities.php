<?

class Accounting_ModelTable_Utilities extends Zend_Db_Table_Abstract {
	protected $_name = 'utilities';

	public function getUtilities() {
		return $this->fetchAll($this->select());
	}

	public function getUtilityById($id) {
		$select = $this->select()->where('id = ?', $id);
		return $this->fetchRow($select);
	}

	public function getUtilitiesForMember (Accounting_Model_Member $member) {
		$select = $this->select()->from(array('u' => $this->_name) )
														->joinLeft(array('utup' => 'utilities_to_utility_providers'), 'u.id=utup.utility_id', array())
														->where('utup.member_id = ?', $member->id)
														->where('utup.deleted is null');
		return $this->fetchAll($select);
	}

}
