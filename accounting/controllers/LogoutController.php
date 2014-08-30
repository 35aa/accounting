<?php

// here should be implemented all logic for login procedure
class LogoutController extends Zend_Controller_Action {

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');
		$session->unsetAll();
		Accounting_Auth::getInstance()->clearIdentity();
		$this->view->isAuthenticated = false;
		# this need to output member near logout button
		$this->view->member = null;
		return $this->_forward('index', 'index');
	}

}

