<?

class Accounting_Auth_Adapter_DbTable extends Zend_Auth_Adapter_DbTable {

	const AUTH_DB_TABLE = 'members';
	const AUTH_DB_IDENTITY_COLUMN = 'email';
	const AUTH_DB_CREDENTIAL_COLUMN = 'password';

	public function __construct($db) {
		parent::__construct($db);
		$this->setCredentialColumn(self::AUTH_DB_CREDENTIAL_COLUMN);
		$this->setIdentityColumn(self::AUTH_DB_IDENTITY_COLUMN);
		$this->setTableName(self::AUTH_DB_TABLE);
		$this->setCredentialTreatment('MD5(?) AND blocked = 0 AND deleted IS NULL AND verified = 1');
	}
}
