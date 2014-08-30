<?

class Accounting_Model_Expenses_Expense extends Accounting_Model_Expenses_Abstract {

	protected $_financeData;

	public function saveExpense(Accounting_Model_Member $member, $expenseData) {
		$financesTable = new Accounting_ModelTable_Finances();
		// Expense amount must be negative in 'finances' tables
		$expenseData['amount'] = $expenseData['amount'] * -1;
		$this->_financeData = $financesTable->saveFinance($member, $expenseData);
		$this->member_id = $member->id;
		$this->finance_id = $this->_financeData->id;
		$this->description = $expenseData['description'];
		$this->created = $_SERVER['REQUEST_TIME'];
		$this->save();
		return $this;
	}

	public function getFinance() {
		if (!$this->_financeData) {
			$financeTable = new Accounting_ModelTable_Finances();
			$this->_financeData = $financesTable->getFinanceDataById($id);
		}
		return $this->_financeData;
	}

	public function getAmount() {
		return -$this->amount;
	}

}
