<?

class Accounting_Form_Utilities_AddPayment extends Zend_Form {
	protected $_utilityProviders;

	public function __construct($options) {
		$this->_utilityProviders = array();
		foreach ($options['utilityProviders'] as $utilityProvider) {
			$this->_utilityProviders[$utilityProvider->reference_id] = $utilityProvider->utility_name . ' - ' . $utilityProvider->name;
		}

		parent::__construct();
	}

	public function init() {
		$currencies = array('UAH');

		//used to set by default date
		$date = new Zend_Date();
		$date->subDay($date->getDay()->subDay(1)); // day should be 1 not zero (if zero will switch to last day of prev month)

		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																	array('Errors',array('class' => 'alert alert-error form-alert')) ));

		$this->addAttribs(array('id' => 'formElement')); //form Id
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/utilities/addPaymentSubmit');

		$this->addElement('select', 'utilityProvider', array(
			'id' => 'utilityProvider',
			'validators' => array(array('InArray', true, array(array_keys($this->_utilityProviders)))),
			'required' => true,
			'multiOptions' => array('' => '---') + $this->_utilityProviders,
			'attribs' => array('class' => 'input-xxlarge') ));

		$this->addElement('text', 'amount', array(
			'id' => 'amount',
			'placeholder' => 'Amount',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 10)),
														array('Float')),
			'required' => true,
			'attribs' => array('class' => 'input-small') ));

		$this->addElement('select', 'currency', array(
			'id' => 'currency',
			'validators' => array(array('InArray', true, array($currencies))),
			'required' => true,
			'multiOptions' => array_merge(array(), array_combine($currencies, $currencies)),
			'attribs' => array('class' => 'input-small') ));

		$this->addElement('text', 'dateTo', array(
			'id' => 'dateTo',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(9, 10)),
														array('Regex', true, array('pattern' => '/\d\d\/\d\d\/\d\d\d\d/'))),
			'required' => true,
			'attribs' => array('class' => 'input-small datepicker'),
			'value' => $date->toString('dd/MM/yyyy') ));

		$this->addElement('text', 'dateFrom', array(
			'id' => 'dateFrom',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(9, 10)),
														array('Regex', true, array('pattern' => '/\d\d\/\d\d\/\d\d\d\d/'))),
			'required' => true,
			'attribs' => array('class' => 'input-small datepicker'),
			'value' => $date->subMonth(1)->toString('dd/MM/yyyy') ));

		$this->addElement('textarea', 'description', array(
			'id' => 'description',
			'placeholder' => 'Description',
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(4, 128))),
			'required'   => true,
			'attribs' => array('class' => 'input','rows' => '4') ));

		$this->addElement('submit', 'Add', array('class' => 'btn'));
	}

}
