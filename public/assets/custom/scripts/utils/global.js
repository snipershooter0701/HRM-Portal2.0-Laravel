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