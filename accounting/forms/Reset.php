<?php

class Accounting_Form_Reset extends Zend_Form {

	public function init() {
		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		//render our form elements and the "form" tag
		$this->setDecorators(array('FormElements','Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors', array('class' => 'alert alert-error form-alert')), 
																			array(array('data' => 'HtmlTag'), array('tag' => 'td')),
																			array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));

		$this->setName("reset"); //form name
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/login/resetsubmit');
		$this->addElement('text', 'email', array(
			'placeholder' => 'Email',
			'filters' => array('StringTrim', 'StringToLower'),
			'validators' => array(array('StringLength', true, array(0, 50)),
														array('EmailAddress', true)),
			'required' => true ));

		# add recaptcha to the form
		$this->addElement('ReCaptcha', 'ReCaptcha');
		$this->ReCaptcha->removeDecorator('ViewHelper');

		$this->addElement('submit', 'Reset', array(
			'class'    => 'btn',
			'required' => false,
			'ignore'   => true ));
	}

}
