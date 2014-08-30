<?

class Accounting_Model_MembersReset extends Zend_Db_Table_Row_Abstract {

	public function generateReset(){
		if (!$this->password_reset) {
			$this->password_reset = md5(microtime());
		}
	}

}
