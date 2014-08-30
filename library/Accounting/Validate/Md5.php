<?

class Accounting_Validate_Md5 {
	const HASH_LENGTH = 32;

	public function isValid($value) {
		return $value && preg_match('/^[a-f,0-9]{'.self::HASH_LENGTH.','.self::HASH_LENGTH.'}/', $value);
	}
}
