<?

class Accounting_ModelTable_Utilities_ToUtilityProviders extends Zend_Db_Table_Abstract {
	protected $_name = 'utilities_to_utility_providers';
	protected $_rowClass = 'Accounting_Model_Utilities_ToUtilityProviders';

	public function getAllUtilitiesToUtilityProviders() {
		return $this->fetchAll($this->select());
	}

	public function getUtilityToUtilityProvider($id) {
		$select = $this->select()->where('id = ?', $id);
		return $this->fetchRow($select);
	}

	public function getUtilityToUtilityProviderForMemberByReferenceId(Accounting_Model_Member $member, $id) {
		$select = $this->select()->where('member_id = ?', $member->id)
														->where('id = ?', $id);
		return $this->fetchRow($select);
	}

	public function getUtilityToUtilityProviderByProviderId($providerId) {
		$select = $this->select()->where('utility_provider_id = ?', $providerId);
		return $this->fetchRow($select);
	}

	public function getAllUtilitiesToUtilityProviderByProviderId($providerId) {
		$select = $this->select()->where('utility_provider_id = ?', $providerId);
		return $this->fetchAll($select);
	}

	public function removeProviderReferenceByIdForMember(Accounting_Model_Member $member, $id) {
		$select = $this->select()->where('id = ?', $id);
		$row = $this->fetchRow($select);
		$row->active = 0;
		$row->deleted = $_SERVER['REQUEST_TIME'];
		$row->save();
		// check if there are more than 1 link in utilities_to_utility_providers
		if ($this->getAllUtilitiesToUtilityProviderByProviderId($row->utility_provider_id)->count() == 1) {
			// Set provider as deleted if it hasn't any payments
			$providersTable = new Accounting_ModelTable_Utilities_Providers();
			$providerDeleted = $providersTable->setProviderAsDeleted($member, $row->utility_provider_id);
		}
		return $row;
	}

	public function setInActiveProviderReferenceByIdForMember($id) {
		$select = $this->select()->where('id = ?', $id);
		$row = $this->fetchRow($select);
		$row->active = 0;
		$row->save();
		return $row;
	}


}
