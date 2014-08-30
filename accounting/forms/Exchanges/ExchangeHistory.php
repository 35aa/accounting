<?

class Accounting_Form_Exchanges_ExchangeHistory extends Accounting_Form_Revenues_History {

	public function init() {
		parent::init();
		$this->setAction('/exchanges/history');
	}
}
