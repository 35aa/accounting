<?
// here should be implemented logic for restration procedure

class Accounting_Mail_Error extends Zend_Mail {
	protected $_debug;
	protected $_session;
	protected $_host;
	protected $_request;

	public function getDebug() {
		return $this->_debug;
	}

	public function setDebug($value) {
		$this->_debug = $value;
	}

	public function getSession() {
		return $this->_session;
	}

	public function setSession($value) {
		$this->_session = $value;
	}

	public function getHost() {
		return $this->_host;
	}

	public function setHost($value) {
		$this->_host = $value;
	}

	public function getRequest() {
		return $this->_request;
	}

	public function setRequest($value) {
		$this->_request = $value;
	}

	public function sendEmail() {

		$renderer = new Zend_View();
		$includePathOptions = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getApplication()->getOption('includePaths');
		$renderer->setScriptPath($includePathOptions['library'] . '/Accounting/Mail/Templates/');
		$renderer->assign('debug', $this->getDebug());
		$renderer->assign('session', $this->getSession());
		$renderer->assign('host', $this->getHost());
		$renderer->assign('request', $this->getRequest());

		$mail = new Zend_Mail('UTF-8');
		$mail->setFrom('dontreplay@g44.mydev.org.ua');
		$mail->setBodyHtml($renderer->render('Error.phtml'));
		$mail->addTo(array('zero.ukr@gmail.com', 'alex0germ@gmail.com'), 'recipient');
		$mail->setSubject('Error occured for G44 progect.');
		$mail->send();
	}
}
