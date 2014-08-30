<?

class UtilitiesController extends Accounting_Controller_Action {

	public function preDispatch() {
		parent::preDispatch();
		$this->view->hasUtilities = true;
	}

	public function indexAction() {
		$session = new Zend_Session_Namespace('accounting');
		// $utilitiesProvidersView = new Accounting_ModelTable_Utilities_Payments();
		$utilitiesProvidersTable = new Accounting_ModelTable_Utilities_Payments();
		//here should be simple check if at least one utility defined
		//here also exists issue. When user remove all utilities without any payment - he could 
		//easily work through the all tabs. or if user go directly to any tab when no providers are set 
		//thi will not prevent from viewing unavailable tabs
		//think to move this anywhere else (common place)
		$this->view->hasUtilities = $utilitiesProvidersTable->getActiveProvidersForMember($session->member)->count() > 0;
		if ($this->view->hasUtilities) {
			return $this->_forward('viewPayments');
		}
		else {
			return $this->_forward('configure');
		}
	}

	public function viewpaymentsAction() {
		$session = new Zend_Session_Namespace('accounting');

		// get utilities list which are used in utility payment to form
		$utilitiesTable = new Accounting_ModelTable_Utilities();
		$utilitiesList = $utilitiesTable->getUtilitiesForMember($session->member);

		// get providers list to form
		$providersTable = new Accounting_ModelTable_Utilities_Providers();
		$providersList = $providersTable->getProvidersForMember($session->member);
		// set quick search form
		$this->view->form = new Accounting_Form_Utilities_UtilitiesPaymentHistory($utilitiesList, $providersList);
		$options = $this->getRequest()->getPost();
		if (!count($options)) $options = array('limit'=>10, 'offset'=>0);
		$this->view->form->isValid($options);

		$paymentsTable = new Accounting_ModelTable_Utilities_Payments();

		$this->view->totalCount = $paymentsTable->getUtilitiPaymentsHistoryMemberTotalRows($session->member, $this->view->form->getValues());
		$this->view->utilityPaymentsHistory = $paymentsTable->getUtilityPaymentsHistoryMember($session->member, $this->view->form->getValues());
	}

	public function addpaymentAction() {
		$session = new Zend_Session_Namespace('accounting');
		$utilitiesProvidersView = new Accounting_ModelTable_Utilities_ProvidersView();
		$this->view->form = new Accounting_Form_Utilities_AddPayment(array('utilityProviders' => $utilitiesProvidersView->getActiveProvidersForMember($session->member)));
	}

	public function addpaymentsubmitAction() {
		if (!$this->getRequest()->isPost()) $this->_forward('addpayment');
		$session = new Zend_Session_Namespace('accounting');
		$utilitiesProvidersView = new Accounting_ModelTable_Utilities_ProvidersView();
		$utilityProviders = $utilitiesProvidersView->getActiveProvidersForMember($session->member);
		$this->view->form = new Accounting_Form_Utilities_AddPayment(array('utilityProviders' => $utilityProviders));
		if (!$this->view->form->isValid($this->getRequest()->getPost())) $this->_forward('addpayment');
		$utilityPayment = new Accounting_ModelTable_Utilities_Payments();
		$utilityPayment->savePayment($session->member, $utilityProviders, $this->view->form->getValues());
		$this->view->__unset('form');
		$this->_forward('addPayment');
	}

	public function configureAction() {
		$utilitiesTable = new Accounting_ModelTable_Utilities();
		$providersView = new Accounting_ModelTable_Utilities_ProvidersView();
		$session = new Zend_Session_Namespace('accounting');
		$providersTable = new Accounting_ModelTable_Utilities_Providers();
		$this->view->providers = $providersView->getActiveProvidersForMember($session->member);
		//if form already present - use it 
		//TODO: may be need check class of the form to prevent specific errors when wrong form prepared or submitted
		// but it will be only dev things. Not sure it is needed
		if (!$this->view->form) {
			$this->view->form = new Accounting_Form_Utilities_AddProvider(array('utilities' => $utilitiesTable->getUtilities(),
																																				 'providers' => $providersTable->getProvidersForMember($session->member) ));
			$this->view->showForm = false;
		}
	}

	public function addproviderAction() {
		$session = new Zend_Session_Namespace('accounting');

		$utilitiesTable = new Accounting_ModelTable_Utilities();
		$providersTable = new Accounting_ModelTable_Utilities_Providers();
		$this->view->form = new Accounting_Form_Utilities_AddProvider(array('utilities' => $utilitiesTable->getUtilities(),
																																			 'providers' => $providersTable->getProvidersForMember($session->member) ));
		//not post - reloading view without any form submited
		if (!$this->getRequest()->isPost()) {
			$this->view->__unset('form');
			return $this->_forward('configure');
		}
		//form not valid - need to show error messages
		if (!$this->view->form->isValid($this->getRequest()->getPost())) {
			$this->view->showForm = true;
			return $this->_forward('configure');
		}
		//form valid - store rezult:
		//TODO: need to check selection (selected already created provider or new one)
		$providersTable = new Accounting_ModelTable_Utilities_Providers();
		$providersTable->addProviderForMember($session->member, $this->getRequest()->getPost());
		$this->view->__unset('form');
		$this->_forward('configure');
	}

	public function removeproviderreferenceAction() {
		if ($this->getRequest()->getParam('id') && ((int) $this->getRequest()->getParam('id'))) {
			$session = new Zend_Session_Namespace('accounting');
			$paymentsTable = new Accounting_ModelTable_Utilities_Payments();
			$utilitiesToProvidersTable = new Accounting_ModelTable_Utilities_ToUtilityProviders();

			$providerPayments = $paymentsTable->getPaymentByReferenceId($session->member, intval($this->getRequest()->getParam('id')));
			// Check if provider has any payment
			if ($providerPayments->count() > 0) {
				// If has 1 or more - mark it as non-active
				$data = $utilitiesToProvidersData = $utilitiesToProvidersTable->setInActiveProviderReferenceByIdForMember(intval($this->getRequest()->getParam('id')));
			}
			else {
				// If hasn't any payment - mark it as non-active and deleted
				$utilitiesToProvidersTable->removeProviderReferenceByIdForMember($session->member, intval($this->getRequest()->getParam('id')));
			}
		}
		$this->_forward('configure');
	}

}
