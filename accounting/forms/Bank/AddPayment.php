<?

class Accounting_Form_Bank_AddPayment extends Zend_Form {

	protected $_accounts;

	public function __construct($options) {
		$this->_accounts = array();
		foreach ($options['accounts'] as $account) {
			$this->_accounts[$account->id] = $account->name;
		}

		parent::__construct();
	}

	public function init() {

		$actions = array('In', 'Out');
		$date = new Zend_Date();

		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors',array('class' => 'alert alert-error form-alert')) ));

		$this->addAttribs(array('id' => 'AddPaymentBank','class' => 'well')); //form Id
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/bank/addPaymentSubmit');

		$this->addElement('select', 'bank_account_id', array(
			'id' => 'bank_account_id',
//			'validators' => array(array('InArray', true, array(array_keys($this->_accounts)))),
			'required' => true,
			'multiOptions' => array('' => '---') + $this->_accounts,
			'attribs' => array('class' => 'input') ));

		$this->addElement('select', 'action', array(
			'id' => 'action',
			'validators' => array(array('InArray', true, array($actions))),
			'required' => true,
			'multiOptions' => array_merge(array('' => 'Select action'), array_combine($actions, $actions)),
			'attribs' => array('class' => 'input') ));

		$this->addElement('text', 'amount', array(
			'id' => 'amount',
			'placeholder' => 'Amount',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 10)),
														array('Float')),
			'required' => true,
			'attribs' => array('class' => 'input') ));

		$this->addElement('textarea', 'description', array(
			'id' => 'description',
			'placeholder' => 'Description',
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(4, 128))),
			'attribs' => array('class' => 'input','rows' => '4') ));

		$this->addElement('submit', 'Add', array('class' => 'btn'));
	}

	public function customCreditForm() {
		$this->action->removeMultiOption('');
		$this->action->removeMultiOption('Out');
	}
}
