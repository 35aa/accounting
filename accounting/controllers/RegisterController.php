<?
// here should be implemented logic for registration procedure

class RegisterController extends Zend_Controller_Action {

	# execute before every action
	public function preDispatch() {
		if (Accounting_Auth::getInstance()->hasIdentity()) return $this->_forward('index', 'home');
	}

	public function indexAction() {
		// Check if form is defined. If there are some errors in submitAction.
		if (!$this->view->__isset('form') || get_class($this->view->form) != 'Accounting_Form_Register_NewMember') {
			$session = new Zend_Session_Namespace('login');
			if (!is_numeric($session->loginTries)) {
				$session->loginTries = 0;
			}
			# Increment 'loginTries'
			$session->loginTries ++;
			$this->view->form = new Accounting_Form_Register_NewMember($session->loginTries);
		}
	}

	public function submitAction() {
		$session = new Zend_Session_Namespace('login');
		$this->view->form = new Accounting_Form_Register_NewMember($session->loginTries);
		// Check if request is POST
		if ($this->getRequest()->isPost()) {
			// Check if POST is valid
			$memberTable = new Accounting_ModelTable_Members();
			$error = array();
			//verify form data
			if (!$this->view->form->isValid($this->getRequest()->getPost())) $error[] = 'dataInvalid';
			//check that passwords match
			if (!count($error)
					&& $this->view->form->getValue('password') != $this->view->form->getValue('password_confirm')) $error[] = 'passwordsNotMatch';
			//check if email registered within other member (should check all records to prevent blocking of new user by Zend_Auth)
			if (!count($error)
					&& $memberTable->checkMembersWithEmail($this->view->form->getValue('email'))) $error[] = 'dataInvalid';
			if (!count($error)) {

				// Save member's data
				$newMember = $memberTable->saveNewMember($this->view->form->getValues());
				$newMember->password = null;
				// Here should be SendVerify
				$verifyTable = new Accounting_ModelTable_MembersVerify();
				$verifyCode = $verifyTable->saveNewVerify($newMember);
				// Send verify code to user email
				$sendVerify = new Accounting_Mail_SendVerify();
				$sendVerify->setVerifyCode($verifyCode);
				$sendVerify->setMember($newMember);
				$sendVerify->sendEmail();

				$session = new Zend_Session_Namespace('verify');
				$session->member = $newMember;
				$session = null;
				Zend_Session_Namespace::resetSingleInstance('verify');
				// identity object should be stored in session
				return $this->_forward('registersuccess');
			}
			else {
				$this->view->error = $error;
			}
		}
		// If POST is invalid or not POST goto indexAction
		$this->_forward('index');
	}

	public function registersuccessAction() {}

	public function verifyAction() {
		$session = new Zend_Session_Namespace('verify');
		$validator = new Accounting_Validate_Md5();
		switch (true) {
			case get_class($session->member) == 'Accounting_Model_Member':
				$member = $session->member;
				break;
			case $validator->isValid($this->getRequest()->getParam('id')):
				$memberTable = new Accounting_ModelTable_Members();
				$member = $memberTable->getMemberNotVerifiedById($this->getRequest()->getParam('id'));
				if (!$member) return $this->_forward('index');
				$session->member = $member;
				break;
			default:
				return $this->_forward('index');
		}
		$this->view->form = new Accounting_Form_Register_Verify();
		$this->view->form->populate(array('id' => $member->id));
	}

	public function verifysubmitAction() {
		$session = new Zend_Session_Namespace('verify');
		$this->view->form = new Accounting_Form_Register_Verify();
		$validator = new Accounting_Validate_Md5();
		switch (true) {
			case get_class($session->member) == 'Accounting_Model_Member':
				$member = $session->member;
				break;
			case $validator->isValid($this->getRequest()->getParam('id')):
				$memberTable = new Accounting_ModelTable_Members();
				$member = $memberTable->getMemberNotVerifiedById($this->getRequest()->getParam('id'));
				if (!$member) return $this->_forward('index');
				$session->member = $member;
				break;
			default:
				$this->_forward('index');
		}

		$request = array('id' => $member->id);
		if ($this->getRequest()->isPost()) {
			$request['code'] = $this->getRequest()->getPost('code');
		}
		else {
			$request['code'] = $this->getRequest()->getParam('code');
		}
		$this->view->form = new Accounting_Form_Register_Verify();
		// Check if request is POST
		if ($this->view->form->isValid($request)) {
			$membersVerifyTable = new Accounting_ModelTable_MembersVerify();
			if ($member_verify = $membersVerifyTable->checkCodeByMemberID($member, $this->view->form->getValue('code'))) {
				$member_verify->verified = $_SERVER['REQUEST_TIME'];
				$member_verify->save();
				$member->setVerified();
				$session = null;
				Zend_Session_Namespace::resetSingleInstance('verify');
				# Add start capital to user
				//$addStartCapital = new Accounting_ModelTable_MembersMoney();
				//$addStartCapital->addMemberTransfer($member, 'Start capital', '20000');
				# Register and Verify is successfull goto next view
				return $this->_forward('verifysuccess');
			}
		}
		$this->view->form = null;
		// If POST is invalid or not POST goto indexAction
		$this->_forward('index');
	}

	public function verifysuccessAction() {}
}
