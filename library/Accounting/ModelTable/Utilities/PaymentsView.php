<?

class Accounting_ModelTable_Utilities_PaymentsView extends Zend_Db_Table_Abstract {
	protected $_name = 'view_utility_payments'; //use view but not table
	protected $_primary = 'id';
	protected $_rowClass = 'Accounting_Model_Utilities_PaymentView';

	public function getPaymentsForMember(Accounting_Model_Member $member) {
		$select = $this->select()->where('member_id = ?', $member->id)->order('period_from DESC');
		return $this->fetchAll($select);
	}
	
	public function getPaymentsForProviderByReferenceIdForMember(Accounting_Model_Member $member, $referenceId) {
		$select = $this->select()->where('member_id = ?', $member->id)->where('utility_id_provider_id = ?', $referenceId);
		error_log($select->__toString());
		return $this->fetchAll($select);
	}
}
