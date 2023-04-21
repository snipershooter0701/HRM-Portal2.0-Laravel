$(document).ready(function () {
    $('#btn_download_custom').click(function () {
        downloadCurrentOne();
    });

    $('#btn_download_auto_new').click(function () {
        donwloadLatestOne();
    });

    $('#btn_download_auto_old').click(function () {
        downloadOldOne();
    });

    $('#backup_auto').change(function() {
        changeAutoBackupOption();
    });
});

/**
 * Backup Current DB and download it.
 */
function downloadCurrentOne() {
    var formData = {
    };

    callAjax({
        url: BASE_URL + '/settings/backup/download_current',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var last = data['last'];
                if (last != null) {
                    var linkLatest = document.getElementById("download_file_latest");
                    linkLatest.setAttribute('href', data['url'] + "/" + last['name']);
                    $('#btn_download_auto_new').removeClass('display-none');
                }

                var old = data['old'];
                if (old != null) {
                    var linkOld = document.getElementById("download_file_old");
                    linkOld.setAttribute('href', data['url'] + "/" + old['name']);
                    $('#btn_download_auto_old').removeClass('display-none');
                }

                // Set File Information.
                if (last != null) {
                    $('#span_availalble').removeClass('display-none');
                    $('#span_unavailalble').addClass('display-none');
                    $('#file_info_exist').removeClass('display-none');
                    $('#file_info_no').addClass('display-none');
                    $('#backup_filename').html(last['name']);
                    $('#backup_filesize').html(data['filesize'] + " KB (" + last['size'] + " bytes)");
                    $('#backup_date').html(last['created_at'] + " (" + data['dateDiff'] + " days ago)");
                }

                document.getElementById("download_file_latest").click();

                toastr.success("Backup Database is completed.", "Success");
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

function donwloadLatestOne() {
    document.getElementById("download_file_latest").click();
}

function downloadOldOne() {
    document.getElementById("download_file_old").click();
}

function changeAutoBackupOption() {
    var auto = $('#backup_auto').val();
    var formData = {
        auto: auto
    };

    callAjax({
        url: BASE_URL + '/settings/backup/set_auto',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // toastr.success("Backup Database is completed.", "Success");
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}