<?

abstract class Accounting_ModelTable_Expenses_Abstract extends Zend_Db_Table {

	public function getLastRecordsForMember(Accounting_Model_Member $member, $limit = 10) {
		$select = $this->select()->setIntegrityCheck(false)
														 ->from(array('e' => 'expenses'),array('id as expenseId','member_id','finance_id','description') )
														 ->joinLeft(array('f' => 'finances'),'e.finance_id = f.id',array('amount','currency','date') )
														 ->where('e.member_id = ?', $member->id)
														 ->limit($limit)
														 ->order(array('date DESC','expenseId DESC'));
		return $this->fetchAll($select);
	}

	// public function getLastEnteredDescriptions(Accounting_Model_Member $member, $limit = 10) {
	// 	return $this->fetchAll($this->select()->where('member_id = ?', $member->id)->order('id DESC')->limit($limit));
	// }

}
