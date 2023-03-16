function callAjax(params, isBlockUI = true) {
    if (isBlockUI)
        App.startPageLoading({ animate: true });
    $.ajax({
        url: params.url,
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        type: params.type,
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