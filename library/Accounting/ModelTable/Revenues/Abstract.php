<?

abstract class Accounting_ModelTable_Revenues_Abstract extends Zend_Db_Table {

	public function getLastRecordsForMember(Accounting_Model_Member $member, $limit = 10) {
		$select = $this->select()->setIntegrityCheck(false)
														 ->from(array('r' => 'revenues'),array('id as revenueId','member_id','finance_id','description') )
														 ->joinLeft(array('f' => 'finances'),'r.finance_id = f.id',array('amount','currency','date') )
														 ->where('r.member_id = ?', $member->id)
														 ->limit($limit)
														 ->order(array('date DESC','revenueId DESC'));
		return $this->fetchAll($select);
	}
/*
	public function getLastEnteredDescriptions(Accounting_Model_Member $member, $limit = 10) {
		return $this->fetchAll($this->select()->where('member_id = ?', $member->id)->order('id DESC')->limit($limit));
	}
*/
}
