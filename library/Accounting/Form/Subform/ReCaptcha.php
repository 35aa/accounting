<?

class Accounting_Form_Subform_ReCaptcha extends Zend_Form_SubForm {

	public function init() {
		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		//render our form elements and the "form" tag
		$this->setDecorators(array('FormElements','Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('Description', 'Errors', 'Label', array(array('data'=>'HtmlTag'), array('tag'=>'p'))));

		$this->addElement('captcha', 'challenge', array(
			'label'						=> 'Captcha',
			'captcha' 				=> 'ReCaptcha',
			'captchaOptions' 	=> array('captcha' => 'ReCaptcha','service' => new Accounting_Service_ReCaptcha())));
	}
}
