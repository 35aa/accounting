<?

class Accounting_Form_Bank_PaymentHistory extends Accounting_Form_Revenues_History {

	protected $_accounts;

	public function __construct($options) {
		$this->_accounts = array();
		foreach ($options as $account) {
			$this->_accounts[$account->name] = $account->name;
		}

		parent::__construct($options);
	}

	public function init() {
		parent::init();
		$this->setAction('/bank/viewPayments');

		$actions = array('In', 'Out');

		$this->addElement('select', 'bank_action', array(
			'id' => 'bank_action',
			'validators' => array(array('InArray', true, array($actions))),
			'multiOptions' => array_merge(array('' => 'All'), array_combine($actions, $actions)),
			'attribs' => array('class' => 'input-small') ));

		$this->addElement('select', 'account_name', array(
			'id' => 'account_name',
//			'validators' => array(array('InArray', true, array($this->_accounts))),
//			'multiOptions' => array_merge(array('' => 'All'), array_combine($_accounts, $_accounts)),
			'multiOptions' => array('' => '---') + $this->_accounts,
			'attribs' => array('class' => 'input-small') ));
	}

}
