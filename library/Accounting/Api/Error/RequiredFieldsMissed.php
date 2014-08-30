<?

class Accounting_Api_Error_RequiredFieldsMissed extends Accounting_Api_Abstract {

  public function __construct() {
    $this->_errors = array();
    $this->_addError('Required fields missed', 'VALIDATION');
  }

  public function processRequest() {}

}
