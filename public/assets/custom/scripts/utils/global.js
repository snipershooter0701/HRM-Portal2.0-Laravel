$(document).ready(function () {
    $('.btn-move-panel').click(function () {
        var panelName = $(this).attr('data-panelname');
        if ($(this).parent().attr('id') == 'update_emp_action' || $(this).parent().attr('id') == 'view_emp_action') {
            $('#add_emp_action').removeClass('hide');
            $('#update_emp_action').addClass('hide');
            $('#view_emp_action').addClass('hide');
        } else if($(this).parent().attr('id') == 'update_req_action') {
            $('#add_req_action').removeClass('hide');
            $('#update_req_action').addClass('hide');
        }
        movePanel(panelName);
    });
});

/**
 * @description
 *  Move panel.
 */
function movePanel(panelName) {
    $('.move-panel').addClass('display-none');
    $('#' + panelName).removeClass('display-none');
}

function displayConfirmModal(content, title, callback) {
    $('#confirm_modal .modal-header .modal-title').html(title);
    $('#confirm_modal .modal-body').html(content);
    $('#confirm_modal').modal();
    $('#ok_btn').unbind('click').bind('click', function () {
        callback('ok');
    });
    $('#cancel_btn').unbind('click').bind('click', function () {
        callback('cancel');
    });
}