<?

class Accounting_Form_Expenses_History extends Accounting_Form_Revenues_History {

	public function init() {
		parent::init();
		$this->setAction('/expenses/history');
	}
}
