$(document).ready(function () {
    // create employee
    $('#save_expense').click(function () {
        saveExpense();
    });

    // add bill
    $('#add_bill').click(function () {

        var i = parseInt($(this).attr('data-idx'));
        var add_bill = '<tr>' +
            '<td>' + (++i) + '</td>' +
            '<td><div class="input-group date date-picker" data-date-format="yyyy-mm-dd">' +
            '<input type="text" class="form-control input-sm bill-date-' + i + '">' +
            '<span class="input-group-btn"><button class="btn btn-sm default" type="button"> <i class="fa fa-calendar"></i></button></div>' +
            '</td>' +
            '<td> <input type="text" class="form-control input-sm bill-detail-' + i + '"> </td>' +
            '<td> <input type="text" class="form-control input-sm bill-amount-' + i + '">  </td>' +
            '<td> <input type="file" class="form-control bill-attachment input-sm bill-attachment-' + i + '"> </td>' +
            '<td>  <a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a> </td>' +
            '</tr>';
        $('#tbl_add_expenses tbody').append(add_bill);
        $(this).attr('data-idx', i);

        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });

    });

});

function saveExpense() {

    // validation TODO
    var validateFields = [{
        field_id: 'expense_category',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Category field is required.'
        ]
    }, {
        field_id: 'expense_type',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Type field is required.'
        ]
    }, {
        field_id: 'expense_emp',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee field is required.'
        ]
    }];

    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        cate: $('#expense_category').val(),
        type: $('#expense_type').val(),
        emp: $('#expense_emp').val()
    };


    var i;
    var recordArray = [];
    var records = $('#add_bill').attr('data-idx');
    for (i = 0; i < records; i++) {
        var data = {
            date: $('.bill-date-' + (i + 1)).val(),
            details: $('.bill-detail-' + (i + 1)).val(),
            amount: $('.bill-amount-' + (i + 1)).val(),
            attachment: $('.bill-attachment-' + (i + 1)).val()
        };
        recordArray[i] = data;
    }

    formData['bill_record'] = recordArray;

    callAjax({
        url: BASE_URL + '/expenses/get_add_expenses',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshExpenseTbl();
                // toastr.success("New Employee is successfully created.", "Success");

                // move Expense list page
                $('#expense_save_action .btn-move-panel').click();

                $('#expense_category').val('');
                $('#expense_type').val('');
                $('#expense_emp').val('');
                $('#tbl_add_expenses tbody').html(
                    '<tr>' +
                    '<td>1</td>' +
                    '<td><div class="input-group date date-picker" data-date-format="yyyy-mm-dd">' +
                    '<input type="text" class="form-control input-sm bill-date-1">' +
                    '<span class="input-group-btn"><button class="btn btn-sm default" type="button"> <i class="fa fa-calendar"></i></button></div>' +
                    '</td>' +
                    '<td> <input type="text" class="form-control input-sm bill-detail-1"> </td>' +
                    '<td> <input type="text" class="form-control input-sm bill-amount-1">  </td>' +
                    '<td> <input type="file" class="form-control bill-attachment input-sm bill-attachment-1"> </td>' +
                    '<td>  </td>' +
                    '</tr>'
                );
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    autoclose: true
                });
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'business_name' + CONST_VALIDATE_SPLITER + 'create_bus_name',
                    'contact_number' + CONST_VALIDATE_SPLITER + 'create_bus_contact_num',
                    'federal_id' + CONST_VALIDATE_SPLITER + 'create_bus_federal_id',
                    'email' + CONST_VALIDATE_SPLITER + 'create_bus_email',
                    'website' + CONST_VALIDATE_SPLITER + 'create_bus_website',
                    'inv_country_id' + CONST_VALIDATE_SPLITER + 'create_bus_inv_country',
                    'inv_state_id' + CONST_VALIDATE_SPLITER + 'create_bus_inv_state',
                    'inv_city' + CONST_VALIDATE_SPLITER + 'create_bus_inv_city',
                    'inv_street' + CONST_VALIDATE_SPLITER + 'create_bus_inv_street',
                    'inv_suite_aptno' + CONST_VALIDATE_SPLITER + 'create_bus_inv_apt',
                    'inv_zipcode' + CONST_VALIDATE_SPLITER + 'create_bus_inv_zipcode',
                    'addr_country_id' + CONST_VALIDATE_SPLITER + 'create_bus_cli_country',
                    'addr_state_id' + CONST_VALIDATE_SPLITER + 'create_bus_cli_state',
                    'addr_city' + CONST_VALIDATE_SPLITER + 'create_bus_cli_city',
                    'addr_street' + CONST_VALIDATE_SPLITER + 'create_bus_cli_street',
                    'addr_suite_aptno' + CONST_VALIDATE_SPLITER + 'create_bus_cli_apt',
                    'addr_zipcode' + CONST_VALIDATE_SPLITER + 'create_bus_cli_zipcode',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}