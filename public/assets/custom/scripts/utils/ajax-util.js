function callAjax(params, isBlockUI = true, fileUpload = false) {
    if (isBlockUI)
        App.startPageLoading({ animate: true });

    if (fileUpload) {
        $.ajax({
            url: params.url,
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            method: params.type,
            data: params.data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (isBlockUI)
                    App.stopPageLoading();
                params.success(data);
            },
            error: function (err) {
                if (isBlockUI)
                    App.stopPageLoading();
                params.error(err.responseJSON);
            }
        });
    } else {
        $.ajax({
            url: params.url,
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            method: params.type,
            data: params.data,
            success: function (data) {
                if (isBlockUI)
                    App.stopPageLoading();
                params.success(data);
            },
            error: function (err) {
                if (isBlockUI)
                    App.stopPageLoading();
                params.error(err.responseJSON);
            }
        });
    }
}