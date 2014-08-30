<?

class Accounting_Model_Revenues_Revenue extends Accounting_Model_Revenues_Abstract {

	protected $_financeData;

	public function saveRevenue(Accounting_Model_Member $member, $revenueData) {
		$financesTable = new Accounting_ModelTable_Finances();
		$this->_financeData = $financesTable->saveFinance($member, $revenueData);
		$this->member_id = $member->id;
		$this->finance_id = $this->_financeData->id;
		$this->description = $revenueData['description'];
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

}
