<?

class Accounting_Model_Bank_Exchange extends Accounting_Model_Bank_Abstract {

	protected $_financeData;

	public function getRate() {
		return $this->rate > 1 ? Zend_Locale_Format::toNumber($this->rate, array('precision' => 2)).' to 1'
													: '1 to '.Zend_Locale_Format::toNumber(1/$this->rate, array('precision' => 2));
	}

	public function saveExchange(Accounting_Model_Member $member, $exchangeData) {
		$date = new Zend_Date($exchangeData['date'], 'dd/MM/yyyy');
		$date->subTime($date->getTime());
		$revenueTable = new Accounting_ModelTable_Revenues_Revenue();
		$revenue = $revenueTable->createNewRecord($member, $this->_getRevenueData($exchangeData));
		$expenseTable = new Accounting_ModelTable_Expenses_Expense();
		$expense = $expenseTable->createNewRecord($member, $this->_getExpensesData($exchangeData));

		$this->member_id = $member->id;
		$this->revenue_id = $revenue->id;
		$this->expense_id = $expense->id;
		$this->rate = $this->_getExpensesData($exchangeData)['amount'] / $this->_getRevenueData($exchangeData)['amount'];

		if (isset($exchangeData['description']) && ($exchangeData['description'] != '')) $this->description = $exchangeData['description'].' ('.$this->_buildExchangeDescription($this->_getExpensesData($exchangeData),$this->_getRevenueData($exchangeData)).')';
		else $this->description = $this->_buildExchangeDescription($this->_getExpensesData($exchangeData),$this->_getRevenueData($exchangeData));
		$this->date = $date->getTimestamp();
		$this->created = $_SERVER['REQUEST_TIME'];
		$this->save();
		return $this;
	}

	protected function _buildExchangeDescription($expenseData, $revenueData) {
		return 'Exchanged '.$expenseData['amount'].' '.$expenseData['currency'].' to '. $revenueData['amount'].' '.$revenueData['currency'].' with rate '.Zend_Locale_Format::toNumber($this->rate, array('precision' => 2)).' '.$expenseData['currency'].' to 1 '.$revenueData['currency'];
	}

	protected function _getRevenueData($exchangeData) {
		return array('date' 				 => $exchangeData['date'],
								 'amount' 			 => $exchangeData['amountTo'],
								 'currency' 		 => $exchangeData['currencyTo'],
								 'description' 	 => 'Exchanges: Sold '.$exchangeData['amountFrom'].' '.$exchangeData['currencyFrom']
								);
	}

	protected function _getExpensesData($exchangeData) {
		return array('date' 				 => $exchangeData['date'],
								 'amount' 			 => $exchangeData['amountFrom'],
								 'currency' 		 => $exchangeData['currencyFrom'],
								 'description' 	 => 'Exchanges: Bought '.$exchangeData['amountTo'].' '.$exchangeData['currencyTo']
								);
	}

}
