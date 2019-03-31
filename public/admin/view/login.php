<?php
    require __DIR__."/../../../config/base_url.php";
    
    require_once __DIR__."/../../../config/helper.php";
    sessionStart();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Management</title>


    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>public/css/dashboard.css" rel="stylesheet">

    <script src="<?php echo base_url();?>public/js/jquery.js"></script>
    <style>
    h3 {
        border-bottom: 1px solid rgb(187, 184, 184)
    }

    .sidebar-sticky {
        background-color: black;
    }

    .alert {
        display: none;
    }
    </style>

    <script>
    $(document).ready(function() {
        $(".btn-login").on("click", function(e) {
            e.preventDefault();

            if ($("#email").val() == "") {
                $(".email-alert").html("Email is required");
                $(".email-alert").show();
            } else {
                $(".email-alert").hide();
            }

            if ($("#password").val() == "") {
                $(".pass-alert").html("Password is required");
                $(".pass-alert").show();
            } else {
                $(".pass-alert").hide();
            }
            if ($("#email").val() != "" && $("#password").val() != "") {
                $.ajax({
                    url: "<?php echo base_url()?>/api/user.login.php",
                    method: "POST",
                    dataType: "json",   
                    data: {
                        email: $("#email").val(),
                        password: $("#password").val()
                    },
                    success: function(data) {
                        if(data.status == "fail"){
                            $(".form-alert").html("Incorrect email or password");
                            $(".form-alert").show()
                        }
                        else{
                            if(data.account_type == "customer"){
                                $(".form-alert").html("Incorrect email or password");
                                $(".form-alert").show()
                            }
                            else if(data.account_type == "admin"){
                                $(".form-alert").hide();
                                window.location  = "<?php echo base_url();?>public/admin/view/index.php";
                            }
                        }
                    }
                })
            }

        })
    })
    </script>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Administrator</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <!-- <a class="nav-link" href="#">Sign out</a> -->
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 mt-5">
                <h3>Login Administrator</h3>
                <br>
                <div class="form-login">
                    <form>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Enter email" id="email">
                            <div class="alert alert-danger email-alert"></div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="password">
                            <div class="alert alert-danger pass-alert"></div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-login">Login</button>
                        <br>
                        <div class="alert alert-danger form-alert"></div>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>

</html>