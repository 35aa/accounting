<?

class Accounting_Model_Bank_Card extends Accounting_Model_Bank_Abstract {

	public function saveCardAccount($cardAccountData) {
		$this->bank_account_id = $cardAccountData['bank_account_id'];
		$this->card_type = $cardAccountData['card_type'];
		$this->card_trunk = $cardAccountData['card_trunk'];
		// add default 1 to active in table bank_accounts
		$this->created = $cardAccountData['created'];
		$this->save();
		return $this;
	}

}
