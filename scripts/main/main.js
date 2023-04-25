/**
 * Created by Mohammad on 19/06/2016.
 */
function ShowLoadingImage(Item, e) {
	// Show loading icon
	$('[data-popup="' + Item + '"]').fadeIn(350);
	
	e.preventDefault();
}

function HideLoadingImage(Item, e) {
	// Finish loading icon
	$('[data-popup="' + Item + '"]').fadeOut(350);
	
	e.preventDefault();
}

/**
 * @return {boolean}
 */
function ShowMessage(result, SuccessMessage) {
	var returnVal = false;
	var errors = SuccessMessage;
	if ($.isArray(result.responseError)) {
		$.each(result.responseError, function (i, value) {
			errors += value.eMsg + "<br>";
		});
		errors = "Error : " + errors;
	}
	else if (result.responseError !== null) {
		if (result.responseError.eMsg !== null && result.responseError.eMsg !== "") {
			errors = "Error : " + result.responseError.eMsg;
		}
		else {
			returnVal = true;
		}
	}
	else {
		returnVal = true;
	}
	if (errors !== "") {
		ShowAlert("", errors);
	}
	return returnVal;
}

function SetResultMessage(responseError, SuccessMessage) {
	var errors = SuccessMessage;
	if ($.isArray(responseError)) {
		$.each(responseError, function (i, value) {
			errors += value.eMsg + "<br>";
		});
		errors = "Error : " + errors;
	}
	else if (responseError !== null) {
		if (responseError.eMsg !== null && responseError.eMsg !== "") {
			errors = "Error : " + responseError.eMsg;
		}
	}
	
	return errors;
}

function ShowAlert(Title, Content) {
	$.alert({
		title        : Title,
		content      : Content,
		rtl          : true,
		confirmButton: "بسیار خب",
		confirm      : function () {
		}
	});
}