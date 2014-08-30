<?

class ApiController extends Accounting_Controller_Action {

	public function preDispatch() {
//		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
		if (!Accounting_Auth::getInstance()->hasIdentity()) return $this->_forward('error');
	}
	
	public function errorAction() {
		echo $this->_buildJsonResponse(array(), array('general request fail'));
	}

	public function loadbanknamesAction() {
		$session = new Zend_Session_Namespace('accounting');
		$bankAccountsTable = new Accounting_ModelTable_Bank_List();
		$data = array();
		foreach ($bankAccountsTable->getBanksForMember($session->member) as $bank) {
			$data[] = $bank->name;
		}
		echo $this->_buildJsonResponse($data, array());
	}
	
	protected function _buildJsonResponse($data, $error) {
		if (!($success = (int) (count($error) == 0))) {
			//error handling here
			$error = array('description'=>'Some strange error has occurred.');
			$data = 0;
		}
		else {
			$error = 0;
		}

		echo Zend_Json::encode(array('success'=>$success, 'error'=>$error, 'data'=>$data));
	}
}

