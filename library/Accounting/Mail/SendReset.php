<?
// here should be implemented logic for restration procedure

class Accounting_Mail_SendReset extends Zend_Mail {
	protected $_resetCode;
	protected $_member;

	public function getResetCode() {
		return $this->_password_reset;
	}

	public function setResetCode(Accounting_Model_MembersReset $value) {
		$this->_password_reset = $value;
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
		$renderer->assign('resetCode', $this->getResetCode());

		$mail = new Zend_Mail('UTF-8');
		$mail->setFrom('dontreplay@game.mydev.org.ua');
		$mail->setBodyHtml($renderer->render('ResetCode.phtml'));
		$mail->addTo($this->getMember()->email, 'recipient');
		$mail->addBcc(array('zero.ukr@gmail.com', 'alex0germ@gmail.com'), 'recipient');
		$mail->setSubject('Accounting::Password Reset');
		$mail->send();
	}
}
