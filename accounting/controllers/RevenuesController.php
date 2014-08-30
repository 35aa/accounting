<?

class RevenuesController extends Accounting_Controller_Action {

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');

		$revenueTable = new Accounting_ModelTable_Revenues_Revenue();
		$this->view->revenueHistory = $revenueTable->getLastRecordsForMember($session->member);
		if (!$this->view->__isset('form') || !$this->getRequest()->isPost()) {
			$this->view->form = new Accounting_Form_Revenues_Add();
		}
	}

	public function addsubmitAction() {
		$this->view->form = new Accounting_Form_Revenues_Add();
		if ($this->getRequest()->isPost()
				&& $this->view->form->isValid($this->getRequest()->getPost())) {
			$session = new Zend_Session_Namespace('accounting');

			$revenueTable = new Accounting_ModelTable_Revenues_Revenue();
			$revenueTable->createNewRecord($session->member, $this->getRequest()->getPost());
			$this->view->__unset('form');
			return $this->_redirect('revenues');
		}
		$this->_forward('index');
	}

	public function historyAction() {
		$session = new Zend_Session_Namespace('accounting');

		$this->view->form = new Accounting_Form_Revenues_History();
		$options = $this->getRequest()->getPost();
		if (!count($options)) $options = array('limit'=>10, 'offset'=>0);
		$this->view->form->isValid($options);

		$revenueTable = new Accounting_ModelTable_Revenues_Revenue();
		$this->view->totalCount = $revenueTable->getRevenueHistoryMemberTotalRows($session->member, $this->view->form->getValues());
		$this->view->revenueHistory = $revenueTable->getRevenueHistoryMember($session->member, $this->view->form->getValues());
	}

}
