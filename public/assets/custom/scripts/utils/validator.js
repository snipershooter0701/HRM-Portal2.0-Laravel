function doValidationForm(validateFields) {
    var isValid = true;

    for (var i in validateFields) {
        var fieldOption = validateFields[i];
        var isFieldValid = checkInputValidation(fieldOption);
        isValid = !isFieldValid ? false : isValid;
    }

    return isValid;
}

function checkInputValidation(fieldOption) {
    var isValid = true;
    var value = $('#' + fieldOption.field_id).val();
    var depth = fieldOption.level == undefined ? false : true;
    var conditions = fieldOption.conditions;

    for (var i in conditions) {
        var condition = conditions[0];
        var condArr = condition.split(CONST_VALIDATE_SPLITER);

        var cond = condArr[0];
        var error = condArr[1];

        if (cond === 'required') {
            if (value === '' || value == undefined) {
                isValid = false;
            }
        } else if (cond === 'valid_email') {
            var emailExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!value.match(emailExp))
                isValid = false;
        } else if (cond.includes('min_length[')) {
            var len = parseInt(cond.split('min_length[')[1].split(']')[0]);
            if (value.length < len)
                isValid = false;
        } else if (cond.includes('max_length[')) {
            var len = parseInt(cond.split('max_length[')[1].split(']')[0]);
            if (value.length > len)
                isValid = false;
        } else if (cond.includes('is_match_field[')) {
            var confFieldName = cond.split('is_match_field[')[1].split(']')[0];
            if ($('#' + confFieldName).val() !== value)
                isValid = false;
        } else if (cond === 'numeric') {
            var regExp = new RegExp("^\\d+$");
            isValid = regExp.test(value);
        }

        if (!isValid) {
            showValidError(fieldOption.field_id, error, depth);
            break;
        }
    }

    if (isValid)
        hideValidError(fieldOption.field_id, depth);

    return isValid;
}

// function showValidError(tagId, error) {
//     $('#' + tagId).parent().parent().addClass('has-error');
//     $('#' + tagId).parent().parent().find('.help-block').remove();
//     $('#' + tagId).parent().parent().append('<span class="help-block">' + error + '</span>');
// }

// function hideValidError(tagId) {
//     $('#' + tagId).parent().parent().removeClass('has-error');
//     $('#' + tagId).parent().parent().find('.help-block').remove();
// }

function showValidError(tagId, error, depth) {
    if (!depth) {
        $('#' + tagId).parent().addClass('has-error');
        $('#' + tagId).parent().find('.help-block').remove();
        $('#' + tagId).parent().append('<span class="help-block">' + error + '</span>');
    } else {
        $('#' + tagId).parent().parent().addClass('has-error');
        $('#' + tagId).parent().parent().find('.help-block').remove();
        $('#' + tagId).parent().parent().append('<span class="help-block">' + error + '</span>');
    }
}

function hideValidError(tagId, depth) {
    if (!depth) {
        $('#' + tagId).parent().removeClass('has-error');
        $('#' + tagId).parent().find('.help-block').remove();
    } else {
        $('#' + tagId).parent().parent().removeClass('has-error');
        $('#' + tagId).parent().parent().find('.help-block').remove();
    }
}

function showServerValidationErrors(conditions, errors) {
    for (var i in conditions) {
        var condition = conditions[i];
        var condArr = condition.split(CONST_VALIDATE_SPLITER);
        if (errors[condArr[0]] != null && errors[condArr[0]].length > 0)
            showValidError(condArr[1], errors[condArr[0]][0]);
    }
}

function doValidationDoc(validateDocFields) {
    var isValid = false;
    var isTemp = true;
    var statusArr = [];
    for (var i in validateDocFields) {
        var checkedStatus = isCheckedValidation(validateDocFields[i]);
        if (checkedStatus) {
            isTemp = doValidationForm(validateDocFields[i].child_id);
            statusArr.push(isTemp);
        }
    }
    if (statusArr.indexOf(false) == -1) isValid = true;

    return isValid;
}


function isCheckedValidation(id) {
    var isChecked_box = $("#" + id.parent_id).is(":checked");
    var isChecked_star = $("#" + id.parent_id + '_star').hasClass('star-active');

    if (isChecked_box || isChecked_star) return true;

    var child = id.child_id;
    for (var i in child) {
        hideValidError(child[i].field_id, child[i].level);
    }
    return false;
}

