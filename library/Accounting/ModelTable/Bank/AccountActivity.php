<?

class Accounting_ModelTable_Bank_AccountActivity extends Accounting_ModelTable_Bank_Abstract {

	protected $_name = 'bank_accounts_activity';
	protected $_rowClass = 'Accounting_Model_Bank_AccountActivity';

	public function addAccountActivityForMember(Accounting_Model_Member $member, $activitytData) {
		$row = $this->createRow();
		return $row->saveAccountActivity($member, $activitytData);
	}

	public function getBankAccountActivityForMember(Accounting_Model_Member $member) {
		$select = $this->select()->from(array('baa' => $this->_name))
														 ->join(array('ba' => 'bank_accounts'),'baa.bank_account_id = ba.id',array())
														 ->where('ba.member_id = ?', $member->id)
														 ->order(array('id DESC'));
		return $this->fetchAll($select);
	}

	public function getBankAccountActivityForMemberByAccountId(Accounting_Model_Member $member, $accountId) {
		$select = $this->select()->from(array('baa' => $this->_name))
														 ->join(array('ba' => 'bank_accounts'),'baa.bank_account_id = ba.id',array())
														 ->where('ba.member_id = ?', $member->id)
														 ->where('baa.bank_account_id = ?', $accountId)
														 ->order(array('id DESC'));
		return $this->fetchAll($select);
	}

	// back activity quick search block

	public function getBankAccountActivityHistoryMemberTotalRows(Accounting_Model_Member $member, $options = array()) {
		// $select = $this->_generateSelect($member, $options)
									 // ->from(array('baa' => $this->_name),array('totalRows'=>'count(*)'))
									 // ->join(array('ba' => 'bank_accounts'),'baa.bank_account_id = ba.id',array());
		// return $this->getAdapter()->fetchOne($select);
		$select = $this->_generateSelect($member, $options);
		return sizeof($this->fetchAll($select));
	}

	public function getBankAccountActivityHistoryMember(Accounting_Model_Member $member, $options = array()) {
		if (!isset($options['offset']) || !$options['offset']) $options['offset'] = 0;
		if (!isset($options['limit']) || !$options['limit']) $options['limit'] = 10;

		$select = $this->_generateSelect($member, $options)
									 ->limit($options['limit'], $options['offset'])
									 ->order('baa.date DESC');

		return $this->fetchAll($select);
	}

	protected function _buildCustomSelectOptions($options) {
		$dateObject = new Zend_Date();
		$select = $this->select();

		if (isset($options['dateFrom']) && $options['dateFrom']) {
			$dateObject->setDate($options['dateFrom'], 'dd/MM/yyyy');
			$dateObject->subTime($dateObject->getTime());
			$select->where('baa.date >= ?', $dateObject->getTimestamp());
		}
		//may be here should be date object
		//this date should include last day
		if (isset($options['dateTo']) && $options['dateTo']) {
			$dateObject->setDate($options['dateTo'], 'dd/MM/yyyy');
			$dateObject->subTime($dateObject->getTime());
			$dateObject->addDay(1); //add 24 hours
			$dateObject->subSecond(1); // minus 1 second should get 23:59:59 of current date
			$select->where('baa.date < ?', $dateObject->getTimestamp());
		}

		if (isset($options['bank_action']) && $options['bank_action'] == 'In') {
			$select->where('f.amount < 0');
		} elseif (isset($options['bank_action']) && $options['bank_action'] == 'Out') {
			$select->where('f.amount >= 0');
		}

		if (isset($options['account_name']) && $options['account_name']) {
			$select->where('name = ?', $options['account_name']);
		}

		if (isset($options['searchString']) && $options['searchString']) {
			$select->where('baa.description like ?', '%'.$options['searchString'].'%');
		}
		return $select;
	}

	protected function _generateSelect($member, $options) {
		$select = $this->_buildCustomSelectOptions($options)
												->from(array('baa' => $this->_name))
												->join(array('ba' => 'bank_accounts'),'baa.bank_account_id = ba.id',array())
												->join(array('f' => 'finances'),'baa.finance_id = f.id',array())
												->where('ba.member_id = ?', $member->id)
												->where('ba.active = ?',1)
												->order(array('baa.id DESC'));
		return $select;
	}

	//used for api. return 10 descriptions
	// public function getLastEnteredDescriptions(Accounting_Model_Member $member, $limit = 10) {
	// 	$sql = $this->select()
	// 							->from(array('baa' => $this->_name))
	// 							->join(array('ba' => 'bank_accounts'), 'baa.bank_account_id = ba.id', array())
	// 							->where('ba.member_id = ?', $member->id)
	// 							->order('baa.id DESC')->limit($limit);
	// 	return $this->fetchAll($sql);
	// }

	// public function getAccountBalanceByBankAccountId($bank_account_id) {
	// 	$sql = $this->select()
	// 							->from(array('baa' => $this->_name), array('amount'=>'sum(if(baa.action=In,baa.amount,-baa.amount))','ba.currency'))
	// 							->join(array('ba' => 'bank_accounts'), 'baa.bank_account_id = ba.id', array())
	// 							->where('baa.bank_account_id = ?', $bank_account_id)
	// 							//->group by('baa.bank_account_id');
	// 							->group('baa.bank_account_id');
	// 	return $this->fetchAll($sql);
	// }

	public function getActivityDataByAccout(Accounting_Model_Bank_Account $bankAccount) {
		return $this->fetchAll($this->select()->where('bank_account_id = ?', $bankAccount->id));
	}

	public function getActivityDataForMemberByAccount($bankAccountId) {
		return $this->fetchAll($this->select()->where('bank_account_id = ?', $bankAccountId));
	}
}

