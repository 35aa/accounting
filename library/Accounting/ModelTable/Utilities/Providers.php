<?

class Accounting_ModelTable_Utilities_Providers extends Zend_Db_Table_Abstract {
	protected $_name = 'utility_providers';
	protected $_rowClass = 'Accounting_Model_Utilities_Providers';

	public function getProvidersForMember(Accounting_Model_Member $member) {
		return $this->fetchAll($this->select()->where('member_id = ?', $member->id)->where('deleted IS NULL'));
	}

	public function getProviderById($provider_id) {
		return $this->fetchRow($this->select()->where('id = ?', $provider_id)->where('deleted IS NULL'));
	}

	public function getProviderForMemberById(Accounting_Model_Member $member, $provider_id) {
		$select = $this->select()->where('member_id = ?', $member->id)
														->where('id = ?', $provider_id)
														->where('deleted IS NULL');
		return $this->fetchRow($select);
	}

	public function addProviderForMember(Accounting_Model_Member $member, $data) {
		if (array_key_exists('providers', $data) && $data['providers']) {
			$provider = $this->fetchRow($this->select()->where('id = ?', (int) $data['providers']));
		}
		else {
			$provider = $this->createRow();
			$provider->member_id = $member->id;
			$provider->name = $data['name'];
			$provider->description = $data['description'];
			$provider->created = $_SERVER['REQUEST_TIME'];
			$provider->save();
		}

		$utilitiesToProviders = new Accounting_ModelTable_Utilities_ToUtilityProviders();
		$utilitiesToProvider = $utilitiesToProviders->createRow();
		$utilitiesToProvider->member_id = $member->id;
		$utilitiesToProvider->utility_id = $data['utility'];
		$utilitiesToProvider->utility_provider_id = $provider->id;
		$utilitiesToProvider->active = $data['active'];
		$utilitiesToProvider->save();
	}

	public function setProviderAsDeleted(Accounting_Model_Member $member, $provider_id) {
		$select = $this->select()->where('member_id = ?', $member->id)
															->where('id = ?', $provider_id)
															->where('deleted IS NULL');
		$row = $this->fetchRow($select);
		$row->deleted = $_SERVER['REQUEST_TIME'];
		$row->save();
		return $row;
	}

}
