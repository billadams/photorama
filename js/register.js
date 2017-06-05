$("#ajax-registerform").validate({
    rules:
        {
            username:
                {
                    required: true,
                    minlength: 3
                },
            email:
                {
                    required: true,
                    email: true
                },
            password:
                {
                    required: true,
                    minlength: 8,
                    maxlength: 15
                },
            confirm_password:
                {
                    required: true,
                    equalTo: '#password'
                }
        },
    messages:
        {
            username: "Please enter a user name",
            password:
                {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long"
                },
            email: "Please enter a valid email address",
            confirm_password:
                {
                    required: "Please retype your password",
                    equalTo: "Passwords do no match"
                }
        },
    submitHandler: submitForm
});

function submitForm() {
    var data = $("#ajax-registerform").serialize();

    $.ajax({

        type: 'POST',
        url: 'index.php?name=action&value=register',
        data: data,
        beforeSend: function() {
            $("#ajax-info").fadeIn(1000);
            $("#register-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Sending...');
        },
        success: function(data) {
            if (data === 1) {

                $("#ajax-info").fadeIn(1000, function() {

                   $("#ajax-info").html('<div class="alert alert-danger">' +
                       '<span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry, that email address is already taken!</div>');

                   // $("#register-submit").html('<span class="glyphicon glyphicon-log-in"></span>span> &nbsp; Create Account');
                });
            } else if (data === "registered") {

                $("#register-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Signing Up...');
            } else {
                $("#ajax-info").fadeIn(1000, function() {
                    $("#ajax-info").html('<div class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-ok"></span> &nbsp; Registration complete!</div>');
                    $("#ajax-registerform").trigger("reset");
                    $("#register-submit").html('Register Now');
                }).fadeOut(5000);
            }
        }
    });
    return false;
}
