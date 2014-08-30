<?php

// here should be implemented all logic for login procedure
class HomeController extends Accounting_Controller_Action {

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');
		$financeTable = new Accounting_ModelTable_Finances();
		$this->view->cashBallance = $financeTable->getCashBallaceForMember($session->member);
		$bankTable = new Accounting_ModelTable_Bank_Account();
		$this->view->bankAccountsBallance = $bankTable->getBankAccountsForMember($session->member);
//error_log(print_r($this->view->bankAccountsBallance->toArray(),true));
	}

}

