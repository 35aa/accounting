<?

class Accounting_Model_Bank_AccountActivity extends Accounting_Model_Bank_Abstract {

	protected $_financeData;
	protected $_bankData;
	protected $_bankAccountActivity;
	protected $_action;

	public function init() {
		parent::init();
		if ($this->finance_id) {
			$this->setAction($this->getBankAccountActivityAction());
		}
	}

	public function saveAccountActivity(Accounting_Model_Member $member, $activityData) {
		if (!$this->setAction($activityData['action'])) return false;
		$this->bank_account_id = $activityData['bank_account_id'];
		$this->date = $_SERVER['REQUEST_TIME'];
		$description = $this->_buildActivityDescription($activityData);
		if (isset($activityData['description']) && ($activityData['description'] != '')) $this->description = $activityData['description'].' ('.$description.')';
		else $this->description = $description;
		$activityData['description'] = $this->description;
		$paymentsTable = $this->getPaymentsTable();
		$paymentRecord = $paymentsTable->createNewRecord($member, $activityData);
		$this->_financeData = $paymentRecord->getFinance();
		$this->finance_id = $this->_financeData->id;

		$this->save();
		return $this;
	}

	/**
	 * Return an array from finances table
	 *
	 * array(id,member_id,amount,currency,date,created) 
	 */
	public function getFinanceData() {
		if (!$this->_financeData) {
			$financesTable = new Accounting_ModelTable_Finances();
			$this->_financeData = $financesTable->getFinanceDataById($this->finance_id);
		}
		return $this->_financeData;
	}

	public function getBankAccountName() {
		return $this->_bankAccount()->name;
	}

	public function getBankAccountType() {
		return $this->_bankAccount()->type;
	}

	public function getBankAccountActivityAction() {
// error_log($this->getFinanceData()->amount.' : '.($this->getFinanceData()->amount > 0 ? 'Out' : 'In'));
		return $this->getFinanceData()->amount > 0 ? 'Out' : 'In';
	}

	public function getActivityAmount() {
		//finances stored amount with inverse sign. Put it back
		return -$this->getFinanceData()->amount;
	}

	public function getBankAccountActivityAmount() {
		return $this->getFinanceData()->amount * $this->getSign();
	}

	public function getBankAccountActivityCurrency() {
		return $this->getFinanceData()->currency;
	}

	public function setAction($action) {
		if (in_array((string) $action, array(self::ACCOUNT_ACTION_IN, self::ACCOUNT_ACTION_OUT))) {
			$this->_action = $action;
			return true;
		}
		return false;
	}

	public function isActionIn() {
		return $this->_action == self::ACCOUNT_ACTION_IN;
	}

	public function isActionOut() {
		return !$this->isActionIn();
	}

	public function getSign() {
		return $this->isActionIn() ? -1 : 1;
	}

	public function getPaymentsTable() {
		switch (true) {
			case $this->isActionIn() :
				return new Accounting_ModelTable_Expenses_Expense();
				break;
			case $this->isActionOut() :
				return new Accounting_ModelTable_Revenues_Revenue();
				break;
		}
		return false;
	}

	/**
	 * Return an object from bank_accounts table
	 *
	 * object(id,member_id,name,type,description,bank_id,currency,active,created,deleted)
	 */
	protected function _bankAccount() {
		if (!$this->_bankData) {
			$bankTable = new Accounting_ModelTable_Bank_Account();
			$this->_bankData = $bankTable->getBankAccountById($this->bank_account_id);
		}
		return $this->_bankData;
	}

	protected function _buildActivityDescription($data) {
		return 'Payment: '.$this->getBankAccountName().', '.$data['amount'].', '.$data['currency'];
	}

}

