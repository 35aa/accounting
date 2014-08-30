<?

class Accounting_ModelTable_Members extends Zend_Db_Table_Abstract {
	protected $_name = 'members';
	protected $_rowClass = 'Accounting_Model_Member';

	public function saveNewMember($newMemberData) {
		$newMember = $this->createRow();

		$newMember->generateMemberID();
		$newMember->email = $newMemberData['email'];
		$newMember->password = md5($newMemberData['password']);
		$newMember->nickname = $newMemberData['nickname'];
		$newMember->created = time();

		$newMember->saveNewMember();
		return $newMember;
	}

	public function getMemberNotVerifiedById($memberID) {
		//get non-blocked member which should not be verified
		$select = $this->select()->where('deleted IS NULL')->where('blocked = 0')
														 ->where('verified = 0')->where('id = ?', $memberID)->limit(1);

		return $this->fetchRow($select);
	}

	public function getMemberById($memberID) {
		//get non-blocked member which should not be verified
		$select = $this->select()->where('deleted IS NULL')->where('blocked = 0')
														 ->where('verified = 1')->where('id = ?', $memberID)->limit(1);

		return $this->fetchRow($select);
	}

	public function getMemberByEmail($email) {
		//get non-blocked member which should not be verified
		$select = $this->select()->where('deleted IS NULL')->where('blocked = 0')
														 ->where('verified = 1')->where('email = ?', $email)->limit(1);

		return $this->fetchRow($select);
	}

	public function checkMembersWithEmail($email) {
		$select = $this->select()->where('email = ?', $email)->limit(1);
		return count($this->fetchAll($select)) > 0;
	}
}
