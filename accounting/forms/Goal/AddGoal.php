<?

class Accounting_Form_Goal_AddGoal extends Zend_Form {

	protected $_accounts;

	public function __construct($options) {
		$this->_accounts = array();
		foreach ($options['accounts'] as $account) {
			$this->_accounts[$account->id] = $account->name;
		}

		parent::__construct();
	}

	public function init() {

		$currencies = array('UAH', 'USD', 'EUR', 'GPB');
		$date = new Zend_Date();

		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors',array('class' => 'alert alert-error form-alert')) ));

		$this->addAttribs(array('id' => 'goal','class' => 'no-margin')); //form Id
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/goal/goaladdsubmit');

		$this->addElement('text', 'name', array(
			'id' => 'name',
			'placeholder' => 'Name',
			'attribs' => array('size' => 10),
			'maxLength' => 32,
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 32)), ),
			'required' => true,
			'attribs' => array('class' => 'input') ));

		$this->addElement('textarea', 'description', array(
			'id' => 'description',
			'placeholder' => 'Description',
			'filters'	=> array('StringTrim'),
			'validators' => array(array('StringLength', true, array(4, 128))),
			'required'   => true,
			'attribs' => array('class' => 'textarea-height100') ));

		$this->addElement('text', 'amount', array(
			'id' => 'amount',
			'placeholder' => 'Goal amount',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 10))),
			'required' => true,
			'attribs' => array('class' => 'input') ));

		$this->addElement('select', 'bank_account_id', array(
			'id' => 'bank_account_id',
//			'validators' => array(array('InArray', true, array(array_keys($this->_accounts)))),
			'required' => false,
			'multiOptions' => array('' => 'Cash') + $this->_accounts,
			'attribs' => array('class' => 'input-small', 'onChange' => "onChangeBankAccount()") ));

		$this->addElement('select', 'currency', array(
			'id' => 'goal_currency',
			'validators' => array(array('InArray', true, array($currencies))),
			'required' => false,
			'multiOptions' => array_merge(array('' => '---'), array_combine($currencies, $currencies)),
			'attribs' => array('class' => 'input-small') ));

		$this->addElement('text', 'end_date', array(
			'id' => 'date',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(9, 10))),
			'required' => true,
			'attribs' => array('class' => 'input datepicker'),
			'placeholder' => 'Expiration date' ));
			// 'value' => $date->toString('dd/MM/yyyy') ));

		$this->addElement('submit', 'Add', array('class' => 'btn'));
	}

}
