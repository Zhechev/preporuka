function setError(elementId, errorMessage) {
    obj = $("#" + elementId);
    freeError(elementId);
    $(obj).after( "<span id='error_message_" + elementId + "' class='error-message'>" + errorMessage + "</span>" );

    var offset = obj.offset().top*1;
    if(offset > 0) {
        $('html, body').animate({scrollTop:offset - 200}, 'slow');
    }
}

function freeError(elementId) {
    $('#error_message_' + elementId).remove();
}

function isNum(elementValue) {
    var regex = /^\d+$/;
    return regex.test(elementValue);
}

function isMobilePhone(phone) {
    if (phone.length < 10) {
        return false;
    }
    var tempPhone = phone;
    if (tempPhone.substring(0, 4) == "+359") {
        tempPhone = "0" + phone.substring(4, phone.length);
    } else if (tempPhone.substring(0, 5) == "00359") {
        tempPhone = "0" + phone.substring(5, phone.length);
    }

    return tempPhone.length != 10 ? false : !isNumOnly(tempPhone) ? false : tempPhone.substring(0, 2) != "08" ? false : true
}

function isNumOnly(phone) {
    var reg = /^[0-9]+$/;
    return reg.test(phone) ? true : false
}

function isValidEmail(email) {
    var reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return reg.test(email) ? true : false
}
