<?

class Accounting_ModelTable_Bank_Account extends Accounting_ModelTable_Bank_Abstract {

	protected $_name = 'bank_accounts';
	protected $_rowClass = 'Accounting_Model_Bank_Account';

	//TODO Create methods for each accountType
	// rename this method to protected 'createNewAccount'
	public function createNewBankAccount(Accounting_Model_Member $member, $accountData) {
		$row = $this->createRow();
		return $row->saveBankAccount($member, $accountData);
	}

	public function getBankAccountsForMember(Accounting_Model_Member $member) {
		$select = $this->select()->where('member_id = ?', $member->id)
														 ->where('active = ?', 1)
														 ->order(array('id DESC'));
		return $this->fetchAll($select);
	}

	public function getBankAccountForMemberById(Accounting_Model_Member $member, $accountID) {
		$select = $this->select()->where('member_id = ?', $member->id)
														 ->where('id = ?', $accountID)
														 ->order(array('id DESC'));
		return $this->fetchRow($select);
	}

	public function getBankAccountById($accountID) {
		$select = $this->select()->where('id = ?', $accountID)
														 ->order(array('id DESC'));
		return $this->fetchRow($select);
	}

	public function getAccountByIdForMember(Accounting_Model_Member $member,$accountID) {
		return $this->fetchRow($this->select()->where('id = ?', $accountID)->where('member_id = ?', $member->id));
	}

	public function getAccountForMember(Accounting_Model_Member $member) {
		return $this->fetchAll($this->select()->where('member_id = ?', $member->id)->where('active = ?', 1));
	}

	public function getLastEnteredDescriptions(Accounting_Model_Member $member, $limit = 10) {
		$sql = $this->select()
								->where('member_id = ?', $member->id)
								->order('id DESC')->limit($limit);
		return $this->fetchAll($sql);
	}

}

