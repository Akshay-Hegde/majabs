const NAME = {
    min: 3,
    max: 50
};

const EMAIL = {
    min: 1,
    max: 350
};

const PHONE = {
    min: 10,
    max: 10
};

const ID = {
    min: 13,
    max: 13
};

const SALARY = {
    min: 1,
    max: 13
};

function toasters(values) {
    $.toast({
        heading: values.head,
        text: values.msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: values.icon,
        hideAfter: 3500

    });
}

var EMPLOYEE_ID = 0;

$('#frmAddEmployee').validate({
    debug: true,
    errorClass: "text-danger",
    validClass: 'success',
    errorElement: 'span',
    highlight: function (element, errorClass, validClass) {
        $(element).parents("div.control-group").addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".error").removeClass(errorClass).addClass(validClass);
    },
    rules: {
        name: {
            required: true,
            minlength: NAME.min,
            maxlength: NAME.max
        },
        surname: {
            required: true,
            minlength: NAME.min,
            maxlength: NAME.max
        },
        email: {
            required: true,
            email: true,
            minlength: EMAIL.min,
            maxlength: EMAIL.max
        },
        phone: {
            required: true,
            number: true,
            minlength: PHONE.min,
            maxlength: PHONE.max
        },
        id_number: {
            required: true,
            number: true,
            minlength: ID.min,
            maxlength: ID.max
        },
        salary: {
            required: true,
            number: true,
            minlength: SALARY.min,
            maxlength: SALARY.max
        },
        license_expiry_date: {
            required: true
        },
        contractFile: {
            required: true
        },
        attributes: {
            required: true
        }
    },
    messages: {
        name: {
            required: "First Name is required.",
            minlength: "First Name cannot be less than "+NAME.min+" characters",
            maxlength: "First Name cannot be less exceed "+NAME.max+" characters"
        },
        surname: {
            required: "Last Name is required.",
            minlength: "Last Name cannot be less than "+NAME.min+" characters",
            maxlength: "Last Name cannot be less exceed "+NAME.max+" characters"
        },
        email: {
            required: "Email is required.",
            minlength: "Email cannot be less than "+EMAIL.min+" characters",
            maxlength: "Email cannot be less exceed "+EMAIL.max+" characters"
        },
        phone: {
            required: "Phone is required.",
            minlength: "Phone cannot be less than "+PHONE.min+" digits",
            maxlength: "Phone cannot be less exceed "+PHONE.max+" digits"
        },
        id_number: {
            required: "ID is required.",
            minlength: "ID cannot be less than "+ID.min+" digits",
            maxlength: "ID cannot be less exceed "+ID.max+" digits"
        },
        salary: {
            required: "Salary is required.",
            minlength: "Salary cannot be less than "+SALARY.min+" digits",
            maxlength: "Salary cannot be less exceed "+SALARY.max+" digits"
        },
        license_expiry_date: {
            required: "Driver's license expiry date is required."
        },
        contractFile: {
            required: "Contract file is required."
        },
        attributes: {
            required: "Attribute file is required."
        }
    }, submitHandler: function (form) {

        //$('#btnRegisterEmp').prop('disabled',true);

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:new FormData(form),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            dataType:"JSON"
        }).success(function (data) {

            if (data.status === "success") {

                toasters({
                    head: "Successful",
                    icon: "success",
                    msg: data.message,
                } );

            }else if(data.status === "warning"){
                toasters(
                    {
                        head: "Failed",
                        icon: "warning",
                        msg: data.message,
                    }
                );
            }
            else
            {
                toasters(
                    {
                        head: "Error",
                        icon: "error",
                        msg: data.message,
                    }
                );
            }

            //$('#btnRegisterEmp').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnRegisterEmp').prop('disabled',false);
        });
    }
});

$('#frmAddEmployee-edit').validate({
    debug: true,
    errorClass: "text-danger",
    validClass: 'success',
    errorElement: 'span',
    highlight: function (element, errorClass, validClass) {
        $(element).parents("div.control-group").addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".error").removeClass(errorClass).addClass(validClass);
    },
    rules: {
        name: {
            required: true,
            minlength: NAME.min,
            maxlength: NAME.max
        },
        surname: {
            required: true,
            minlength: NAME.min,
            maxlength: NAME.max
        },
        email: {
            required: true,
            email: true,
            minlength: EMAIL.min,
            maxlength: EMAIL.max
        },
        phone: {
            required: true,
            number: true,
            minlength: PHONE.min,
            maxlength: PHONE.max
        },
        id_number: {
            required: true,
            number: true,
            minlength: ID.min,
            maxlength: ID.max
        },
        salary: {
            required: true,
            number: true,
            minlength: SALARY.min,
            maxlength: SALARY.max
        },
        license_expiry_date: {
            required: true
        },
        attributes: {
            required: true
        }
    },
    messages: {
        name: {
            required: "First Name is required.",
            minlength: "First Name cannot be less than "+NAME.min+" characters",
            maxlength: "First Name cannot be less exceed "+NAME.max+" characters"
        },
        surname: {
            required: "Last Name is required.",
            minlength: "Last Name cannot be less than "+NAME.min+" characters",
            maxlength: "Last Name cannot be less exceed "+NAME.max+" characters"
        },
        email: {
            required: "Email is required.",
            minlength: "Email cannot be less than "+EMAIL.min+" characters",
            maxlength: "Email cannot be less exceed "+EMAIL.max+" characters"
        },
        phone: {
            required: "Phone is required.",
            minlength: "Phone cannot be less than "+PHONE.min+" digits",
            maxlength: "Phone cannot be less exceed "+PHONE.max+" digits"
        },
        id_number: {
            required: "ID is required.",
            minlength: "ID cannot be less than "+ID.min+" digits",
            maxlength: "ID cannot be less exceed "+ID.max+" digits"
        },
        salary: {
            required: "Salary is required.",
            minlength: "Salary cannot be less than "+SALARY.min+" digits",
            maxlength: "Salary cannot be less exceed "+SALARY.max+" digits"
        },
        license_expiry_date: {
            required: "Driver's license expiry date is required."
        },
        attributes: {
            required: "Attribute file is required."
        }
    }, submitHandler: function (form) {

        //$('#btnRegisterEmp').prop('disabled',true);
        //Adding an id field to the form

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:new FormData(form),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            dataType:"JSON"
        }).success(function (data) {

            if (data.status === "success") {

                toasters({
                    head: "Successful",
                    icon: "success",
                    msg: data.message,
                } );

            }else if(data.status === "warning"){
                toasters(
                    {
                        head: "Failed",
                        icon: "warning",
                        msg: data.message,
                    }
                );
            }
            else
            {
                toasters(
                    {
                        head: "Error",
                        icon: "error",
                        msg: data.message,
                    }
                );
            }

            //$('#btnRegisterEmp').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnRegisterEmp').prop('disabled',false);
        });
    }
});

//Update admin profile
$('#frmUpdateAdmin').validate({
    debug: true,
    errorClass: "text-danger",
    validClass: 'success',
    errorElement: 'span',
    highlight: function (element, errorClass, validClass) {
        $(element).parents("div.control-group").addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".error").removeClass(errorClass).addClass(validClass);
    },
    rules: {
        name: {
            required: true,
            minlength: NAME.min,
            maxlength: NAME.max
        },
        surname: {
            required: true,
            minlength: NAME.min,
            maxlength: NAME.max
        },
        phone: {
            required: true,
            number: true,
            minlength: PHONE.min,
            maxlength: PHONE.max
        },
        salary: {
            required: true,
            number: true,
            minlength: SALARY.min,
            maxlength: SALARY.max
        }
    },
    messages: {
        name: {
            required: "First Name is required.",
            minlength: "First Name cannot be less than "+NAME.min+" characters",
            maxlength: "First Name cannot be less exceed "+NAME.max+" characters"
        },
        surname: {
            required: "Last Name is required.",
            minlength: "Last Name cannot be less than "+NAME.min+" characters",
            maxlength: "Last Name cannot be less exceed "+NAME.max+" characters"
        },
        phone: {
            required: "Phone is required.",
            minlength: "Phone cannot be less than "+PHONE.min+" digits",
            maxlength: "Phone cannot be less exceed "+PHONE.max+" digits"
        }
    }, submitHandler: function (form) {

        //$('#btnUpdateAdmin').prop('disabled',true);

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:new FormData(form),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            dataType:"JSON"
        }).success(function (data) {

            if (data.status === "success") {
                console.log('Not cool');
                toasters({
                    head: "Successful",
                    icon: "success",
                    msg: data.message,
                } );

            }else if(data.status === "warning"){
                toasters(
                    {
                        head: "Failed",
                        icon: "warning",
                        msg: data.message,
                    }
                );
            }
            else
            {
                toasters(
                    {
                        head: "Error",
                        icon: "error",
                        msg: data.message,
                    }
                );
            }

            //$('#btnUpdateAdmin').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnUpdateAdmin').prop('disabled',false);
        });
    }
});
//Change password
$('#frmChangePassword').validate({
    debug: true,
    errorClass: "text-danger",
    validClass: 'success',
    errorElement: 'span',
    highlight: function (element, errorClass, validClass) {
        $(element).parents("div.control-group").addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".error").removeClass(errorClass).addClass(validClass);
    },
    rules: {
        current_password: {
            required: true,
            maxlength: 20
        },
        password: {
            required: true,
            minlength: 4,
            maxlength: 20
        },
        confirm_password: {
            required: true,
            minlength: 4,
            maxlength: 20,
            equalTo: "#new-password"
        }
    },
    messages: {
        confirm_password: {
            required: "Confirm password is required.",
            minlength: "Confirm password cannot be less tha 4 characters",
            maxlength: "Confirm password cannot be greater than 20 characters",
            equalTo: "New password does not match confirm password"
        },
        password: {
            required: "New password is required.",
            minlength: "New password cannot be less tha 4 characters",
            maxlength: "New password cannot be greater than 20 characters"
        },
        current_password: {
            required: "Current password is required.",
            maxlength: "New password cannot be greater than 20 characters"
        }
    }, submitHandler: function (form) {

        //$('#btnChangePassword').prop('disabled',true);

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:new FormData(form),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            dataType:"JSON"
        }).success(function (data) {

            if (data.status === "success") {
                toasters({
                    head: "Successful",
                    icon: "success",
                    msg: data.message,
                } );

                $("#new-password").val('');
                $("#current-password").val('');
                $("#confirm-password").val('');

            }
            else
            {
                toasters(
                    {
                        head: "Error",
                        icon: "error",
                        msg: data.message,
                    }
                );
            }

            //$('#btnChangePassword').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnChangePassword').prop('disabled',false);
        });
    }
});
//Delete employee
$(document).on('click', '.delete-employee', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(9);

    swal({
        title: "Delete Employee",
        text: "Are you sure you want to delete an employee ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm){

        if(isConfirm) {

            $(".confirm").prop('disabled',true);

            $.ajax({
                type: 'POST',
                url: 'Employee/deleteEmployee',
                data: {employee_id: id},
                dataType: 'json'
            }).success(function(data) {

                if (data["status"] === "ok") {
                    rowID.remove();
                    swal("Deleted!", data.message, "success");
                }
                else
                {
                    toasters(
                        {
                            head : "Failed",
                            icon : "error",
                            msg : data.message
                        }
                    );
                }
                rowID.remove();

                $(".confirm").prop('disabled',false);
            }).fail(function() {
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops error occurred, try again.'
                    });
                $(".confirm").prop('disabled',false);
            });

        }
    });

});

//Clock out employee
$(document).on('click', '.clock-out', function(){

    swal({
        title: "Knock Out",
        text: "Are you sure you want to KNOCK OFF ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm){

        if(isConfirm) {

            $(".confirm").prop('disabled',true);

            $.ajax({
                type: 'POST',
                url: 'Employee/knockOff',
                dataType: 'json'
            }).success(function(data) {

                if (data["status"] === "ok") {
                    swal("Knocked Off!", data.message, "success");
                }
                else
                {
                    toasters(
                        {
                            head : "Failed",
                            icon : "error",
                            msg : data.message
                        }
                    );
                }
                $(".confirm").prop('disabled',false);
            }).fail(function() {
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops error occurred, try again.'
                    });
                $(".confirm").prop('disabled',false);
            });

        }
    });
});


//Manager
$('#frmManagerEmployeeReport').validate({
    debug: true,
    errorClass: "text-danger",
    validClass: 'success',
    errorElement: 'span',
    highlight: function (element, errorClass, validClass) {
        $(element).parents("div.control-group").addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".error").removeClass(errorClass).addClass(validClass);
    },
    rules: {
    },
    messages:{
    }
    , submitHandler: function (form) {

        $('#btnManagerEmpReport').prop('disabled',true);

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:new FormData(form),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            dataType:"JSON"
        }).success(function (data) {

            if (data.status === "success") {

                var reports = data.report;
                var total = '';

                $("#tbl-manager-emp-report tr").remove();

                if (reports.length !== 0) {

                    $.each(reports, function (i, report) {

                        ++total;

                        var row =

                            '<tr>' +
                            '<td>' + report.name + '</td>' +
                            '<td>' + report.surname + '</td>' +
                            '<td>' + report.contract_type + '</td>' +
                            '<td>' + report.email + '</td>' +
                            '<td>' + report.phone + '</td>' +
                            '<td>' + report.gender + '</td>' +
                            '<td>' + report.id_number + '</td>' +
                            '<td>' + report.role + '</td>' +
                            '<td>' + report.salary + '</td>' +

                            '</tr>';

                        $("#tbl-manager-emp-report").append(row);
                    });

                    var totalRow = '<tr>' +
                        '<th colspan="7"></th>' +
                        '<th colspan="2">Total : ' + total + '</th>' +
                        '</tr>';

                    $("#tbl-manager-emp-report").append(totalRow);
                }

            }
            else if(data.status === "warning")
            {
                toasters(
                    {
                        head: "Successful",
                        icon: "warning",
                        msg: data.message,
                    }
                );
                $('#tbl-manager-emp-report tr').remove();
            }else{
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops something went wrong.'
                    });
            }

            $('#btnManagerEmpReport').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnManagerEmpReport').prop('disabled',false);
        });
    }
});