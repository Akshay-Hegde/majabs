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

var  VEHICLE_ID = 0;

$('#frmAddVehicle').validate({
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
        vehicle_name: {
            required: true,
            minlength: 2,
            maxlength: 50
        },
        vehicle_reg_number: {
            required: true,
            minlength: 3,
            maxlength: 50
        },
        service_date: {
            required: true
        },
        vehicle_disc_expiry: {
            required: true
        }
    },
    messages: {
        vehicle_name: {
            required: "vehicle Name is required.",
            minlength: "vehicle Name cannot be less than 2 characters",
            maxlength: "vehicle Name cannot be less exceed 50 characters"
        },
        vehicle_reg_number: {
            required: "Vehicle registration number is required.",
            minlength: "Vehicle registration number cannot be less than 3 digits",
            maxlength: "Vehicle registration number cannot be greater than 50 digits"
        },
        service_date: {
            required: "Service date is required."
        },
        vehicle_disc_expiry: {
            required: "Vehicle disc expiry date is required."
        }
    }, submitHandler: function (form) {

        $('#btnAddVehicle').prop('disabled',true);

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

                var vehicle = data.vehicle;
                var row =
                    '<tr id="row_vehcle_list_'+vehicle.vehicle_id+'">' +
                        '<td id="vehicle_name_'+vehicle.vehicle_id+'">'+vehicle.vehicle_name+'</td>' +
                        '<td id="vehicle_reg_'+vehicle.vehicle_id+'">'+vehicle.reg_number+'</td>' +
                        '<td id="vehicle_disc_date_'+vehicle.vehicle_id+'">'+vehicle.disc_expiry_date+' </td>' +
                        '<td id="vehicle_service_date_'+vehicle.vehicle_id+'">'+vehicle.service_date+'</td>' +
                        '<td>'+
                            '<a href="javascript:void(0)" class="btn btn-warning edit-vehicle" data-toggle="modal" data-target="#edit-vehicle" title="Edit" role="button">Edit</a>'+
                            '<a class="btn btn-danger delete-vehicle" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>'+
                        '</td>'+
                    '</tr>';

                $("#tbl-vehicle").append(row);

                $("#vehicle-name").val('');
                $("#vehicle-reg-number").val('');
                $("#next-service-date").val('');
                $("#vehicle-disc-expiry").val('');

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
            $('#btnAddVehicle').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnAddVehicle').prop('disabled',false);
        });
    }
});

$('#frmEditVehicle').validate({
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
        vehicle_name: {
            required: true,
            minlength: 2,
            maxlength: 50
        },
        vehicle_reg_number: {
            required: true,
            minlength: 3,
            maxlength: 50
        },
        service_date: {
            required: true
        },
        license_expiry_date: {
            required: true
        },
        vehicle_disc_expiry: {
            required: true
        }
    },
    messages: {
        vehicle_name: {
            required: "vehicle Name is required.",
            minlength: "vehicle Name cannot be less than 2 characters",
            maxlength: "vehicle Name cannot be less exceed 50 characters"
        },
        vehicle_reg_number: {
            required: "Vehicle registration number is required.",
            minlength: "Vehicle registration number cannot be less than 3 digits",
            maxlength: "Vehicle registration number cannot be greater than 50 digits"
        },
        service_date: {
            required: "Service date is required."
        },
        vehicle_disc_expiry: {
            required: "Vehicle disc expiry date is required."
        }
    }, submitHandler: function (form) {

        $('#btnEditVehicle').prop('disabled',true);

        //Adding an id field to the form
        $('<input />').attr('type', 'hidden')
            .attr('name', "vehicle_id")
            .attr('value', VEHICLE_ID)
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

            var vehicle = data.vehicle;
            console.log(vehicle);
            $("#vehicle_name_"+vehicle.vehicle_id).text(vehicle.vehicle_name);
            $("#vehicle_reg_"+vehicle.vehicle_id).text(vehicle.reg_number);
            $("#vehicle_disc_date_"+vehicle.vehicle_id).text(vehicle.disc_expiry_date);
            $("#vehicle_service_date_"+vehicle.vehicle_id).text(vehicle.service_date);

            $('#btnEditVehicle').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnEditVehicle').prop('disabled',false);
        });
    }
});

//Preview information to the modal
$(document).on('click', '.edit-vehicle', function (e) {

    VEHICLE_ID = ($(this ).closest("tr").attr('id')).substr(16);

    var name = $('#vehicle_name_'+ VEHICLE_ID).text(),
        reg_number = $('#vehicle_reg_'+ VEHICLE_ID).text(),
        service_date = $('#vehicle_service_date_'+ VEHICLE_ID).text(),
        disc_expiry = $('#vehicle_disc_date_'+ VEHICLE_ID).text();

    $("#vehicle-name-edit").val(name);
    $("#vehicle-reg-number-edit").val(reg_number);
    $("#next-service-date-edit").val(service_date);
    $("#vehicle-disc-expiry-edit").val(disc_expiry);
});

$(document).on('click', '.delete-vehicle', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(16);

    swal({
        title: "Delete Vehicle",
        text: "Are you sure you want to delete vehicle ?",
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
                url: 'Vehicle/deleteVehicle',
                data: {vehicle_id: id},
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


//Manager

$('#frmManagerVehicleReport').validate({
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
    messages:{
        date_from: {
            required: "This date is required"
        },
        date_to: {
            required: "This date is required"
        }
    }
    , submitHandler: function (form) {

        $('#btnManagerVehicleReport').prop('disabled',true);
        var total = 0;

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

                $("#tbl-manager-vehicle-report tr").remove();

                if (reports.length !== 0) {

                    $.each(reports, function (i, report) {

                        ++total;

                        var row =

                            '<tr>' +
                            '<td>' + report.vehicle_name + '</td>' +
                            '<td>' + report.vehicle_registration_number + '</td>' +
                            '<td>' + report.disc_expiry_date + '</td>' +
                            '<td>' + report.next_service_date + '</td>' +
                            '</tr>';

                        $("#tbl-manager-vehicle-report").append(row);
                    });

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
                $('#tbl-manager-vehicle-report tr').remove();
            }else{
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops something went wrong.'
                    });
            }

            $('#btnManagerVehicleReport').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnManagerVehicleReport').prop('disabled',false);
        });
    }
});

$('#frmManagerServiceReport').validate({
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
    messages:{
        date_from: {
            required: "This date is required"
        },
        date_to: {
            required: "This date is required"
        }
    }
    , submitHandler: function (form) {

        $('#btnManagerVehicleServiceReport').prop('disabled',true);
        var total = 0;

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

                $("#tbl-manager-service-vehicle-report tr").remove();

                if (reports.length !== 0) {

                    $.each(reports, function (i, report) {

                        ++total;

                        var row =

                            '<tr>' +
                            '<td>' + report.vehicle_name + '</td>' +
                            '<td>' + report.vehicle_registration_number + '</td>' +
                            '<td>' + report.disc_expiry_date + '</td>' +
                            '<td>' + report.next_service_date + '</td>' +
                            '</tr>';

                        $("#tbl-manager-service-vehicle-report").append(row);
                    });

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
                $('#tbl-manager-service-vehicle-report tr').remove();
            }else{
                toasters(
                    {
                        icon: 'error',
                        head: 'Error',
                        msg:  'Oops something went wrong.'
                    });
            }

            $('#btnManagerVehicleServiceReport').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnManagerVehicleServiceReport').prop('disabled',false);
        });
    }
});