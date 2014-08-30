<?

class Accounting_Model_MembersVerify extends Zend_Db_Table_Row_Abstract {

	public function generateVerifyKey(){
		if (!$this->verify_key) {
			$this->verify_key = md5(microtime());
		}
	}
}
