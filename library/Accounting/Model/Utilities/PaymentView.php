<?

class Accounting_Model_Utilities_PaymentView extends Zend_Db_Table_Row_Abstract {
	public function getDateFrom() {
		if ($this->period_from) {
			$date = new Zend_Date($this->period_from, Zend_Date::TIMESTAMP);
			return $date->toString('dd/MM/yyyy');
		}
		else return '-';
	}

	public function getDateTo() {
		if ($this->period_to) {
			$date = new Zend_Date($this->period_to, Zend_Date::TIMESTAMP);
			return $date->toString('dd/MM/yyyy');
		}
		else return '-';
	}

	public function formatAmount() {
		return Zend_Locale_Format::toNumber($this->amount, array('precision' => 2));
	}
}
