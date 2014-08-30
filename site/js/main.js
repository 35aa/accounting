//define currencies
var currencies = ['UAH', 'USD', 'EUR', 'GPB'];

//onload method
$(document).ready(function () {

	//test
	$('#bankDataAdd').modal({
			backdrop: true,
			keyboard: true,
			show: false
	}).css({
			width: 'auto','margin-left': function () {
				return -($(this).width() / 2);
			}
	});

	$('#bankDataAdd').on('shown', function() {
		$("#name").focus(); })

	$('#goalAdd').modal({
			backdrop: true,
			keyboard: true,
			show: false
	}).css({
			width: 'auto','margin-left': function () {
				return -($(this).width() / 2);
			}
	});
	$('#addGoalCashData').modal({
			backdrop: true,
			keyboard: true,
			show: false
	}).css({
			width: 'auto','margin-left': function () {
				return -($(this).width() / 2);
			}
	});
	// this should launch modal window with input form
	// do we use it now???

	//add callendar to each element with class datapicker
	$( ".datepicker" ).datepicker({
																dateFormat: "dd/mm/yy",
																changeMonth: true,
																changeYear: true
																});
	//future date locked
	$( ".datepicker_futureLock" ).datepicker({
																dateFormat: "dd/mm/yy",
																changeMonth: true,
																changeYear: true,
																maxDate: 0
																});

	//add onChange methods  to currency object on exchanges. 
	//(remove selected option from opposit currency object)
	if ($('#currencyFrom').length && $('#currencyTo').length) {
		//add to "fromCurrency object"
		$('#currencyFrom').change(function(event) {
			var selectedValue = $('#' + event.target.id).val();
			var oppositId = 'currencyTo';
			rebuildCurrnecies(oppositId, selectedValue);
		});

		//add to ToCurrency object
		$('#currencyTo').change(function(event) {
			var selectedValue = $('#' + event.target.id).val();
			var oppositId = 'currencyFrom';
			rebuildCurrnecies(oppositId, selectedValue);
		});
	}
	//handle changing params of history filters
	if ($('#history').length) {
		$('#currency').change(function(event) {$('#offset').val(0);formHistorySubmit()});
		$('#dateFrom').change(function(event) {if ($(event.target).val().length == 10 || $(event.target).val().length == 0) {$('#offset').val(0);formHistorySubmit();}});
		$('#dateTo').change(function(event) {if ($(event.target).val().length == 10 || $(event.target).val().length == 0) {$('#offset').val(0);formHistorySubmit();}});
	}
	if ($('#limit_10').length) {
		$('#limit_10').click(function(event) {setLimit(event.target);});
	}
	//add functions for history
	if ($('#limit_25').length) {
		$('#limit_25').click(function(event) {setLimit(event.target);});
	}
	if ($('#limit_50').length) {
		$('#limit_50').click(function(event) {setLimit(event.target);});
	}
	//change offset for history moving forward and back
	if ($('#paginator_left').length) {
		$('#paginator_left').click(function(event) {changeOffset(event.target);});
	}
	if ($('#paginator_right').length) {
		$('#paginator_right').click(function(event) {changeOffset(event.target);});
	}
	if ($('#action').length) {
		$('#action').change(function(event) {$('#offset').val(0);formHistorySubmit()});
	}
	if ($('#account_name').length) {
		$('#account_name').change(function(event) {$('#offset').val(0);formHistorySubmit()});
	}
	if ($('#utility_name').length) {
		$('#utility_name').change(function(event) {$('#offset').val(0);formHistorySubmit()});
	}
	if ($('#provider_name').length) {
		$('#provider_name').change(function(event) {$('#offset').val(0);formHistorySubmit()});
	}
	if ($('#bank_action').length) {
		$('#bank_action').change(function(event) {$('#offset').val(0);formHistorySubmit()});
	}
});

function changeOffset(targetElement) {
	//moving back
	if (targetElement.id == 'paginator_left') {
		$('#offset').val(parseInt($('#offset').val()) - parseInt($('#limit').val()));
	}
	if (targetElement.id == 'paginator_right') {
		$('#offset').val(parseInt($('#offset').val()) + parseInt($('#limit').val()));
	}
	formHistorySubmit();
}

function setLimit(sourceObject) {
	$('#limit').val(sourceObject.id.split('_')[1]);
	$('#offset').val(0);
	formHistorySubmit()
}

function formHistorySubmit() {
	$('#history').submit();
}

// remove all options from select tag and add them again
function rebuildCurrnecies(objectId, removedItem) {
	var selectedValue = $('#' + objectId).val();

	for (var index = $('#' + objectId)[0].options.length - 1; index >=0 ; index--) {
		$($('#' + objectId)[0].options[index]).remove();
	}

	addOptionToSelect(objectId, '', '---');

	for (index = 0; index < currencies.length; index ++) {
		if (currencies[index] == removedItem) continue;
		addOptionToSelect(objectId, currencies[index], currencies[index]);
	}
	$('#' + objectId).val(selectedValue);
}

//build option tag and append it to select tag
function addOptionToSelect(objectId, value, text) {
	var o = new Option(text, value);
	$(o).html(text);
	$('#' + objectId).append(o);
}

function onChangeBankAccount() {
	if ($('#bank_account_id').val()=='') {
		$('#goal_currency').show();
		document.getElementById("bank_account_id").className = "input-small";
	} 
	else {
		$('#goal_currency').hide();
		document.getElementById("bank_account_id").className = "input";
	}
}
