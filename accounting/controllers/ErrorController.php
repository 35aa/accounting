<?
class ErrorController extends Zend_Controller_Action {

	public function errorAction() {
		//log an error
		error_log(current($this->getResponse()->getException())->__toString());
		if (APPLICATION_ENV == 'devel' || APPLICATION_ENV == 'test') {
			$this->view->error_message = print_r(current($this->getResponse()->getException())->__toString(),true);
		}
		//send error via email to developers.
		//TODO: add email notification here!!!
		switch (get_class(current($this->getResponse()->getException()))) {
			case 'Zend_Controller_Dispatcher_Exception':
			case 'Zend_Controller_Action_Exception':
				return $this->_forward('error404');
				break;
			default:
				//for now dump error to the output
				//html tags should not be here
				//only developers and QA should see errors
				$this->view->friendly_error_message = "Hello.\nUnexpected error occured in the system.\nPlease return on main page and try again.\n\n If error appeared again at the same place please, retry later. Support team is notified and working on this problem.\n\n Thank You for understanding.";
				break;
		}
	}

	public function error404Action() {
		$this->_helper->layout()->disableLayout();
		$this->getResponse()->setHttpResponseCode(404);
		$this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
	}
 
}
