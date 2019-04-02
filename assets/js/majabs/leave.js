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

var LEAVE_ID = 0,
    EMP_LEAVE_ID = 0,
    LEAVE_HANDLER_ID = 0,
    EMP_ID = 0;

$('#frmAddLeave').validate({
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
        type: {
            required: true,
            minlength: 1,
            maxlength: 150
        },
        description: {
            required: true,
            minlength: 2,
            maxlength: 250
        },
        days: {
            required: true,
            number: true,
            minlength: 1,
            maxlength: 10
        }
    },
    messages: {
        type: {
            required: "Leave type is required.",
            minlength: "Leave type cannot be less than 1 characters",
            maxlength: "Leave type cannot be less exceed 150 characters"
        },
        description: {
            required: "Description is required.",
            minlength: "Description cannot be less than 2 characters",
            maxlength: "Description cannot be less exceed 250 characters"
        },
        days: {
            required: "days is required.",
            minlength: "days cannot be less than 1 digits",
            maxlength: "days cannot be less exceed 10 digits"
        }
    }, submitHandler: function (form) {

        $('#btnAddLeave').prop('disabled',true);

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

                var leave = data.leave;

                var row =
                    '<tr id="row_leave_' + leave.leave_id  +'">'+
                        '<td id="leave_type_' + leave.leave_id   +'">'+leave.type+'</td>'+
                        '<td id="leave_description_' + leave.leave_id  +'">'+leave.description+'</td>'+
                        '<td id="leave_days_' + leave.leave_id  +'">'+leave.days+'</td>'+
                        '<td id="leave_emp_' + leave.leave_id  +'">'+leave.employeesOnLeave+'</td>'+
                        '<td>'+
                        '<a href="javascript:void(0)" class="btn btn-warning edit-leave" data-toggle="modal" data-target="#edit-leave" title="Edit" role="button">Edit</a>'+
                        '<a class="btn btn-danger delete-leave" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>'+
                        '</td>'+
                    '</tr>';

                $("#tbl-leave").append(row);

                $("#leave-type").val('');
                $("#leave-description").val('');
                $("#leave-days").val('');
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
            $('#btnAddLeave').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnAddLeave').prop('disabled',false);
        });
    }
});

$('#frmEditLeave').validate({
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
        type: {
            required: true,
            minlength: 1,
            maxlength: 150
        },
        description: {
            required: true,
            minlength: 2,
            maxlength: 250
        },
        days: {
            required: true,
            number: true,
            minlength: 1,
            maxlength: 10
        }
    },
    messages: {
        type: {
            required: "Leave type is required.",
            minlength: "Leave type cannot be less than 1 characters",
            maxlength: "Leave type cannot be less exceed 150 characters"
        },
        description: {
            required: "Description is required.",
            minlength: "Description cannot be less than 2 characters",
            maxlength: "Description cannot be less exceed 250 characters"
        },
        days: {
            required: "days is required.",
            minlength: "days cannot be less than 1 digits",
            maxlength: "days cannot be less exceed 10 digits"
        }
    }, submitHandler: function (form) {

        $('#btnEditAttribute').prop('disabled',true);

        $('<input />').attr('type', 'hidden')
            .attr('name', "leave_id")
            .attr('value', LEAVE_ID)
            .appendTo(form);

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

                var leave = data.leave;

                $("#leave_type_"+leave.leave_id).text(leave.type);
                $("#leave_description_"+leave.leave_id).text(leave.description);
                $("#leave_days_"+leave.leave_id).text(leave.days);
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
            $('#btnEditAttribute').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnEditAttribute').prop('disabled',false);
        });
    }
});

$(document).on('click', '.delete-leave', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(10);

    swal({
        title: "Delete Leave",
        text: "Are you sure you want to delete Leave ?",
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
                url: 'Leave/deleteLeave',
                data: {leave_id: id},
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
                        });

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

//Get the selected leave type
$("select.leaves").change(function(){
    var id = $(this).children("option:selected").val();
    var leaveDaysBalance = $("#days_left"),
        description = $("#leave-description");

    //Lets get a description and days balance of that employee

    $.ajax({
        type: 'GET',
        url: 'Leave/getLeaveDescBalance',
        data: {leave_id: id},
        dataType: 'json'
    }).success(function(data) {

        if (data["status"] === "ok") {
            leaveDaysBalance.val(data.daysBalance);
            description.text(data.description);
        }
        else
        {
            toasters(
                {
                    head : "Failed",
                    icon : "error",
                    msg : data.message
                });

        }
    }).fail(function() {
        toasters(
            {
                icon: 'error',
                head: 'Error',
                msg:  'Oops error occurred, try again.'
            });
    });

});

//Apply for leave
$('#frmApplyLeave').validate({
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
        leave_type: {
            required: true,
            min: 1
        },
        date_from: {
            required: true
        },
        date_to: {
            required: true
        },
        reason: {
            required: true,
            minlength: 10,
            maxlength: 250
        }
    },
    messages: {
        leave_type: {
            required: "Leave type is required.",
            min: "Pick a leave type."
        },
        date_from: {
            required: "Date from is required."
        },
        date_to: {
            required: "Date to is required."
        },
        reason: {
            required: "days is required.",
            minlength: "Reason cannot be less than 10 characters",
            maxlength: "Reason cannot be less exceed 250 characters"
        }
    }, submitHandler: function (form) {

        //$('#btnApplyLeave').prop('disabled',true);

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:new $(form).serializeArray(),
            dataType:"JSON"
        }).success(function (data) {

            if (data.status === "ok") {

                toasters({
                    head: "Successful",
                    icon: "success",
                    msg: data.message,
                } );

                $("#leave-to").val('');
                $("#leave-from").val('');
                $("#leave-description").text('');
                $("#reason").val('');
                $("#days_left").val('');
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
            $('#btnApplyLeave').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnApplyLeave').prop('disabled',false);
        });
    }
});

$('#frmRetrieveLeaveReport').validate({
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
        date_from: {
            required: true
        },
        date_to: {
            required: true
        }
    },
    messages: {
        date_from: {
            required: "This date is required."
        },
        date_to: {
            required: "This date is required."
        }
    }
    , submitHandler: function (form) {

        $('#btnLeaveHistory').prop('disabled',true);
        var total = 0;
        var status = {
            klass: '',
            message: ''
        };

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

                $("#tbl-emp-leave-report tr").remove();

                if (reports.length !== 0) {

                    $.each(reports, function (i, report) {

                        ++total;

                        if(parseInt(report.status) === 1){
                            status.message = 'approved';
                            status.klass = 'label label-success label-rouded';
                        }else if(parseInt(report.status) === 0){
                            status.message = 'pending';
                            status.klass = 'label label-info label-rouded';
                        }else {
                            status.message = 'rejected';
                            status.klass = 'label label-danger label-rouded';
                        }

                        var row =

                            '<tr>' +
                            '<td>' + report.type + '</td>' +
                            '<td>' + report.description + '</td>' +
                            '<td>' + report.date_from + '</td>' +
                            '<td>' + report.date_to + '</td>' +
                            '<td> <span class="'+status.klass+'">'+status.message+'</span> </td>' +
                            '</tr>';

                        $("#tbl-emp-leave-report").append(row);
                    });

                    /*var totalRow = '<tr>' +
                        '<th colspan="4"></th>' +
                        '<th colspan="2">Total : ' + total + '</th>' +
                        '</tr>';

                    $("#tbl-emp-leave-report").append(totalRow);*/
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
                $('#tbl-emp-leave-report tr').remove();
            }else{
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops something went wrong.'
                    });
            }

            $('#btnLeaveHistory').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnLeaveHistory').prop('disabled',false);
        });
    }
});

//Preview attribute assigned for
$(document).on('click', '.edit-leave', function(){
    var rowID = $(this).closest('tr').attr('id').substr(10);
    LEAVE_ID = rowID;

    $("#type-edit").val($("#leave_type_"+LEAVE_ID).text());
    $("#description-edit").val($("#leave_description_"+LEAVE_ID).text());
    $("#days-edit").val($("#leave_days_"+LEAVE_ID).text());
});

//Employee staff

//Apply leave
//Get the selected leave type
$("select.empLeaves").change(function(){
    var id = $(this).children("option:selected").val();
    var leaveDaysBalance = $("#emp-days_left"),
        description = $("#emp-leave-description");

    //Lets get a description and days balance of that employee

    $.ajax({
        type: 'GET',
        url: 'Leave/getLeaveDescBalance',
        data: {leave_id: id},
        dataType: 'json'
    }).success(function(data) {

        if (data["status"] === "ok") {
            leaveDaysBalance.val(data.daysBalance);
            description.text(data.description);
        }
        else
        {
            toasters(
                {
                    head : "Failed",
                    icon : "error",
                    msg : data.message
                });

        }
    }).fail(function() {
        toasters(
            {
                icon: 'error',
                head: 'Error',
                msg:  'Oops error occurred, try again.'
            });
    });

});

//Apply for leave
$('#frmApplyEmpLeave').validate({
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
        leave_type: {
            required: true,
            min: 1
        },
        date_from: {
            required: true
        },
        date_to: {
            required: true
        },
        reason: {
            required: true,
            minlength: 10,
            maxlength: 250
        }
    },
    messages: {
        leave_type: {
            required: "Leave type is required.",
            min: "Pick a leave type."
        },
        date_from: {
            required: "Date from is required."
        },
        date_to: {
            required: "Date to is required."
        },
        reason: {
            required: "days is required.",
            minlength: "Reason cannot be less than 10 characters",
            maxlength: "Reason cannot be less exceed 250 characters"
        }
    }, submitHandler: function (form) {

        $('#btnApplyEmpLeave').prop('disabled',true);

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:new $(form).serializeArray(),
            dataType:"JSON"
        }).success(function (data) {

            if (data.status === "ok") {

                toasters({
                    head: "Successful",
                    icon: "success",
                    msg: data.message,
                } );

                $("#emp-leave-to").val('');
                $("#emp-leave-from").val('');
                $("#emp-leave-description").text('');
                $("#emp-reason").val('');
                $("#emp-days_left").val('');
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
            $('#btnApplyEmpLeave').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnApplyEmpLeave').prop('disabled',false);
        });
    }
});

$('#frmRetrieveEmpLeaveReport').validate({
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
        date_from: {
            required: true
        },
        date_to: {
            required: true
        }
    },
    messages: {
        date_from: {
            required: "This date is required."
        },
        date_to: {
            required: "This date is required."
        }
    }
    , submitHandler: function (form) {

        $('#btnEmpLeaveHistory').prop('disabled',true);

        var total = 0;
        var status = {
            klass: '',
            message: ''
        };

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

                $("#tbl-leave-report tr").remove();

                if (reports.length !== 0) {

                    $.each(reports, function (i, report) {

                        ++total;

                        if(parseInt(report.status) === 1){
                            status.message = 'approved';
                            status.klass = 'label label-success label-rouded';
                        }else if(parseInt(report.status) === 0){
                            status.message = 'pending';
                            status.klass = 'label label-info label-rouded';
                        }else {
                            status.message = 'rejected';
                            status.klass = 'label label-danger label-rouded';
                        }

                        var row =

                            '<tr>' +
                            '<td>' + report.type + '</td>' +
                            '<td>' + report.description + '</td>' +
                            '<td>' + report.date_from + '</td>' +
                            '<td>' + report.date_to + '</td>' +
                            '<td> <span class="'+status.klass+'">'+status.message+'</span> </td>' +
                            '</tr>';

                        $("#tbl-leave-report").append(row);
                    });

                    /*var totalRow = '<tr>' +
                        '<th colspan="4"></th>' +
                        '<th colspan="2">Total : ' + total + '</th>' +
                        '</tr>';

                    $("#tbl-emp-leave-report").append(totalRow);*/
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
                $('#tbl-leave-report tr').remove();
            }else{
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops something went wrong.'
                    });
            }

            $('#btnEmpLeaveHistory').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnEmpLeaveHistory').prop('disabled',false);
        });
    }
});

//Manager
$(document).on('click', '.approve-leave', function(){
    var rowID = $(this).closest('tr');
    EMP_LEAVE_ID = rowID.attr('id').substr(6);
    var empID = $("#approve-emp-id_"+EMP_LEAVE_ID).val();
    var leaveID = $("#approve-leave-id_"+EMP_LEAVE_ID).val();

    swal({
        title: "Approve Leave",
        text: "Are you sure you want to approve Leave request?",
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
                url: 'Leave/approveLeave',
                data: {emp_leave_id:EMP_LEAVE_ID,emp_id:empID,leave_id: leaveID},
                dataType: 'json'
            }).success(function(data) {

                if (data["status"] === "ok") {
                    rowID.remove();
                    swal("Approved!!", data.message, "success");
                }
                else
                {
                    toasters(
                        {
                            head : "Failed",
                            icon : "error",
                            msg : data.message
                        });

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

$(document).on('click', '.reject-leave', function(){
    var rowID = $(this).closest('tr');
    EMP_LEAVE_ID = rowID.attr('id').substr(6);

    LEAVE_HANDLER_ID = $("#leave-handler-id_"+EMP_LEAVE_ID).val();
    LEAVE_ID = $("#approve-leave-id_"+EMP_LEAVE_ID).val();
    var empID = $("#approve-emp-id_"+EMP_LEAVE_ID).val();

    swal({
        title: "Approve Leave",
        text: "Are you sure you want to approve Leave request?",
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
                url: 'Leave/rejectLeave',
                data: {leave_id: LEAVE_ID, leave_handler_id:LEAVE_HANDLER_ID, emp_leave_id:EMP_LEAVE_ID,emp_id:empID},
                dataType: 'json'
            }).success(function(data) {

                if (data["status"] === "ok") {
                    rowID.remove();
                    swal("Approved!!", data.message, "success");
                }
                else
                {
                    toasters(
                        {
                            head : "Failed",
                            icon : "error",
                            msg : data.message
                        });

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
