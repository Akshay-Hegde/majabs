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

var NOTIFICATION_ID = 0;

//Preview information to the modal
$(document).on('click', '.read-message', function (e) {

    NOTIFICATION_ID = ($(this ).closest("td").attr('id')).substr(8);

    $.ajax({
        type: 'GET',
        url: 'Notification/getMessage',
        data:{id:NOTIFICATION_ID},
        dataType:"JSON"
    }).success(function (data) {

        if (data.status === "success") {

            var message = data.notification;
            var sender = data.sender;

            $("#msg-title").text(message.title);
            $("#msg-time").text(message.time);
            $("#msg").text(message.message);
            $("#msg-sender").text($("#sender_"+NOTIFICATION_ID).val());
            $("#sender-email").text($("#sender_email_"+NOTIFICATION_ID).val());
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

    }).fail(function() {
        toasters(
            {
                icon: 'error',
                head: 'Error',
                msg:  'Oops error occurred'
            });
    });
});
