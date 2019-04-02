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

var SERVICE_ID = 0,
    VEHICLE_SERVICE_ID = 0;

$('#frmAddService').validate({
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
        service_type: {
            required: true,
            minlength: 2,
            maxlength: 250
        }
    },
    messages: {
        service_type: {
            required: "Service is required.",
            minlength: "Service cannot be less than 2 characters",
            maxlength: "Service cannot be greater than 250 characters"
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

                var service = data.service;
                var row =
                    '<tr id="row_service_list_' + service.service_id  +'">'+
                    '<td id="service_type_' + service.service_id  +'">'+service.service_type+'</td>'+
                    '<td id="service_vehicles_no_' + service.service_id  +'">'+service.numberOfVehicles+'</td>'+
                    '<td>'+
                    '<a href="javascript:void(0)" class="btn btn-warning edit-service" data-toggle="modal" data-target="#edit-service" title="Edit" role="button">Edit</a>'+
                    '<a class="btn btn-danger delete-service" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>'+
                    '</td>'+
                     '</tr>';

                $("#tbl-service").append(row);

                $("#service-type").val('');
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

$('#frmEditService').validate({
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
        service_type: {
            required: true,
            minlength: 2,
            maxlength: 250
        }
    },
    messages: {
        service_type: {
            required: "Service is required.",
            minlength: "Service cannot be less than 2 characters",
            maxlength: "Service cannot be greater than 250 characters"
        }
    }, submitHandler: function (form) {

        $('#btnEditService').prop('disabled',true);

        //Adding an id field to the form
        $('<input />').attr('type', 'hidden')
            .attr('name', "service_id")
            .attr('value', SERVICE_ID)
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

            var service = data.service;
            $("#service_type_"+ service.service_id).text(service.service_type);
            $('#btnEditService').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnEditService').prop('disabled',false);
        });
    }
});
//Assign Service
$('#frmAssignService').validate({
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
        service_date: {
            required: true
        },
        price: {
            required: true,
            number: true,
            minlength: 1,
            maxlength: 13
        }
    },
    service_date: {
        service_type: {
            required: "Next service date is required"
        },
        price: {
            required: "Price is required.",
            minlength: "Price cannot be less than 1 digits",
            maxlength: "Price cannot be less exceed 13 digits"
        }
    }, submitHandler: function (form) {

        //$('#btnAssignService').prop('disabled',true);

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
                });

                var service = data.service_assigned;

                var row =
                        '<tr id="row_service_ass_' + service.vehicle_service_id + '">'+
                            '<td id="service_ass_name_' + service.vehicle_service_id + '">' + service.vehicle_name + '</td>'+
                            '<td id="service_ass_reg_' + service.vehicle_service_id + '">' + service.vehicle_registration_number + '</td>'+
                            '<td id="service_ass_date_' + service.vehicle_service_id + '">' +  service.next_service_date + '</td>'+
                            '<td id="service_ass_type_' + service.vehicle_service_id + '">' + service.service_type + '</td>'+
                            '<td id="service_ass_price_' + service.vehicle_service_id + '">' + service.price + '</td>'+
                            '<td>'+
                            '<a href="javascript:void(0)" class="btn btn-warning edit-ass-service" data-toggle="modal" data-target="#edit-ass-service" title="Edit" role="button">Edit</a>'+
                            '<a class="btn btn-danger delete-ass-service" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>'+
                            '</td>'+
                        '</tr>';

                $("#tbl-service-assign").append(row);

                $("#vehicle-assign-service-date").val('');
                $("#service-price").val('');
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
            $('#btnAssignService').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnAssignService').prop('disabled',false);
        });
    }
});

$('#frmEditServiceAssign').validate({
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
        service_date: {
            required: true
        },
        price: {
            required: true,
            number: true,
            minlength: 1,
            maxlength: 13
        }
    },
    service_date: {
        service_type: {
            required: "Next service date is required"
        },
        price: {
            required: "Price is required.",
            minlength: "Price cannot be less than 1 digits",
            maxlength: "Price cannot be less exceed 13 digits"
        }
    }, submitHandler: function (form) {

        //$('#btnAssignService').prop('disabled',true);

        //Adding an id field to the form
        $('<input />').attr('type', 'hidden')
            .attr('name', "vehicle_service_id")
            .attr('value', VEHICLE_SERVICE_ID)
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

                var service_vehicle = data.service_vehicle;
                console.log(service_vehicle);
                $("#service_ass_date_"+ service_vehicle.vehicle_service_id).text(service_vehicle.next_service_date);
                $("#service_ass_price_"+ service_vehicle.vehicle_service_id).text(service_vehicle.price);
            }
            else
            {
                toasters(
                    {
                        head: "Error",
                        icon: "error",
                        msg: data.message
                    }
                );
            }
            $('#btnEditServiceAss').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnEditServiceAss').prop('disabled',false);
        });
    }
});

//Edit service assign
$(document).on('click', '.edit-ass-service', function (e) {

    VEHICLE_SERVICE_ID = ($(this ).closest("tr").attr('id')).substr(16);

    var service_date = $("#service_ass_date_"+ VEHICLE_SERVICE_ID).text();
    var price = $("#service_ass_price_"+ VEHICLE_SERVICE_ID).text();

    $("#vehicle-assign-service-date-edit").val(service_date);
    $("#service-price-edit").val(price);
});

$(document).on('click', '.edit-service', function (e) {

    SERVICE_ID = ($(this ).closest("tr").attr('id')).substr(17);

    var serviceType = $("#service_type_"+ SERVICE_ID).text();

    $("#service-type-edit").val(serviceType);
});

$(document).on('click', '.delete-service', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(17);

    swal({
        title: "Delete Service",
        text: "Are you sure you want to delete Service ?",
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
                url: 'Service/deleteService',
                data: {service_id: id},
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

$(document).on('click', '.delete-ass-service', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(16);

    swal({
        title: "Delete Assigned Service",
        text: "Are you sure you want to delete Service assigned ?",
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
                url: 'Service/deleteAssignedService',
                data: {service_id: id},
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