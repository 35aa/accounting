<?

class Accounting_Form_Utilities_AddProvider extends Zend_Form {

	protected $_utilities;
	protected $_providers;

	public function __construct($options) {
		$this->_utilities = array();
		foreach ($options['utilities'] as $utility) {
			$this->_utilities[$utility->id] = $utility->name;
		}
		$this->_providers = array();
		foreach ($options['providers'] as $provider) {
			$this->_providers[$provider->id] = $provider->name;
		}

		parent::__construct();
	}

	public function init() {
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors',array('class' => 'alert alert-error form-alert')) ));

		$this->addAttribs(array('id' => 'provider','class' => 'no-margin')); //form Id
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/utilities/addProvider');

		$this->addElement('select', 'utility', array(
			'id' => 'utility',
			'validators' => array(array('InArray', true, array(array_keys($this->_utilities)))),
			'required' => true,
			'multiOptions' => array('' => '--- Select Utility ---') + $this->_utilities,
			'attribs' => array('class' => '') ));


		if (count($this->_providers)) {
			$this->addElement('select', 'providers', array(
				'id' => 'providers',
				'validators' => array(array('InArray', true, array(array_keys($this->_providers)))),
				'required' => true,
				'multiOptions' => array('' => '--- Select Provider ---') + $this->_providers,
				'attribs' => array('class' => '') ));
		}

		$this->addElement('text', 'name', array(
			'id' => 'name',
			'placeholder' => 'Name',
			'attribs' => array('size' => 10),
			'maxLength' => 32,
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 64)), ),
			'required' => true,
			'attribs' => array('class' => 'input') ));

		$this->addElement('textarea', 'description', array(
			'id' => 'description',
			'placeholder' => 'Description',
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(4, 128))),
			'required'   => true,
			'attribs' => array('class' => 'input','rows' => '4') ));

		$this->addElement('checkbox', 'active', array(
			'id' => 'active',
			'value' => 1,
			'filters' => array('StringTrim'),
			'attribs' => array('class' => 'no-margin') ));
/*
		$this->addElement('checkbox', 'addMeter', array(
			'id' => 'addMeter',
			'value' => 0,
			'filters' => array('StringTrim'),
			'attribs' => array('class' => 'no-margin',
												 'onClick' => "$('#meterForm').toggle();" ) ));

		$this->addElement('text', 'nameMeter', array(
			'id' => 'nameMeter',
			'placeholder' => 'Meter name',
			'attribs' => array('size' => 10),
			'maxLength' => 32,
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 32)), ),
			'required' => true,
			'attribs' => array('class' => 'input') ));

		$this->addElement('textarea', 'descriptionMeter', array(
			'id' => 'descriptionMeter',
			'placeholder' => 'Meter description',
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(4, 128))),
			'required'   => true,
			'attribs' => array('class' => 'input','rows' => '4') ));
*/
		$this->addElement('submit', 'Add', array('class' => 'btn'));
	}

	public function isValid($values) {
/*		$this->nameMeter->setRequired((bool) $values['addMeter']);
		$this->descriptionMeter->setRequired((bool) $values['addMeter']);
*/

		if (array_key_exists('providers', $values)) {
			$this->name->setRequired(!((bool) $values['providers']));
			$this->description->setRequired(!((bool) $values['providers']));
			$this->providers->setRequired((bool) $values['providers']);
		}

		return parent::isValid($values);
	}

}
