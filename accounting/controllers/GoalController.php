<?php

class GoalController extends Accounting_Controller_Action {

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');
		// Output all goals
		$goalTable = new Accounting_ModelTable_Goal_Goal();
		$this->view->goalData = $goalTable->getAllGoalsForMember($session->member);
		if (!$this->view->__isset('form') || !$this->getRequest()->isPost()) {
			$accountTable = new Accounting_ModelTable_Bank_Account();
			$this->view->form = new Accounting_Form_Goal_AddGoal(array('accounts' => $accountTable->getAccountForMember($session->member)));
			$this->view->showForm = false;
		}
		if (!$this->view->__isset('addGoalCashForm') || !$this->getRequest()->isPost()) {
			$this->view->addGoalCashForm = new Accounting_Form_Goal_AddGoalCash();
		}
	}

	public function goaladdsubmitAction() {
		$session = new Zend_Session_Namespace('accounting');
		$accountTable = new Accounting_ModelTable_Bank_Account();
		$this->view->form = new Accounting_Form_Goal_AddGoal(array('accounts' => $accountTable->getAccountForMember($session->member)));
		if ($this->getRequest()->isPost()
				&& $this->view->form->isValid($this->getRequest()->getPost())) {
			$session = new Zend_Session_Namespace('accounting');
			// Save account data
			$goalTable = new Accounting_ModelTable_Goal_Goal();
			$goalData = $goalTable->createNewGoalToMember($session->member, $this->getRequest()->getPost());
			$this->view->__unset('form');
			return $this->_redirect('goal/index');
		}
		else {
			$this->view->showForm = true;
			return $this->_forward('index');
		}
		$this->_forward('index');
	}


	public function detailAction() {
		$session = new Zend_Session_Namespace('accounting');
		if ($this->getRequest()->getParam('id') && ((int) $this->getRequest()->getParam('id'))) {
			$goalTable = new Accounting_ModelTable_Goal_Goal();
			$this->view->goalData = $goalTable->getGoalForMemberById($session->member,$this->getRequest()->getParam('id'));
			if (!$this->view->__isset('addGoalCashForm') || !$this->getRequest()->isPost()) {
				$this->view->addGoalCashForm = new Accounting_Form_Goal_AddGoalCash();
			}
		}
	}

	public function addgoalcashAction() {
		$session = new Zend_Session_Namespace('accounting');
		$this->view->addGoalCashForm = new Accounting_Form_Goal_AddGoalCash();
		if ($this->getRequest()->isPost()
				&& $this->view->addGoalCashForm->isValid($this->getRequest()->getPost())) {
			$session = new Zend_Session_Namespace('accounting');
			$goalToFinancesTable = new Accounting_ModelTable_Goal_GoalsToFinances();
			$goalToFinancesTable->addCashToGoal($session->member, $this->getRequest()->getPost());
			return $this->_forward('index');
		}
		return $this->_forward('index');
	}

	public function deletegoalAction() {
		$session = new Zend_Session_Namespace('accounting');
		if ($this->getRequest()->getParam('id') && ((int) $this->getRequest()->getParam('id'))) {
			$goalTable = new Accounting_ModelTable_Goal_Goal();
			$goalTable->getGoalForMemberById($session->member,$this->getRequest()->getParam('id'))->deleteGoal($session->member);
			$this->_forward('index');
		}
		$this->_forward('index');
	}

}

