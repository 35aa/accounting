<?php

class Accounting_Form_Login extends Zend_Form {

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
																			'Errors', 
																			array(array('data' => 'HtmlTag'), array('tag' => 'td')),
																			array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));

		$this->setName("login"); //form name
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/login/submit');

		$this->addElement('text', 'email', array(
			'id' => 'inputEmail',
			'placeholder' => 'Email',
			'filters' => array('StringTrim', 'StringToLower'),
			'validators' => array(array('StringLength', true, array(0, 50)),
														array('EmailAddress', true)),
			'required' => true ));

		$this->addElement('password', 'password', array(
			'id' => 'inputPassword',
			'placeholder' => 'Password',
			'filters'	=> array('StringTrim'),
			'validators' => array(array('StringLength', true, array(0, 50))),
			'required'   => true ));

		# add recaptcha to the form
		if ($this->_loginTries > 3) {
			$this->addElement('ReCaptcha', 'ReCaptcha');
			$this->ReCaptcha->removeDecorator('ViewHelper');
		}

		$this->addElement('submit', 'Login', array(
			'class' => 'btn',
			'required' => false,
			'ignore'   => true));
	}

}
