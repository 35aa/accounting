<?

class ExchangesController extends Accounting_Controller_Action {

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');

		$exchangesTable = new Accounting_ModelTable_Bank_Exchange();
		$this->view->exchangesHistory = $exchangesTable->getLastRecordsForMember($session->member);
		if (!$this->view->__isset('form') || !$this->getRequest()->isPost()) {
			$this->view->form = new Accounting_Form_Exchanges_Exchange();
		}
	}

	public function addsubmitAction() {
		$this->view->form = new Accounting_Form_Exchanges_Exchange();
		if ($this->getRequest()->isPost()
				&& $this->view->form->isValid($this->getRequest()->getPost())) {
			$session = new Zend_Session_Namespace('accounting');

			$exchageTable = new Accounting_ModelTable_Bank_Exchange();
			$exchageTable->createNewExchange($session->member, $this->getRequest()->getPost());
			$this->view->__unset('form');
			return $this->_redirect('exchanges');
		}
		$this->_forward('index');
	}

	public function historyAction() {
		$session = new Zend_Session_Namespace('accounting');

		$this->view->form = new Accounting_Form_Exchanges_ExchangeHistory();
		$options = $this->getRequest()->getPost();
		if (!count($options)) $options = array('limit'=>10, 'offset'=>0);
		$this->view->form->isValid($options);

		$expensesTable = new Accounting_ModelTable_Bank_Exchange();
		$this->view->totalCount = $expensesTable->getExchangesHistoryMemberTotalRows($session->member, $this->view->form->getValues());

		$this->view->exchangesHistory = $expensesTable->getExchangesHistoryMember($session->member, $this->view->form->getValues());
	}
}
