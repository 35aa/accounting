<?

abstract class Accounting_Model_Bank_Abstract extends Zend_Db_Table_Row_Abstract {

	const DATE_FORMAT = 'dd/MM/yyyy';
	const ACCOUNT_TYPE_ACCOUNT = 'Account';
	const ACCOUNT_TYPE_CREDIT = 'Credit';
	const ACCOUNT_TYPE_DEPOSIT = 'Deposit';
	const ACCOUNT_TYPE_CARD = 'Card';

	const ACCOUNT_ACTION_IN = 'In';
	const ACCOUNT_ACTION_OUT = 'Out';

	protected $_date;

	public function init() {
		//do not use _date in this condition
		if ($this->__isset('date') && $this->date) {
			$this->_date = new Zend_Date($this->date, Zend_Date::TIMESTAMP);
		}
	}

	//TODO this method should go to Accounting_Locale_Format class
	public function getFormattedDate() {
		$this->init();
		return $this->_date->toString(self::DATE_FORMAT);
	}

	//TODO replace everywhere in the code method 'formatDate' with 'getFormattedDate'
	// after this remove this method
	public function formatDate() {
		return $this->getFormattedDate();
	}

	//TODO this method should go to Accounting_Locale_Format class
	public function formatAmount() {
		return Zend_Locale_Format::toNumber($this->amount, array('precision' => 2));
	}

}
