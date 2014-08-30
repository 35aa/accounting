<?

class Accounting_Form_Revenues_History extends Zend_Form {

	public function init() {

		$currencies = array('UAH', 'USD', 'EUR', 'GPB');

		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors',array('class' => 'alert alert-error form-alert')) ));

		$this->addAttribs(array('id' => 'history','class'=>'navbar-form pull-left no-margin')); //form Id
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/revenues/history');

		$this->addElement('hidden', 'limit', array(
			'id' => 'limit',
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 2)),
														array('Digits') ) ));

		$this->addElement('hidden', 'offset', array(
			'id' => 'offset',
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 4)),
														array('Digits') ) ));

		$this->addElement('select', 'currency', array(
			'id' => 'currency',
			'validators' => array(array('InArray', true, array($currencies))),
			'multiOptions' => array_merge(array('' => 'All'), array_combine($currencies, $currencies)),
			'attribs' => array('class' => 'input-small') ));

		$this->addElement('text', 'dateFrom', array(
			'id' => 'dateFrom',
			'placeholder' => 'Date from',
			'attribs' => array('size' => 10),
			'maxlength' => 10,
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(9, 10)),
														array('Regex', true, array('pattern' => '/\d\d\/\d\d\/\d\d\d\d/'))),
			'attribs' => array('class' => 'input-small datepicker') ));

		$this->addElement('text', 'dateTo', array(
			'id' => 'dateTo',
			'placeholder' => 'Date to',
			'attribs' => array('size' => 10),
			'maxlength' => 10,
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(9, 10)),
														array('Regex', true, array('pattern' => '/\d\d\/\d\d\/\d\d\d\d/'))),
			'attribs' => array('class' => 'input-small datepicker') ));

		$this->addElement('text', 'searchString', array(
			'id' => 'searchString',
			'placeholder' => 'Search',
			'attribs' => array('size' => 20),
			'maxlength' => 20,
			'filters' => array('StringTrim'),
			'attribs' => array('class' => 'search-query width140') ));

		$this->addElement('submit', 'Search', array('class' => 'btn'));
	}

}
