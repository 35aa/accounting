<?

class Accounting_Form_Expenses_Add extends Zend_Form {

	public function init() {

		$currencies = array('UAH', 'USD', 'EUR', 'GPB');
		$date = new Zend_Date();

		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors',array('class' => 'alert alert-error form-alert')) ));

		$this->addAttribs(array('id' => 'expenses','class' => 'well')); //form Id
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/expenses/addSubmit');

		$this->addElement('text', 'amount', array(
			'id' => 'amount',
			'placeholder' => 'Amount',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 10))),
			'required' => true,
			'attribs' => array('class' => 'input-small') ));

		$this->addElement('select', 'currency', array(
			'id' => 'currency',
			'validators' => array(array('InArray', true, array($currencies))),
			'required' => true,
			'multiOptions' => array_merge(array('' => '---'), array_combine($currencies, $currencies)),
			'attribs' => array('class' => '','style'=>'width:100px') ));

		$this->addElement('textarea', 'description', array(
			'id' => 'description',
			'placeholder' => 'Description',
			'filters'	=> array('StringTrim'),
			'validators' => array(array('StringLength', true, array(4, 128))),
			'required'   => true,
			'attribs' => array('class' => 'textarea-height100') ));

		$this->addElement('text', 'date', array(
			'id' => 'date',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(9, 10))),
			'required' => true,
			'attribs' => array('class' => 'input-small datepicker'),
			'value' => $date->toString('dd/MM/yyyy') ));

		$this->addElement('submit', 'Add', array('class' => 'btn'));
	}

}
