<?

class ExpensesController extends Accounting_Controller_Action {

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');

		$expensesTable = new Accounting_ModelTable_Expenses_Expense();
		$this->view->expensesHistory = $expensesTable->getLastRecordsForMember($session->member);
		if (!$this->view->__isset('form') || !$this->getRequest()->isPost()) {
			$this->view->form = new Accounting_Form_Expenses_Add();
		}
	}

	public function addsubmitAction() {
		$this->view->form = new Accounting_Form_Expenses_Add();
		if ($this->getRequest()->isPost()
				&& $this->view->form->isValid($this->getRequest()->getPost())) {
			$session = new Zend_Session_Namespace('accounting');

			$expensesTable = new Accounting_ModelTable_Expenses_Expense();
			$expensesTable->createNewRecord($session->member, $this->getRequest()->getPost());
			$this->view->__unset('form');
			return $this->_redirect('expenses');
		}
		$this->_forward('index');
	}

	public function historyAction() {
		$session = new Zend_Session_Namespace('accounting');

		$this->view->form = new Accounting_Form_Expenses_History();
		$options = $this->getRequest()->getPost();
		if (!count($options)) $options = array('limit'=>10, 'offset'=>0);
		$this->view->form->isValid($options);

		$expensesTable = new Accounting_ModelTable_Expenses_Expense();
		$this->view->totalCount = $expensesTable->getExpensesHistoryMemberTotalRows($session->member, $this->view->form->getValues());
		$this->view->expensesHistory = $expensesTable->getExpensesHistoryMember($session->member, $this->view->form->getValues());
	}

}
