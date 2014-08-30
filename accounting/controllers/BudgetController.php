<?php

class BudgetController extends Accounting_Controller_Action {

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');
		$budgets = new Accounting_ModelTable_Budgets();
		//get current budget -> open it
		if ($budgets->getActiveBudgetForMember($session->member, $_SERVER['REQUEST_TIME'])) {
			$this->_forward('budgetStat');
		}
		//do we already have any budgets -> go to the list
		if ($budgets->getBudgetsForMember($session->member)->count()) {
			$this->_forward('budgetsList');
		}
		//open add budget
		$this->_forward('addBudget');
	}

	public function budgetstatAction() {
	}

	public function budgetlistAction() {
	}

	public function addbudgetAction() {
	}

}
