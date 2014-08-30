<?

class Accounting_Model_Utilities_Payments extends Zend_Db_Table_Row_Abstract {

	protected $_financeData;
	protected $_utility_id_provider_id;

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

	public function getUtilityToUtilityProvider() {
		if (!$this->_utility_id_provider_id) {
			$utilitiesToUtilityTable = new Accounting_ModelTable_Utilities_ToUtilityProviders();
			$this->_utility_id_provider_id = $utilitiesToUtilityTable->getUtilityToUtilityProvider($this->utility_id_provider_id);
		}
		return $this->_utility_id_provider_id;
	}

	public function getPaymentUtilityName() {
		$utilitiesTable = new Accounting_ModelTable_Utilities();
		return $utilitiesTable->getUtilityById($this->getUtilityToUtilityProvider()->utility_id)->name;
	}

	public function getPaymentProviderName() {
		$providersTable = new Accounting_ModelTable_Utilities_Providers();
		return $providersTable->getProviderById($this->getUtilityToUtilityProvider()->utility_provider_id)->name;
	}

	public function getPaymentAmount() {
		if (!$this->_financeData) {
			$financesTable = new Accounting_ModelTable_Finances();
			$this->_financeData = $financesTable->getFinanceDataById($this->finance_id);
		}
		// return positive amount
		return Zend_Locale_Format::toNumber($this->_financeData->amount * -1, array('precision' => 2));
	}

	public function getPaymentCurrency() {
		if (!$this->_financeData) {
			$financesTable = new Accounting_ModelTable_Finances();
			$this->_financeData = $financesTable->getFinanceDataById($this->finance_id);
		}
		return $this->_financeData->currency;
	}

	public function getPaymentFromDate() {
		if ($this->period_from) {
			$date = new Zend_Date($this->period_from, Zend_Date::TIMESTAMP);
			return $date->toString('dd/MM/yyyy');
		}
		else return '-';
	}

	public function getPaymentToDate() {
		if ($this->period_to) {
			$date = new Zend_Date($this->period_to, Zend_Date::TIMESTAMP);
			return $date->toString('dd/MM/yyyy');
		}
		else return '-';
	}

}
