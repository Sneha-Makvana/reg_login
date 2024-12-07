<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Log In</title>
    <style>
        img {
            height: 100%;
            width: 100%;
        }

        span {
            color: red;
        }

        .errorVal {
            color: red;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <section class="vh-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="s2.jpg" alt="login form" class="" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form id="loginForm">
                                        <h5 class="fw-normal mb-3 pb-3 fs-2" style="letter-spacing: 1px;">Login into your account</h5>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="">Email address</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                            <div class="error-message errorVal" id="error-email"></div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="">Password</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                            <div class="error-message errorVal" id="error-password"></div>
                                        </div>

                                        <div class="mb-4 form-check">
                                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                            <label for="remember" class="form-check-label">Remember Me</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button type="submit" class="btn btn-dark btn-lg btn-block">Login</button>
                                        </div>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="/register" style="color: #393f81;">Register here</a></p>
                                        <div id="message"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                $(".error-message").html("");

                var formData = new FormData(this);
                $.ajax({
                    url: '/createLog',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === true) {
                            $('#message').html('<p class="text-success">' + response.message +  '</p>');
                             window.location.href = '/welcome';
                        } else if (response.status === 'error') {
                            let errors = response.errors;
                            for (let key in errors) {
                                $("#error-" + key).html(errors[key]);
                            }
                        } else {
                            $('#message').html('<p class="text-danger">' + response.message + '</p>');
                        }

                    },
                    error: function(xhr, status, error) {
                        $('#message').html('<p class="text-danger">An unexpected error occurred. Please try again.</p>');
                        console.error('Error: ', xhr.responseText);
                    },
                });
            });
        });
    </script>

</body>

</html>