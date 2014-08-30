<?

class Accounting_Form_Register_Verify extends Zend_Form {

	public function init() {
		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		//render our form elements and the "form" tag
		$this->setDecorators(array('FormElements','Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors', array('class' => 'alert alert-error form-alert')), 
																			array(array('data' => 'HtmlTag'), array('tag' => 'td')),
																			array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));

		$this->setName("member_verify"); //form name
		$this->setAction("/register/verifysubmit");
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->addElement('text', 'code', array(
			'placeholder' => 'Actiovation code',
			'filters'    => array('StringTrim', 'StringToLower'),
			'validators' => array(array('StringLength', false, array(0, 32))),
			'required'   => true ));

		$this->addElement('hidden', 'id', array(
			'filters'    => array('StringTrim', 'StringToLower'),
			'validators' => array(array('StringLength', false, array(0, 32))) ));

		$this->addElement('submit', 'Verify', array(
			'class'      => 'btn',
			'required'   => false,
			'ignore'     => true ));
	}
}
