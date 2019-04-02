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


var ATTRIBUTE_ID = 0;

$('#frmAddAttribute').validate({
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
        description: {
            required: true,
            minlength: 2,
            maxlength: 250
        }
    },
    messages: {
        description: {
            required: "Description is required.",
            minlength: "Description cannot be less than 2 characters",
            maxlength: "Description cannot be greater than 250 characters."
        }
    }, submitHandler: function (form) {

        $('#btnAddAttribute').prop('disabled',true);

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

                var attribute = data.attribute;

                var row =
                    '<tr id="row_attribute_' + attribute.attribute_id  +'">'+
                        '<td id="attribute_description_' + attribute.attribute_id   +'">'+attribute.description+'</td>'+
                        '<td id="attribute_emp_no_' + attribute.attribute_id  +'">'+attribute.numberOfEmployees+'</td>'+
                        '<td id="attribute_task_no_' + attribute.attribute_id  +'">'+attribute.numberOfTasks+'</td>'+
                        '<td>'+
                        '<a href="javascript:void(0)" class="btn btn-warning edit-attribute" data-toggle="modal" data-target="#edit-attribute" title="Edit" role="button">Edit</a>'+
                        '<a class="btn btn-danger delete-attribute" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>'+
                        '</td>'+
                    '</tr>';

                $("#tbl-attributes").append(row);

                $("#attributeDescription").text('');
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
            $('#btnAddAttribute').prop('disabled',false);
        }).fail(function() {
            toasters(
                {
                    icon: 'error',
                    head: 'Error',
                    msg:  'Oops error occurred'
                });

            $('#btnAddAttribute').prop('disabled',false);
        });
    }
});

$('#frmEditAttribute').validate({
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
        description: {
            required: true,
            minlength: 2,
            maxlength: 250
        }
    },
    messages: {
        description: {
            required: "Description is required.",
            minlength: "Description cannot be less than 2 characters",
            maxlength: "Description cannot be greater than 250 characters."
        }
    }, submitHandler: function (form) {

        //$('#btnEditAttribute').prop('disabled',true);

        $('<input />').attr('type', 'hidden')
            .attr('name', "attribute_id")
            .attr('value', ATTRIBUTE_ID)
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

                var attribute = data.attribute;

                $("#attribute_emp_no_"+attribute.attribute_id).text(attribute.numberOfEmployees);
                $("#attribute_description_"+attribute.attribute_id).text(attribute.description);
                $("#attribute_task_no_"+attribute.attribute_id).text(attribute.numberOfTasks);
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

$(document).on('click', '.delete-attribute', function(){

    var rowID = $(this).closest('tr');
    var id = (rowID.attr('id')).substr(14);

    swal({
        title: "Delete Attribute",
        text: "Are you sure you want to delete Attribute ?",
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
                url: 'Attribute/deleteAttribute',
                data: {attribute_id: id},
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

//Preview attribute assigned for
$(document).on('click', '.edit-attribute', function(){
    var rowID = $(this).closest('tr').attr('id').substr(14);
    ATTRIBUTE_ID = rowID;

    $("#attributeDescription-edit").text($("#attribute_description_"+ATTRIBUTE_ID).text());
});