<?php // send email not working 
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Forgot Password</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3" align="center" style="margin-top:100px">
                <input type="email" class="form-control" id="email" /><br />
                <input type="button" class="btn btn-primary" value="Send" id="btn" />
                <p id="response" class="mt-5">
                </p>
            </div>
        </div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var email = $('#email');

            $('#btn').on('click', function() {
                if (email.val() != '') {
                    email.css('border', '1px solid green');

                    $.ajax({
                        url: 'forgotPassword.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            email: email.val()
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#response').html(response.message).css("color", "green");
                            } else {
                                $('#response').html(response.error).css("color", "red");
                            }
                        }
                    });
                } else {
                    console.log("tetod");
                    email.css('border', '1px solid red');
                }
            });
        });
    </script>
</body>

</html>