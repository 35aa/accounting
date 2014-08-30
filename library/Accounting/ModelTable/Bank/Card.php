<?

class Accounting_ModelTable_Bank_Card extends Accounting_ModelTable_Bank_Abstract {

	protected $_name = 'bank_card_accounts';
	protected $_rowClass = 'Accounting_Model_Bank_Card';

	public function addCardAccountForMember($cardAccountData) {
		$row = $this->createRow();
		return $row->saveCardAccount($cardAccountData);
	}

	public function getCreditCardByAccout(Accounting_Model_Bank_Account $bankAccount) {
		return $this->fetchRow($this->select()->where('bank_account_id = ?', $bankAccount->id));
	}

}

