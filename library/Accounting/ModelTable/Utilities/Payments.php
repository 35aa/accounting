<?

class Accounting_ModelTable_Utilities_Payments extends Zend_Db_Table_Abstract {
	protected $_name = 'utility_payments';
	protected $_rowClass = 'Accounting_Model_Utilities_Payments';

	public function getActiveProvidersForMember(Accounting_Model_Member $member) {
		$select = $this->select()->where('member_id = ?', $member->id);
		return $this->fetchAll($select);
	}

	public function getPaymentsForMember(Accounting_Model_Member $member) {
		$select = $this->select()->where('member_id = ?', $member->id)->order('period_from DESC');
		return $this->fetchAll($select);
	}

	public function getPaymentByReferenceId(Accounting_Model_Member $member, $referenceId) {
		$select = $this->select()->where('member_id = ?', $member->id)
														->where('utility_id_provider_id = ?', $referenceId);
		return $this->fetchAll($select);
	}

	public function savePayment(Accounting_Model_Member $member, Zend_Db_Table_Rowset $utilityProviders, $data) {
		foreach ($utilityProviders as $provider) {
			if ($provider->reference_id == $data['utilityProvider']) break;
		}

		$description = 'Paid bill to '.$provider->name.' for utility '.$provider->utility_name.'. Amount '.Zend_Locale_Format::toNumber($data['amount'], array('precision' => 2)).' '.$data['currency'];
		if ($data['description']) {
			$description = $data['description']. " ($description)";
		}

		// prepare expenses data
		$expensesData = array(
			'date' => $_SERVER['REQUEST_TIME'], //add one more input for payment date
			'amount' => Zend_Locale_Format::toNumber($data['amount'], array('precision' => 2)),
			'currency' => $data['currency'],
			'description' => $description,
		);
		// save data to expencies:
		$expensesTable = new Accounting_ModelTable_Expenses_Expense();
		$expenses = $expensesTable->createNewRecord($member, $expensesData);

		$date = new Zend_Date();
		$date->subTime($date->getTime());

		$payment = $this->createRow();
		$payment->member_id = $member->id;
		$payment->finance_id = $expenses->finance_id;
		$payment->utility_id_provider_id = $data['utilityProvider'];
		$payment->description = $description;
		$payment->period_from = $date->setDate($data['dateFrom'], 'dd/MM/yyyy')->getTimestamp();
		$payment->period_to = $date->setDate($data['dateTo'], 'dd/MM/yyyy')->getTimestamp();
		// TODO: $payment->previous_utility_meter_reading_id = 
		// TODO: $payment->last_utility_meter_reading_id = 
		// TODO: thinks what's is rate field. what if for?
		// $payment->rate = $data['amount'];
		$payment->created = $_SERVER['REQUEST_TIME'];
		$payment->save();
	}

	// payments history block
	public function getUtilitiPaymentsHistoryMemberTotalRows(Accounting_Model_Member $member, $options = array()) {
		$select = $this->_generateSelect($member, $options);
		return sizeof($this->fetchAll($select));
	}

	public function getUtilityPaymentsHistoryMember(Accounting_Model_Member $member, $options = array()) {
		if (!isset($options['offset']) || !$options['offset']) $options['offset'] = 0;
		if (!isset($options['limit']) || !$options['limit']) $options['limit'] = 10;

		$select = $this->_generateSelect($member, $options)
			->limit($options['limit'], $options['offset'])
			->order('created DESC');

		return $this->fetchAll($select);
	}

	protected function _generateSelect($member, $options) {
		$select = $this->select()->from(array('up' => $this->_name) )
														->join(array('utup' => 'utilities_to_utility_providers'), 'up.utility_id_provider_id=utup.id', array())
														->where('up.member_id = ?', $member->id)
														->order('up.created DESC');
// error_log($select->__toString());
		$dateObject = new Zend_Date();

		if (isset($options['dateFrom']) && $options['dateFrom']) {
			$dateObject->setDate($options['dateFrom'], 'dd/MM/yyyy');
			$dateObject->subTime($dateObject->getTime());
			$select->where('up.period_from = ?', $dateObject->getTimestamp());
		}

		if (isset($options['dateTo']) && $options['dateTo']) {
			$dateObject->setDate($options['dateTo'], 'dd/MM/yyyy');
			$dateObject->subTime($dateObject->getTime());
			$select->where('up.period_to = ?', $dateObject->getTimestamp());
		}

		if (isset($options['utility_name']) && $options['utility_name']) {
			$select->where('utup.utility_id = ?', $options['utility_name']);
		}

		if (isset($options['provider_name']) && $options['provider_name']) {
			$select->where('utup.utility_provider_id = ?', $options['provider_name']);
		}

		if (isset($options['searchString']) && $options['searchString']) {
			$select->where('up.description like ?', '%'.$options['searchString'].'%');
		}
		
		return $select;
	}

}
