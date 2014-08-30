<?
// here should be implemented logic for restration procedure

class Accounting_Mail_SendVerify extends Zend_Mail {
	protected $_verifyCode;
	protected $_member;

	public function getVerifyCode() {
		return $this->_verifyCode;
	}

	public function setVerifyCode(Accounting_Model_MembersVerify $value) {
		$this->_verifyCode = $value;
	}

	public function getMember() {
		return $this->_member;
	}

	public function setMember(Accounting_Model_Member $value) {
		$this->_member = $value;
	}

	public function sendEmail() {

		$renderer = new Zend_View();
		$includePathOptions = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getApplication()->getOption('includePaths');
		$renderer->setScriptPath($includePathOptions['library'] . '/Accounting/Mail/Templates/');
		$renderer->assign('member', $this->getMember());
		$renderer->assign('verifyCode', $this->getVerifyCode());

		$mail = new Zend_Mail('UTF-8');
		$mail->setFrom('dontreplay@game.mydev.org.ua');
		$mail->setBodyHtml($renderer->render('VerifyCode.phtml'));
		$mail->addTo($this->getMember()->email, 'recipient');
		$mail->addBcc(array('zero.ukr@gmail.com', 'alex0germ@gmail.com'), 'recipient');
		$mail->setSubject('Реєстрація в грі 42');
		$mail->send();
	}
}
