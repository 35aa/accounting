<?

class Accounting_Form_Bank_CardAccount extends Zend_Form {

	public function init() {

		$currencies = array('UAH', 'USD', 'EUR', 'GPB');
		$cardTypes = array('Visa', 'MasterCard');
		$date = new Zend_Date();

		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors',array('class' => 'alert alert-error form-alert')) ));

		$this->addAttribs(array('id' => 'card_account','class' => 'no-margin')); //form Id
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/bank/addcardaccount');

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
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(4, 128))),
			'required'   => true,
			'attribs' => array('class' => 'input','rows' => '4') ));

		$this->addElement('text', 'bank_id', array(
			'id' => 'bank_id',
			'placeholder' => 'Bank name',
			'attribs' => array('size' => 10),
			'maxLength' => 32,
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 32)), ),
			'required' => true,
			'attribs' => array('class' => 'input') ));

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
			'multiOptions' => array_merge(array('' => 'Cur'), array_combine($currencies, $currencies)),
			'attribs' => array('class' => '','style'=>'width:111px') ));

		$this->addElement('select', 'card_type', array(
			'id' => 'card_type',
			'validators' => array(array('InArray', true, array($cardTypes))),
			'required' => true,
			'multiOptions' => array_merge(array('' => 'Type'), array_combine($cardTypes, $cardTypes)),
			'attribs' => array('class' => '','style'=>'width:111px') ));

		$this->addElement('text', 'card_trunk', array(
			'id' => 'card_trunk',
			'placeholder' => 'Card Trunk',
			'attribs' => array('size' => 4),
			'maxLength' => 4,
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(4, 4)),
														array('Int')),
			'required' => true,
			'attribs' => array('class' => 'input-small') ));

		$this->addElement('submit', 'Add', array('class' => 'btn'));
	}

}
