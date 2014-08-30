<?

class Accounting_Model_Member extends Zend_Db_Table_Row_Abstract {

	public function init() {
		//clear password for member storage
		$this->password = null;
	}

	public function generateMemberID() {
		if (!$this->id) {
			$this->id = md5(microtime());
		}
	}

	public function setVerified() {
		//we does not want to reset member's password - we could not use save method
		$where = $this->getTable()->getAdapter()->quoteInto('id = ?', $this->id);
		$this->getTable()->update(array('verified' => 1), $where);
	}

	public function getTable() {
		if (!$this->isConnected()) {
			$this->setTable(new Accounting_ModelTable_Members());
		}
		return parent::getTable();
	}

	public function hasPermission($permission) {
		return $this->isAdmin;
	}

	//prevent of storing/overriding members pass which is cleared out for session storage!!!!
	public function save() {}

	public function saveNewMember() {
		parent::save();
	}

	public function changePassword($password) {
		$where = $this->getTable()->getAdapter()->quoteInto('id = ?', $this->id);
		$this->getTable()->update(array('password' => md5($password)), $where);
		$resetTable = new Accounting_ModelTable_MembersReset();
		$where = $resetTable->getAdapter()->quoteInto('member_id = ?', $this->id);
		$resetTable->update(array('verified' => 1), $where);
	}

}
