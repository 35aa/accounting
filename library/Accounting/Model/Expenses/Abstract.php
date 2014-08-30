<?

abstract class Accounting_Model_Expenses_Abstract extends Zend_Db_Table_Row_Abstract {
	protected $_date;

	public function init() {
		//do not use _date in this condition
		if ($this->__isset('date') && $this->date) {
			$this->_date = new Zend_Date($this->date, Zend_Date::TIMESTAMP);
		}
	}

	public function formatDate() {
		return $this->_date->toString('dd/MM/yyyy');
	}

	public function formatAmount() {
		return Zend_Locale_Format::toNumber($this->getAmount(), array('precision' => 2));
	}

}
