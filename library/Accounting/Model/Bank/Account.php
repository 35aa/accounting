<?

class Accounting_Model_Bank_Account extends Accounting_Model_Bank_Abstract {

	//TODO put this constants to abstract class
	const TYPE_CREDIT = 'Credit';
	const TYPE_DEPOSIT = 'Deposit';
	const TYPE_CARD = 'Card';
	const TYPE_ACCOUNT = 'Account';

	protected $_creditCard;
	protected $_bankAccountActivity;
	protected $_bank;

	public function saveBankAccount(Accounting_Model_Member $member, $accountData) {
		$this->member_id = $member->id;
		$this->name = $accountData['name'];
		$this->type = $accountData['type'];
		$this->description = $accountData['description'];
		// check if bank already exist in db
		$bankTable = new Accounting_ModelTable_Bank_List();
		$bankExist = $bankTable->getBankForMemberByName($member, $accountData['bank_id']);
		if (count($bankExist) > 0) {
			// Use exist bank id
			$this->bank_id = $bankExist->id;
		} else {
			// Create new bank and use new bank id
			$bankData = $bankTable->addBankForMember($member, $accountData['bank_id']);
			$this->bank_id = $bankData->id;
		}
		$this->currency = $accountData['currency'];
		// add default 1 to active in table bank_accounts
		$this->created = $_SERVER['REQUEST_TIME'];
		$this->save();
		// Variant for card
		if ($this->isCardAccount()) {
			$cardTable = new Accounting_ModelTable_Bank_Card();
			$cardData = $cardTable->addCardAccountForMember($this->_getCardAccountData($accountData));
		}
		// Initial payment
		$this->savePayment($member, $this->_getActivityData($accountData));
		// Return all account data
		return $this;
	}

	public function closeBankAccount(Accounting_Model_Member $member) {
		$this->savePayment($member, $this->_getCloseAccountData());
		$this->active = 0;
		$this->save();
		return $this;
	}

	public function savePayment(Accounting_Model_Member $member, $post) {
		$accountActivityTable = new Accounting_ModelTable_Bank_AccountActivity();
		$post['currency'] = $this->currency;
		$activityData = $accountActivityTable->addAccountActivityForMember($member, $post);
	}

	public function isAmountPositive() {
		return $this->getAmount() >= 0;
	}

	public function getCardType() {
		if ($this->type == self::TYPE_CARD) {
			return $this->_getCreditCardData()->card_type;
		}
		return null;
	}

	public function getCardTrunk() {
		if ($this->type == self::TYPE_CARD) {
			return $this->_getCreditCardData()->card_trunk;
		}
		return null;
	}

	public function getBankName() {
		return $this->_getBankData()->name;
	}

	public function getAmount() {
		$amount = 0;
		foreach ($this->_getBankAccountActivityData() as $row) {
			$amount += $row->getActivityAmount();
		}
		return $amount;
	}

	public function isCardAccount() {
		return $this->type == self::TYPE_CARD;
	}

	/**
	 * Return an object from bank_credit_card table
	 *
	 * object(id,bank_account_id,card_type,card_trunk,created)
	 */
	protected function _getCreditCardData() {
		if (!$this->_creditCard) {
			$cardAccountsTable = new Accounting_ModelTable_Bank_Card();
			$this->_creditCard = $cardAccountsTable->getCreditCardByAccout($this);
		}
		return $this->_creditCard;
	}

	/**
	 * Return an object from bank_list table
	 *
	 * object(id,member_id,name,created,deleted)
	 */
	protected function _getBankData() {
		if (!$this->_bank) {
			$bankListTable = new Accounting_ModelTable_Bank_List();
			$this->_bank = $bankListTable->getBankDataByAccout($this);
		}
		return $this->_bank;
	}

	/**
	 * Return an object from bank_accounts_activity table
	 *
	 * object(id,bank_account_id,finance_id,description,date)
	 */
	protected function _getBankAccountActivityData() {
		if (!$this->_bankAccountActivity) {
			$bankAccountActivityTable = new Accounting_ModelTable_Bank_AccountActivity();
			$this->_bankAccountActivity = $bankAccountActivityTable->getActivityDataByAccout($this);
		}
		return $this->_bankAccountActivity;
	}

	protected function _getCardAccountData($accountData) {
		return array('bank_account_id' => $this->id,
								 'card_type'			 => $accountData['card_type'],
								 'card_trunk'			 => $accountData['card_trunk'],
								 'created'				 => $_SERVER['REQUEST_TIME']);
	}

	protected function _getActivityData($accountData) {
		return array('bank_account_id' => $this->id,
									'action' 				 => $this->type == self::TYPE_CREDIT ? self::ACCOUNT_ACTION_OUT : self::ACCOUNT_ACTION_IN,// because it's initial payment
									'amount' 				 => $accountData['account_amount'],
									'currency' 			 => $this->currency,
									'description' 	 => 'Open '.$this->type,
									'date' 					 => $_SERVER['REQUEST_TIME']);
	}

	protected function _getCloseAccountData() {
		return array('amount' 				 => abs($this->getAmount()),
								 'action'					 => $this->isAmountPositive() ? self::ACCOUNT_ACTION_OUT : self::ACCOUNT_ACTION_IN,
								 'bank_account_id' => $this->id,
								 'type' 					 => $this->type,
								 'currency' 			 => $this->currency,
								 'date' 					 => $_SERVER['REQUEST_TIME'],
								 'description' 		 => 'Close bank account: '.$this->name.', '.$this->type.', '.$this->description);
	}

}
