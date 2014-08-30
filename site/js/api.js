
//service methods

/*
// - is comment
| - 'or'

api request sample:
{
data: [object]
}

api response sample:
{
success: [0,1],
error: [object]|0 //if no error//,
data: 0 //if error// | [object]//
}

error object description:
object.description - error name
object.errno - error code (if exists)
*/

function makeAjaxCall(action, data, callbackMethod) {
	var request = $.ajax({
		type: "POST",
		url: "/api.php/api/" + action,
		data: buildPostString(data),
		dataType: 'json',
		processData: false,
		success: function (data, textStatus, jqXHR) {
			if (data.success) callbackMethod(data.data);
			else {alert( "Request failed: " + data.error.description );}
		}
	});
	
	request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
	});
}

function buildPostString(data) {
	var postStrings = new Array();
	postStrings[0] = 'controller=api';
	for (var id in data) {
		if (!data.hasOwnProperty(id)) continue;
		postStrings[postStrings.length] = id + '=' + data[id];
	}
	var stringPost = postStrings.join('&');
	return postStrings.join('&');
}

//add validation here!!!

//---------------


// implementation of apps methods
function loadBankNames(textElement) {
	makeAjaxCall('loadbanknames', [], fillBankNames);
}

function fillBankNames(data) {
	if ($("#bank_id").length)
		$("#bank_id").typeahead({
						'source': data });
}

// ---------------
