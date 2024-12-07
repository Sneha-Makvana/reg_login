<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

        img {
            height: 100%;
            width: 100%;
        }

        .errorVal {
            color: red;
            font-size: 13px;
        }

        .logBtn {
            height: 40px;
            margin-left: 100px;
            text-decoration: none;
            color: black;
        }
    </style>
    <title>Register Form</title>
</head>

<body>
    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="s2.jpg" alt="Sample photo" />
                            </div>

                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <div class="d-flex">
                                        <h3 class="mb-5 text-uppercase">Student registration</h3>
                                        <!-- <a class="logBtn">Login</a> -->
                                    </div>
                                    <!-- <hr> -->
                                    <form id="registerForm" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="username" class="form-label">User name<span class="text-danger">*</span></label>
                                                <input type="text" id="username" name="username" class="form-control" />
                                                <span class="error-message errorVal" id="error-username"></span>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="lname" class="form-label">Last name<span class="text-danger">*</span></label>
                                                <input type="text" id="lname" name="lname" class="form-control" />
                                                <span class="error-message errorVal" id="error-lname"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="email" class="form-label">Email ID<span class="text-danger">*</span></label>
                                                <input type="text" id="email" name="email" class="form-control" />
                                                <div class="error-message errorVal" id="error-email"></div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" id="password" name="password">
                                                <div class="error-message errorVal" id="error-password"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male">
                                                    <label class="form-check-label" for="genderMale">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female">
                                                    <label class="form-check-label" for="genderFemale">Female</label>
                                                </div>
                                                <div class="error-message errorVal" id="error-gender"></div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                                <select class="form-select" id="city" name="city">
                                                    <option value="">Select City</option>
                                                    <option value="India">India</option>
                                                    <option value="USA">USA</option>
                                                    <option value="UK">UK</option>
                                                    <option value="Landon">Landon</option>
                                                </select>
                                                <div class="error-message errorVal" id="error-city"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="mobile_number" class="form-label">Mobile Number<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mobile_number" name="mobile_number">
                                                <div class="error-message errorVal" id="error-mobile_number"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="profile_image" class="form-label">Profile Image<span class="text-danger">*</span></label>
                                                <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*" />
                                                <div class="error-message errorVal" id="error-profile_image"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="images" class="form-label">Upload Additional Images</label>
                                            <input type="file" id="images" name="images[]" class="form-control" multiple />
                                            <div class="error-message errorVal" id="error-images"></div>
                                        </div>
                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="submit" id="submitBtn" class="btn btn-danger btn-lg ms-2">Submit
                                                form</button>
                                        </div>
                                    </form>
                                    <div id="message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            $(".error-message").html("");
            var formData = new FormData(this);
            $.ajax({
                url: '/register/create',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === true) {
                        $('#message').html('<p class="text-success">' + response.message +  '<a href="/login"> Login </a>' + '</p>');
                        $('#registerForm')[0].reset();
                    } else if (response.status === 'error') {
                        let errors = response.errors;
                        for (let key in errors) {
                            $('#error-' + key).html(errors[key]);
                        }
                    }
                },
                error: function() {
                    $('#message').html('<p class="text-danger">An error occurred. Please try again.</p>');
                }
            });
        });
    </script>
</body>

</html>