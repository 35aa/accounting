<?

abstract class Accounting_Api_Abstract implements Accounting_Api_Interface {
	
	//stores request data
	protected $_data;
	//stores response
	protected $_response;
	//stores errors
	protected $_errors;
	//stores schema data (var name => list of validators)
	protected $_validators;

	public function __construct() {
		//we do not want to init data at definition time. We should use constructor everywhere it is possible
		$this->_validators = array(); // we does not transfer here any params
		$this->_errors = array();
	}

	public function checkAuth() {
		if (!Accounting_Auth::getInstance()->hasIdentity()) {
			$this->_addError('Member should authenticate itself', 'AUTH');
		}

		return !$this->isError();
	}

	public function setRequestData(array $data) {
		if (!is_array($data)) return false;
		//since this is just setter	- do not perform check here, only store request data
		$this->_data = $data;
		return true;
	}

	public function validateInputData() {
		//go through the list of vars
		foreach ($this->_data as $key => $data) {
			//if this var is described in validators array - we should check it
			if (in_array($key, $this->_validators)) {
				$valid = true;
				foreach ($this->_validatorsp[$key] as $validator) {
					if (!$validator->isValid($data)) {
						$this->_addError($validator->getError(), 'VALIDATION', $key);
						unset($this->_data[$key]);
					}
				}
			}
			//if validators not defined for this var it should be removed from array
			else {
				unset($this->_data[$key]);
			}
		}
		return !$this->isError();
	}

	public function getResponseData() {
		return $this->_response;
	}
	public function getJsonResponseData() {
		return Zend_Json::encode($this->_response);
	}

	public function isError() {
		//return boolean type since name of function told us that this function should return true or false;
		return count($this->getErrors()) > 0;
	}

	public function getErrors() {
		return $this->_errors;
	}

	public function getJsonErorrs() {
		return Zend_Json::encode($this->_errors);
	}

	protected function _addError($errorDescription, $type, $linkedVarName = '') {
		array_push($this->_errors, array('error' => $errorDescription, 'type' => $type, 'var' => $linkedVarName));
	}
}
