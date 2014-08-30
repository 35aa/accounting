<?

class BankController extends Accounting_Controller_Action {

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');
		// default open configure page when click on 'Bank'
		// return $this->_forward('configure');
		$accountActivityTable = new Accounting_ModelTable_Bank_AccountActivity();
		$this->view->hasBankPayments = $accountActivityTable->getBankAccountActivityHistoryMemberTotalRows($session->member);
		if ($this->view->hasBankPayments > 0) {
			return $this->_forward('viewPayments');
		}
		else {
			return $this->_forward('configure');
		}
	}

	public function configureAction() {
		$session = new Zend_Session_Namespace('accounting');
		$accountTable = new Accounting_ModelTable_Bank_Account();
		$this->view->bankData = $accountTable->getBankAccountsForMember($session->member);
		if (!$this->view->__isset('addAccountForm') || !$this->getRequest()->isPost()) {
			$this->view->addAccountForm = new Accounting_Form_Bank_AddAccount();
			$this->view->showForm = false;
		}
	}

	public function addaccountAction() {
		$this->view->addAccountForm = new Accounting_Form_Bank_AddAccount();
		if ($this->getRequest()->isPost()
				&& $this->view->addAccountForm->isValid($this->getRequest()->getPost())) {
			$session = new Zend_Session_Namespace('accounting');
			// Save account data
			$accountTable = new Accounting_ModelTable_Bank_Account();
			$accountData = $accountTable->createNewBankAccount($session->member, $this->getRequest()->getPost(),'Account');
			$this->view->__unset('addAccountForm');
			return $this->_redirect('bank/configure');
		}
		else {
			$this->view->showForm = true;
			return $this->_forward('index');
		}
		$this->_forward('index');
	}

	public function addpaymentsAction() {
		$session = new Zend_Session_Namespace('accounting');
		if (!$this->view->__isset('addPaymentForm') || !$this->getRequest()->isPost()) {
			$accountTable = new Accounting_ModelTable_Bank_Account();
			$this->view->addPaymentForm = new Accounting_Form_Bank_AddPayment(array('accounts' => $accountTable->getAccountForMember($session->member)));
			if ($this->getRequest()->getParam('id') && ((int) $this->getRequest()->getParam('id'))) {
				// Auto select bank account in select tag
				$this->view->addPaymentForm->populate(array('bank_account_id' => (int) $this->getRequest()->getParam('id') ));
				$bankAccountTable = new Accounting_ModelTable_Bank_Account();
				$bankAccountData = $bankAccountTable->getBankAccountForMemberById($session->member, $this->getRequest()->getParam('id'));
				// credit must have only IN option
				if ($bankAccountData->type == 'Credit') $this->view->addPaymentForm->customCreditForm();
			}
		}
	}

	public function addpaymentsubmitAction() {
		$session = new Zend_Session_Namespace('accounting');
		$accountTable = new Accounting_ModelTable_Bank_Account();
		$this->view->addPaymentForm = new Accounting_Form_Bank_AddPayment(array('accounts' => $accountTable->getAccountForMember($session->member)));
		if ($this->getRequest()->isPost()
				&& $this->view->addPaymentForm->isValid($this->getRequest()->getPost())) {
			$session = new Zend_Session_Namespace('accounting');
			$bankAccountTable = new Accounting_ModelTable_Bank_Account();
			if ($bankAccount = $bankAccountTable->getBankAccountForMemberById($session->member, $this->view->addPaymentForm->getValue('bank_account_id'))) {
				$bankAccount->savePayment($session->member, $this->view->addPaymentForm->getValues());
				return $this->_redirect('bank/viewPayments');
			}
		}
		$this->_forward('addPayments');
	}

	public function viewpaymentsAction() {
		$session = new Zend_Session_Namespace('accounting');
		$accountActivityTable = new Accounting_ModelTable_Bank_AccountActivity();
		$bankAccountTable = new Accounting_ModelTable_Bank_Account();
		$accountsData = $bankAccountTable->getBankAccountsForMember($session->member);
		$this->view->form = new Accounting_Form_Bank_PaymentHistory($accountsData);
		$options = $this->getRequest()->getPost();
		if (!count($options)) $options = array('limit'=>10, 'offset'=>0);
		$this->view->form->isValid($options);
		$this->view->totalCount = $accountActivityTable->getBankAccountActivityHistoryMemberTotalRows($session->member, $this->view->form->getValues());
		$this->view->paymentHistory = $accountActivityTable->getBankAccountActivityHistoryMember($session->member, $this->view->form->getValues());
	}

	public function closeaccountAction() {
		if ($this->getRequest()->getParam('id') && ((int) $this->getRequest()->getParam('id'))) {
			$session = new Zend_Session_Namespace('accounting');
			$bankAccountTable = new Accounting_ModelTable_Bank_Account();
			$bankAccountTable->getBankAccountForMemberById($session->member, $this->getRequest()->getParam('id'))->closeBankAccount($session->member);
			$this->_forward('configure');
		}
		$this->_forward('configure');
	}

}

