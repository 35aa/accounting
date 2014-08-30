<?

class Accounting_Auth extends Zend_Auth {

	const AUTH_DB_TABLE = 'members';
	const AUTH_DB_IDENTITY_COLUMN = 'email';
	const AUTH_DB_CREDENTIAL_COLUMN = 'password';

	/*
	 * $post array should contain values to process authentication
	 * It should contain keys 'email' and password with valid values
	 * Now it is used values from form Accounting_Form_Login.
	`*/
	public static function isAuthenticated($post = array()) {
		$instance = self::getInstance();
		//skip the procedure if we alredy have authenticated person

		if ($instance->hasIdentity()) return true;

		$adapter = new Accounting_Auth_Adapter_DbTable(Zend_Db_Table_Abstract::getDefaultAdapter());

		$adapter->setIdentity($post['email'])->setCredential($post['password']);

		$result = $instance->authenticate($adapter);
		if ($result->isValid()) {
			$instance->getStorage()->write($adapter->getResultRowObject(null,self::AUTH_DB_CREDENTIAL_COLUMN));
		}
		else {
			$instance->clearIdentity();
		}
		return $result->isValid();
	}

	public static function initAuth() {
		self::getInstance()
						->setStorage(new Zend_Auth_Storage_Session(Accounting_Constants::SESSION_NAMESPACE));
	}
}
