<?

class Accounting_Service_ReCaptcha extends Zend_Service_ReCaptcha {

	const PUBKEY = "6Ld489kSAAAAAK-fVgzsuvQbqvyy3GxCD1NDUJgj";
	const PRIVKEY = "6Ld489kSAAAAAMKZ-1_9Ph_-Mq-cxT05-cgtjK1H";

	public function __construct() {
		parent::__construct();
		$this->setPublicKey(self::PUBKEY);
		$this->setPrivateKey(self::PRIVKEY);
		$this->setOption('theme', 'clean');
	}

}
