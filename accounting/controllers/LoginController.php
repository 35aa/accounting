<?php

// here should be implemented all logic for login procedure
class LoginController extends Zend_Controller_Action {
	public function preDispatch() {
		if (Accounting_Auth::getInstance()->hasIdentity()) return $this->_forward('index', 'home');
	}

	public function indexAction() {
		$session = new Zend_Session_Namespace('login');
		if (!is_numeric($session->loginTries)) {
			$session->loginTries = 0;
		}
		# Increment 'loginTries'
		$session->loginTries ++;
		$this->view->form = new Accounting_Form_Login($session->loginTries);
	}

	public function submitAction() {
		$session = new Zend_Session_Namespace('login');
		$form = new Accounting_Form_Login($session->loginTries);
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($this->getRequest()->getPost())
					&& Accounting_Auth::isAuthenticated($form->getValues())) {
				$this->view->isAuthenticated = true;
				$session->loginTries = 0;
				//identity object should be stored in session
				$memberTable = new Accounting_ModelTable_Members();
				$member = $memberTable->getMemberById(Accounting_Auth::getInstance()->getIdentity()->id);
				$session = new Zend_Session_Namespace('accounting');
				$session->member = $member;
				# this need to output member near logout button
				$this->view->member = $member;
				$this->_forward('home','index');
			}
		}
		$this->view->error = true;
		$this->_forward('index');
	}

	public function resetAction() {
		$session = new Zend_Session_Namespace('login');
		if (!$this->view->__isset('form') || !$this->getRequest()->isPost()) {
			$this->view->form = new Accounting_Form_Reset();
		}
	}

	public function resetsubmitAction() {
		$session = new Zend_Session_Namespace('login');
		$this->view->form = new Accounting_Form_Reset();
		if ($this->getRequest()->isPost()
				&& $this->view->form->isValid($this->getRequest()->getPost())) {
				# check if email exist
				$memberTable = new Accounting_ModelTable_Members();
				# store all member data to $member
				# if email exist go next, else go to resetAction
				if ($member = $memberTable->getMemberByEmail($this->view->form->getValue('email'))) {
					# generate password and activation link to send by email
					$resetTable = new Accounting_ModelTable_MembersReset();
					$resetCode = $resetTable->saveNewReset($member);
					// Send reset code to user email
					$sendReset = new Accounting_Mail_SendReset();
					$sendReset->setResetCode($resetCode);
					$sendReset->setMember($member);
					$sendReset->sendEmail();
					return $this->_forward('resetsubmitsuccess');
				}
		}
		$this->_forward('reset');
	}

	public function resetsubmitsuccessAction() {}

	public function resetmailsubmitAction() {
		$validator = new Accounting_Validate_Md5();
		# check if attributes valid (code and id)
		if ($this->getRequest()->getParam('id') && $validator->isValid($this->getRequest()->getParam('id'))) {
			$memberID = $this->getRequest()->getParam('id');
			$resetCode = $this->getRequest()->getParam('code');
			# check if memberID and resetCode exist
			$resetTable = new Accounting_ModelTable_MembersReset();
			if ($memberExist = $resetTable->checkCodeByMemberID($memberID,$resetCode)) {
				$this->view->form = new Accounting_Form_Changepassword();
				# set hidden value
				$this->view->form->populate(array('member_id' => $memberID));
			}
		}
	}

	public function resetmailsuccesssubmitAction() {
		$this->view->form = new Accounting_Form_Changepassword();
		if ($this->getRequest()->isPost()) {
			if ($this->view->form->isValid($this->getRequest()->getPost())) {
				# change password
				$memberTable = new Accounting_ModelTable_Members();
				$member = $memberTable->getMemberById($this->view->form->getValue('member_id'));
				$member->changePassword($this->view->form->getValue('password'));
			} else {
				# actually i don't understand why this present here ))
				$this->render('resetmailsubmit');
			}
		}
	}

}

