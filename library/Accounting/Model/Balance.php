<?

class Accounting_Model_Balance {

	protected $_member;

	public function __construct(Accounting_Model_Member $member) {
		$this->_member = $member;
	}

	public function getBalance() {
		# get revenue sum
		$revenueTable = new Accounting_ModelTable_Revenues_Revenue();
		$revenue = $revenueTable->getRevenueSumForMember($this->_member);
		# get expenses sum
		$expensesTable = new Accounting_ModelTable_Expenses_Expense();
		$expenses = $expensesTable->getExpensesSumForMember($this->_member);
		$balance = array();
		foreach(array_merge(array_keys($revenue),array_keys($expenses)) as $key) {
			$balance[$key] = array('amount'=>0,'currency'=>$key);
			if (isset($revenue[$key])) $balance[$key]['amount'] = $revenue[$key]['amount'];
			if (isset($expenses[$key])) $balance[$key]['amount'] -= $expenses[$key]['amount'];
		}
		return $ballance;
	}

	//TODO this method should not return array
	//probably this check should be made in other model class Account_Activity or finance
	public function checkBalance() {
		$getBalance = $this->getBalance();
		$negativeBalance = array();
		foreach($getBalance as $key => $value) {
			if($value['amount'] <= 0) {
				$negativeBalance[$key] = $value;
			}
		}
//error_log(print_r($negativeBalance,true));
		return $negativeBalance;
	}

}
