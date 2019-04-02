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

var TASK_ID = 0;

$('#frmRegisterTask').validate({
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
        title: {
            required: true,
            minlength: 2,
            maxlength: 150
        },
        description: {
            required: true,
            minlength: 2,
            maxlength: 250
        },
        attributes: {
            required: true
        }
    },
    messages: {
        title: {
            required: "Title is required.",
            minlength: "Title cannot be less than 2 characters",
            maxlength: "Title cannot be less exceed 150 characters"
        },
        description: {
            required: "Description is required.",
            minlength: "Description cannot be less than 2 characters",
            maxlength: "Description cannot be less exceed 250 characters"
        },
        attributes: {
            required: "Attribute is required."
        }
    }, submitHandler: function (form) {

        //$('#btnRegisterTask').prop('disabled',true);

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

                var task = data.task;

                var row =
                '<tr id="row_task_' + task.task_id  +'">'+
                    '<td id="task_title_' + task.task_id   +'">'+task.title+'</td>'+
                    '<td id="task_description_' + task.task_id  +'">'+task.description+'</td>'+
                    '<td id="task_attributes_' + task.task_id  +'">'+task.attributes+'</td>'+
                    '<td>'+
                    '<a href="edit-task/'+task.task_id+'" class="btn btn-warning" title="Edit" role="button">Edit</a>'+
                    '<a class="btn btn-danger delete-task" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>'+
                    '</td>'+
                '</tr>';

                $("#tbl-task").append(row);

                $("#title").val('');
                $("#description").val('');
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
            $('#btnRegisterTask').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnRegisterTask').prop('disabled',false);
        });
    }
});

//Update task
$('#frmUpdateTask').validate({
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
        title: {
            required: true,
            minlength: 2,
            maxlength: 150
        },
        description: {
            required: true,
            minlength: 2,
            maxlength: 250
        },
        attributes: {
            required: true
        }
    },
    messages: {
        title: {
            required: "Title is required.",
            minlength: "Title cannot be less than 2 characters",
            maxlength: "Title cannot be less exceed 150 characters"
        },
        description: {
            required: "Description is required.",
            minlength: "Description cannot be less than 2 characters",
            maxlength: "Description cannot be less exceed 250 characters"
        },
        attributes: {
            required: "Attribute is required."
        }
    }, submitHandler: function (form) {

        //$('#btnUpdateTask').prop('disabled',true);
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

            //$('#btnUpdateTask').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnUpdateTask').prop('disabled',false);
        });
    }
});

//Update task Assignment
$('#frmUpdateTaskAssign').validate({
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
        vehicle: {
            required: true,
            minlength: 2,
            maxlength: 100
        },
        supervisor: {
            required: true,
            minlength: 2,
            maxlength: 250
        }
    },
    messages: {
        vehicle: {
            required: "Vehicle is required.",
            minlength: "Vehicle cannot be less than 2 characters",
            maxlength: "Vehicle cannot be less exceed 100 characters"
        },
        supervisor: {
            required: "Supervisor is required.",
            minlength: "Supervisor cannot be less than 2 characters",
            maxlength: "Supervisor cannot be less exceed 250 characters"
        }
        }
        , submitHandler: function (form) {

        //$('#btnUpdateTaskAssign').prop('disabled',true);
        //Adding an id field to the form
        //Adding an id field to the form
        $('<input />').attr('type', 'hidden')
            .attr('name', "task_id")
            .attr('value', TASK_ID)
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

                $("#task_ass_vehicle_"+TASK_ID).text(data.vehicle.vehicle_name);
                $("#task_ass_supervisor_"+TASK_ID).text(data.supervisor.name);
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

            //$('#btnUpdateTaskAssign').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnUpdateTaskAssign').prop('disabled',false);
        });
    }
});

$('#frmAssignSuperVisor').validate({
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
        vehicle: {
            required: true,
            minlength: 2,
            maxlength: 100
        },
        supervisor: {
            required: true,
            minlength: 2,
            maxlength: 250
        },
        task: {
            required: true
        }
    },
    messages: {
        vehicle: {
            required: "vehicle is required.",
            minlength: "vehicle cannot be less than 2 characters",
            maxlength: "vehicle cannot be less exceed 100 characters"
        },
        supervisor: {
            required: "Supervisor is required.",
            minlength: "Supervisor cannot be less than 2 characters",
            maxlength: "Supervisor cannot be less exceed 250 characters"
        },
        task: {
            required: "Task is required."
        }
    }, submitHandler: function (form) {

        //$('#btnUpdateTask').prop('disabled',true);
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
                //console.log(data.task);
                toasters({
                    head: "Successful",
                    icon: "success",
                    msg: data.message,
                } );

                assignTask(data.task[0]);

            }
            else{

                toasters(
                    {
                        head: "Error",
                        icon: "error",
                        msg: data.message,
                    }
                );
            }

            //$('#btnUpdateTask').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnUpdateTask').prop('disabled',false);
        });
    }
});

function assignTask(task) {

    var row =
        '<tr id="row_task_ass_' + task.task_id + '">'+
            '<td>'+  task.title  +'</td>'+
            '<td>'+  task.description  +'</td>'+
            '<td id="task_ass_supervisor_' + task.task_id + '">'+  task.supervisor  +'</td>'+
            '<td id="task_ass_vehicle_' + task.task_id + '">'+  task.vehicle_name  +'</td>'+
            '<td>'+
            '<a href="javascript:void(0)" class="btn btn-warning edit-task-assign" data-toggle="modal" data-target="#edit-task-assign" title="Edit" role="button">Edit</a>'+
            '<a class="btn btn-danger delete-task-assign" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>'+
            '</td>'+
        '</tr>';


    $("#tbl-supervisor-task").append(row);
}

$(document).on('click', '.delete-task', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(9);

    swal({
    title: "Delete Task",
    text: "Are you sure you want to delete Task ?",
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
            url: 'Task/deleteTask',
            data: {task_id: id},
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

$(document).on('click', '.delete-task-assign', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(13);

    swal({
    title: "Delete Task Assigned",
    text: "Are you sure you want to delete Task assigned ?",
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
            url: 'Task/deleteTaskAssigned',
            data: {task_id: id},
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

//Preview task assigned for
$(document).on('click', '.edit-task-assign', function(){

    var rowID = $(this).closest('tr').attr('id').substr(13);
    TASK_ID = rowID;
});

//SUPERVISOR METHODS
$('#frmAssignEmployeeTask').validate({
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
        supervisor: {
            required: true
        },
        task: {
            required: true
        }
    },
    messages: {
        employee: {
            required: "Employee is required."
        },
        task: {
            required: "Task is required."
        }
    }, submitHandler: function (form) {

        //$('#btnAssignEmployees').prop('disabled',true);
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

                var task = data.task[0];

                var row =
                    '<tr id="row_emp_task_ass_' + task.task_id + '">'+
                    '<td>'+  task.title  +'</td>'+
                    '<td>'+  task.description  +'</td>'+
                    '<td id="task_emp_' + task.task_id + '">'+  task.employee  +'</td>'+
                    '<td>'+
                    '<a href="javascript:void(0)" class="btn btn-warning edit-emp-task-assign" data-toggle="modal" data-target="#edit-emp-task-assign" title="Edit" role="button">Edit</a>'+
                    '<a class="btn btn-danger delete-emp-task-assign" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>'+
                    '</td>'+
                    '</tr>';


                $("#tbl-employee-task").append(row);

            }
            else{

                toasters(
                    {
                        head: "Error",
                        icon: "error",
                        msg: data.message,
                    }
                );
            }

            //$('#btnAssignEmployees').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnAssignEmployees').prop('disabled',false);
        });
    }
});

$('#frmUpdateEmpTaskAssign').validate({
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
        employee: {
            required: true
        }
    },
    messages: {
        employee: {
            required: "Employee is required."
        }
    }
    , submitHandler: function (form) {

        //$('#btnUpdateTaskAssign').prop('disabled',true);
        //Adding an id field to the form
        //Adding an id field to the form
        $('<input />').attr('type', 'hidden')
            .attr('name', "task_id")
            .attr('value', TASK_ID)
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

                $("#task_emp_"+TASK_ID).text(data.emp.name+' '+data.emp.surname);
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

            //$('#btnUpdateTaskAssign').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            //$('#btnUpdateTaskAssign').prop('disabled',false);
        });
    }
});
//
$('#frmSupervisorTaskReport').validate({
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

        $('#btnSuperVisorTaskReport').prop('disabled',true);
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
                var endDate = '';

                $("#tbl-supervisor-task-report tr").remove();

                if (reports.length !== 0) {

                    $.each(reports, function (i, report) {

                        ++total;

                        if(parseInt(report.status) === 1){
                            status.message = 'complete';
                            status.klass = 'label label-success label-rouded';
                            endDate = report.end_date;
                        }else{
                            status.message = 'pending';
                            status.klass = 'label label-warning label-rouded';
                            endDate = 'Pending';
                        }

                        var row =

                            '<tr>' +
                                '<td>' + report.title + '</td>' +
                                '<td>' + report.description + '</td>' +
                                '<td>' + report.employee + '</td>' +
                                '<td>' + report.start_date + '</td>' +
                                '<td>' + endDate + '</td>' +
                                '<td> <span class="'+status.klass+'">'+status.message+'</span> </td>' +
                            '</tr>';

                        $("#tbl-supervisor-task-report").append(row);
                    });

                    var totalRow = '<tr>' +
                        '<th colspan="4"></th>' +
                        '<th colspan="2">Total : ' + total + '</th>' +
                        '</tr>';

                    $("#tbl-supervisor-task-report").append(totalRow);
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
                $('#tbl-supervisor-task-report tr').remove();
            }else{
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops something went wrong.'
                    });
            }

            $('#btnSuperVisorTaskReport').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnSuperVisorTaskReport').prop('disabled',false);
        });
    }
});

$('#frmEmpTaskReport').validate({
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

        $('#btnEmpTaskReport').prop('disabled',true);
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
                var endDate = '';

                $("#tbl-emp-task-report tr").remove();

                if (reports.length !== 0) {

                    $.each(reports, function (i, report) {

                        ++total;

                        if(parseInt(report.status) === 1){
                            status.message = 'complete';
                            status.klass = 'label label-success label-rouded';
                            endDate = report.end_date;
                        }else{
                            status.message = 'pending';
                            status.klass = 'label label-warning label-rouded';
                            endDate = 'Pending';
                        }

                        var row =

                            '<tr>' +
                                '<td>' + report.title + '</td>' +
                                '<td>' + report.description + '</td>' +
                                '<td>' + report.employee + '</td>' +
                                '<td>' + report.start_date + '</td>' +
                                '<td>' + endDate + '</td>' +
                                '<td> <span class="'+status.klass+'">'+status.message+'</span> </td>' +
                            '</tr>';

                        $("#tbl-emp-task-report").append(row);
                    });

                    var totalRow = '<tr>' +
                        '<th colspan="4"></th>' +
                        '<th colspan="2">Total : ' + total + '</th>' +
                        '</tr>';

                    $("#tbl-emp-task-report").append(totalRow);
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
                $('#tbl-emp-task-report tr').remove();
            }else{
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops something went wrong.'
                    });
            }

            $('#btnEmpTaskReport').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnEmpTaskReport').prop('disabled',false);
        });
    }
});

$(document).on('click', '.edit-emp-task-assign', function(){

    var rowID = $(this).closest('tr').attr('id').substr(17);
    TASK_ID = rowID;
});

$(document).on('click', '.delete-emp-task-assign', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(17);

    swal({
        title: "Delete Task Assigned",
        text: "Are you sure you want to delete Task assigned ?",
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
                url: 'Task/deleteEmpTaskAssigned',
                data: {task_id: id},
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

$(document).on('click', '.task-complete', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(19);

    swal({
        title: "Complete Task",
        text: "Are you sure task is complete ?",
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
                url: 'Task/updateEmpTaskStatus',
                data: {task_id: id},
                dataType: 'json'
            }).success(function(data) {

                if (data["status"] === "success") {
                    rowID.remove();
                    swal("Deleted!", data.message, "success");
                }
                else
                {
                    toasters(
                        {
                            head : "Failed",
                            icon : "error",
                            msg : 'Something went wrong'
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

//Manager

$('#frmManagerTaskReport').validate({
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

        $('#btnManagerTaskReport').prop('disabled',true);
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
                var endDate = '';

                $("#tbl-manager-task-report tr").remove();

                if (reports.length !== 0) {

                    $.each(reports, function (i, report) {

                        ++total;

                        endDate = report.end_date;

                        if(parseInt(report.status) === 1){
                            status.message = 'complete';
                            status.klass = 'label label-success label-rouded';
                        }else if(parseInt(report.status) === 0 && report.employee !== 'No Supervisor Yet'){
                            status.message = 'pending';
                            status.klass = 'label label-warning label-rouded';
                        }else{
                            status.message = 'Not Assigned';
                            status.klass = 'label label-danger label-rouded';
                        }

                        var row =

                            '<tr>' +
                            '<td>' + report.title + '</td>' +
                            '<td>' + report.description + '</td>' +
                            '<td>' + report.employee + '</td>' +
                            '<td>' + report.start_date + '</td>' +
                            '<td>' + endDate + '</td>' +
                            '<td> <span class="'+status.klass+'">'+status.message+'</span> </td>' +
                            '</tr>';

                        $("#tbl-manager-task-report").append(row);
                    });

                    var totalRow = '<tr>' +
                        '<th colspan="4"></th>' +
                        '<th colspan="2">Total : ' + total + '</th>' +
                        '</tr>';

                    $("#tbl-manager-task-report").append(totalRow);
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
                $('#tbl-manager-task-report tr').remove();
            }else{
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops something went wrong.'
                    });
            }

            $('#btnManagerTaskReport').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnManagerTaskReport').prop('disabled',false);
        });
    }
});