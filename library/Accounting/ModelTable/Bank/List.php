<?

class Accounting_ModelTable_Bank_List extends Accounting_ModelTable_Bank_Abstract {

	protected $_name = 'bank_list';
	protected $_rowClass = 'Accounting_Model_Bank_List';

	public function addBankForMember(Accounting_Model_Member $member, $bankData) {
		$row = $this->createRow();
		return $row->saveBank($member, $bankData);
	}

	public function getBankDataByAccout(Accounting_Model_Bank_Account $bankAccount) {
		return $this->fetchRow($this->select()->where('id = ?', $bankAccount->bank_id));
	}

	public function getBanksForMember(Accounting_Model_Member $member, $limit = 10) {
		return $this->fetchAll($this->select()->where('member_id = ?', $member->id)->where('DELETED IS NULL'));
	}

	public function getBankForMemberByName(Accounting_Model_Member $member, $bankName) {
		return $this->fetchRow($this->select()->where('member_id = ?', $member->id)
																					->where('name = ?', $bankName)
																					->where('DELETED IS NULL'));
	}

}

