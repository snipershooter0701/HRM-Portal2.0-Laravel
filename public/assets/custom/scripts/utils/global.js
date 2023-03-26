$(document).ready(function () {
    $('.btn-move-panel').click(function () {
        var panelName = $(this).attr('data-panelname');
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
}