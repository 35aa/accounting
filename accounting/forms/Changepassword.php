<?

class Accounting_Form_Changepassword extends Zend_Form {

	public function init() {
		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors', array('class' => 'alert alert-error form-alert')), 
																			array(array('data' => 'HtmlTag'), array('tag' => 'td')),
																			array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));

		$this->setName("changepassword"); //form name
		$this->setAction("/login/resetmailsuccesssubmit");
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post

		$this->addElement('password', 'password', array(
			'placeholder' => 'Password',
			'filters'    => array('StringTrim'),
			'validators' => array(array('StringLength', false, array(8, 256))),
			'required'   => true ));

		$this->addElement('password', 'password_confirm', array(
			'placeholder' => 'Repeat password',
			'filters'    => array('StringTrim'),
			'validators' => array(
														array('StringLength', false, array(8, 256)),
														array('Identical', false, array('token' => 'password')), ),
			'required'   => true ));

		$this->addElement('hidden', 'member_id', array(
			'filters'    => array('StringTrim', 'StringToLower'),
			'validators' => array(array('StringLength', false, array(0, 32))) ));

		$this->addElement('submit', 'changepassword', array(
			'class' => 'btn',
			'required'   => false,
			'ignore'     => true,
			'label'      => 'Change my password!' ));
	}
}
