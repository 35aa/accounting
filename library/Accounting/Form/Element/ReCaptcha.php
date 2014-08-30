<?

class Accounting_Form_Element_ReCaptcha extends Zend_Form_Element_Captcha {

	public function init() {
		$this->setCaptcha('ReCaptcha', array('captcha' => 'ReCaptcha','service' => new Accounting_Service_ReCaptcha()));
	}

}
