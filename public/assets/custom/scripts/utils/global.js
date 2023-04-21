$(document).ready(function () {
    $('.btn-move-panel').click(function () {
        var panelName = $(this).attr('data-panelname');
        movePanel(panelName);
    });

    /**
     * Refresh custom ajax table.
     */
    $('.filter-custom-cancel').click(function () {
        var filterClassName = $(this).attr('data-classname');
        var searchBtnId = $(this).attr('data-search');
        $('.' + filterClassName).val("");
        $('#' + searchBtnId).trigger("click");
    });

    showNotifications();
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

/**
 * Show Notifications
 */
function showNotifications() {
    var formData = {
    };
    callAjax({
        url: BASE_URL + '/notifications',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var notifications = data['notifications'];
                var cnt = notifications.length;
                for (var i in notifications) {
                    $('#notification').append('<li>' +
                        '<a href="javascript:;">' +
                        '<span class="time">Just Now</span>' +
                        '<span class="details">' +
                        '<span class="label label-sm label-icon label-success">' +
                        '<i class="fa fa-plus"></i>' +
                        '</span>' + notifications[i]['first_name'] + ' ' + notifications[i]['last_name'] + ' wants to signup. (' + notifications[i]['email'] + ')</span>' +
                        '</a></li>'
                    );
                }

                $('#notification_badge').html(cnt);
                $('#notification_pending_cnt').html(cnt + ' pending')
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}