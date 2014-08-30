<?

class Accounting_Form_Goal_AddGoalCash extends Zend_Form {

	public function init() {

		$date = new Zend_Date();

		$this->addPrefixPath('Accounting_Form', 'Accounting/Form');
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'table')), 'Form'));
		//Tell all of our form elements to render only itself and the label
		$this->setElementDecorators(array('ViewHelper', 
																			array('Errors',array('class' => 'alert alert-error form-alert')) ));

		$this->addAttribs(array('id' => 'goal','class' => 'no-margin')); //form Id
		$this->setMethod('post'); //which method to use to deliver data back to server Get or Post
		$this->setAction('/goal/addgoalcash');

		$this->addElement('hidden', 'goal_id', array(
			'filters'    => array('StringTrim', 'StringToLower'),
			'validators' => array(array('StringLength', false, array(0, 32)))
		));


		$this->addElement('text', 'amount', array(
			'id' => 'amount',
			'placeholder' => 'Goal amount',
			'attribs' => array('size' => 10, 'maxLength', 10),
			'filters' => array('StringTrim'),
			'validators' => array(array('StringLength', true, array(1, 10))),
			'required' => true,
			'attribs' => array('class' => 'input') ));

		$this->addElement('submit', 'Add', array('class' => 'btn'));
	}

}
