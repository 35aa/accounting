<?

class Accounting_Form_Register_NewMember extends Zend_Form {

	private $_loginTries;

	public function __construct($loginTries) {
		$this->_loginTries = $loginTries;
		parent::__construct();
	}

	public function init() {
		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors', array('class' => 'alert alert-error form-alert')), 
																			array(array('data' => 'HtmlTag'), array('tag' => 'td')),
																			array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));

		$this->setName("register"); //form name
		$this->setAction("/register/submit");
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post

		$this->addElement('text', 'nickname', array(
			'placeholder' => 'nickname',
			'filters'    => array('StringTrim', 'StringToLower'),
			'validators' => array(array('StringLength', false, array(3, 45))),
			'required'   => true ));

		$this->addElement('text', 'email', array(
			'placeholder' => 'email',
			'filters'    => array('StringTrim', 'StringToLower'),
			'validators' => array(array('StringLength', true, array(0, 96)), array('EmailAddress', true)),
			'required'   => true ));

		$this->addElement('password', 'password', array(
			'placeholder' => 'password',
			'filters'    => array('StringTrim'),
			'validators' => array(array('StringLength', false, array(8, 256))),
			'required'   => true ));

		$this->addElement('password', 'password_confirm', array(
			'placeholder' => 'repeat password',
			'filters'    => array('StringTrim'),
			'validators' => array(
														array('StringLength', false, array(8, 256)),
														array('Identical', false, array('token' => 'password')), ),
			'required'   => true, ));

		# add recaptcha to the form
		if ($this->_loginTries > 3) {
			$this->addElement('ReCaptcha', 'ReCaptcha');
			$this->ReCaptcha->removeDecorator('ViewHelper');
		}

		$this->addElement('submit', 'Register', array(
			'class'				=> 'btn',
			'required'   => false,
			'ignore'     => true, ));
	}
}
