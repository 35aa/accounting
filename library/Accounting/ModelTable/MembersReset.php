<?

class Accounting_ModelTable_MembersReset extends Zend_Db_Table_Abstract {
	protected $_name = 'members_password_reset';
	protected $_rowClass = 'Accounting_Model_MembersReset';

	public function saveNewReset($member) {
		$newReset= $this->createRow();

		$newReset->member_id = $member->id;
		$newReset->generateReset();
		$newReset->created = time();

		$newReset->save();
		return $newReset;
	}

	public function checkCodeByMemberID($memberID, $reset_key) {
		//get all non-verified within 2 hours since code was sent
		$select = $this->select()->where('verified IS NULL')->where('member_id = ?', $memberID)
														 ->where('password_reset = ?', $reset_key)->where('created > unix_timestamp() - 2*3600')->limit(1);
#error_log($select->__toString());
		return $this->fetchRow($select);
	}

}
