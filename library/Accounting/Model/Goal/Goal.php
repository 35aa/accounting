<?

class Accounting_Model_Goal_Goal extends Zend_Db_Table_Row_Abstract {

	const CASH_BANK_ACCOUNT = 'Cash';

	protected $_bankAccount;
	protected $_bankAccountActivity;
	protected $_financeData;

	public function saveGoal(Accounting_Model_Member $member, $goalData) {
		$date = new Zend_Date($goalData['end_date'], 'dd/MM/yyyy');
		$date->subTime($date->getTime());

		$this->member_id = $member->id;
		$this->name = $goalData['name'];
		$this->description = $goalData['description'];
		$this->amount = $goalData['amount'];
		if (isset($goalData['currency']) && $goalData['currency'] != '') $this->currency = $goalData['currency'];
		// if bank account isset isBankAccount equals 1 else 0
		if (isset($goalData['bank_account_id']) && $goalData['bank_account_id'] != '') { $this->isBankAccount = 1; } else { $this->isBankAccount = 0; }
		$this->created = $_SERVER['REQUEST_TIME'];
		$this->end_date = $date->getTimestamp();
		$this->save();
		if (isset($goalData['bank_account_id']) && $goalData['bank_account_id'] != '') {
			// link goal table to bank_accounts
			$linkData = array('goal_id' => $this->id,'bank_account_id' => $goalData['bank_account_id']);
			$goalsToBankAccountsTable = new Accounting_ModelTable_Goal_GoalsToBankAccounts();
			$goalsToBankAccountsTable->createLinkGoalToBankAccount($member, $linkData);
		}
		return $this;
	}

	public function deleteGoal(Accounting_Model_Member $member) {
		// delete goal and link
		switch ($this->isBankAccount) {
			// remove goalWithCashLink
			case 0:
				$goalsToFinancesTable = new Accounting_ModelTable_Goal_GoalsToFinances();
				if (count($goalsToFinancesTable->getAllGoalsToFinances($this)) > 0) {
					// set revenue data
					$revenueData = array(
						'member_id' => $member->id,
						'description' => 'Goal: Close '.$this->name.' '.$this->getGoalCurrentAmount().', '.$this->currency,
						'date' => $_SERVER['REQUEST_TIME'],
						'amount' => $this->getGoalCurrentAmount(),
						'currency' => $this->currency,
					);
					// save money from closed goal as revenue
					$revenueTable = new Accounting_ModelTable_Revenues_Revenue();
					$revenueTable->createNewRecord($member, $revenueData);
					// delete goalToCash link
					foreach ($goalsToFinancesTable->getAllGoalsToFinances($this) as $goal) {
						$goal->deleteGoalToCashLink($member);
					}
				}
				// set goal as deleted
				$this->deleted = $_SERVER['REQUEST_TIME'];
				// save goal data
				$this->save();
				break;
			// remove goalWithBankAccountLink
			case 1:
				// set goal as deleted
				$goalsToBankAccountsTable = new Accounting_ModelTable_Goal_GoalsToBankAccounts();
				if ($goalsToBankAccountsTable->getAllGoalsToBankAccounts($this)->deleteGoalToBankAccountLink($member)) { 
					// set goal as deleted
					$this->deleted = $_SERVER['REQUEST_TIME'];
					// save goal data
					$this->save();
				}
				break;
			default:
				return false;
		}
		return $this;
	}

	public function getBankAccountsIds() {
		$bankAccountsIds = array();
		foreach ($this->getBankAccount() as $bankAccounts) {
			$bankAccountsIds[] = $bankAccounts->id;
		}
		return count($bankAccountsIds) > 0 ? implode(',', $bankAccountsIds) : self::CASH_BANK_ACCOUNT;
	}

	public function getBankAccountsNames() {
		$bankAccountsNames = array();
		foreach ($this->getBankAccount() as $bankAccounts) {
			$bankAccountsNames[] = $bankAccounts->name;
		}
		return count($bankAccountsNames) > 0 ? implode(',', $bankAccountsNames) : self::CASH_BANK_ACCOUNT;
	}

	public function getBankAccountsCurrency() {
		$bankAccountsCurrency = '';
		if ($this->getBankAccount()) {
			foreach ($this->getBankAccount() as $bankAccounts) {
				$bankAccountsCurrency = $bankAccounts->currency;
			}
			return $bankAccountsCurrency;
		} else {
			return $this->currency;
		}
		return false;
	}

	public function getBankAccount() {
		if (!$this->_bankAccount) {
			$goalsToBankAccountsTable = new Accounting_ModelTable_Goal_GoalsToBankAccounts();
			$this->_bankAccount = $goalsToBankAccountsTable->getAllBankAccounts($this);
		}
		return $this->_bankAccount;
	}

	public function getGoalDate() {
		if ($this->end_date) {
			$date = new Zend_Date($this->end_date, Zend_Date::TIMESTAMP);
			return $date->toString('dd/MM/yyyy');
		}
		else return '-';
	}

	// cash
	public function getFinanceData() {
		if (!$this->_financeData) {
			$goalsToFinancesTable = new Accounting_ModelTable_Goal_GoalsToFinances();
			$data = $goalsToFinancesTable->getAllGoalsToFinances($this);
			$financesTable = new Accounting_ModelTable_Finances();
			$this->_financeData = $financesTable->getFinanceDataByIds($data);
		}
		return $this->_financeData ? $this->_financeData : array();
	}

	// Alex, don't kick me hard because of this method :)
	public function getGoalCurrentAmount() {
		$amount = 0;
		if ($this->getBankAccount()) {
			// Count bank account total
			foreach ($this->getBankAccount() as $bankAccounts) {
				$bankAccountActivityTable = new Accounting_ModelTable_Bank_AccountActivity();
				$this->_bankAccountActivity = $bankAccountActivityTable->getActivityDataByAccout($bankAccounts);
				foreach ($this->_bankAccountActivity as $bankAccount) {
					$amount += $bankAccount->getActivityAmount();
				}
			}
		} else {
			foreach ($this->getFinanceData() as $finance) {
				$amount += $finance->getPositiveAmountForBankAccounts();
			}
		}
		return $amount;
	}

}
