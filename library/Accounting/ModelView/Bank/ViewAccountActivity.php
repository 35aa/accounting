<?

class Accounting_ModelView_Bank_ViewAccountActivity extends Zend_Db_Table {

	protected $_name = 'view_bank_accounts';
	protected $_primary = 'id';

	public function getBankAccountActivityForMember(Accounting_Model_Member $member) {
		$select = $this->select()->where('member_id = ?', $member->id)
														 ->where('baa_action IS NOT NULL')
														 ->order(array('id DESC'));
error_log($select->__toString());
		return $this->fetchAll($select);
	}

}

