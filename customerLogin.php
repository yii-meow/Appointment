<!DOCTYPE html>
<html lang="en">

<?php
include_once "menuLogin.php";
session_start();
if (isset($_SESSION['user'])) {
    header("location: staff/mainPortal.php");
    die();
} else if (isset($_SESSION['staff'])) {
    header("location: customer/mainPage.php");
    die();
}
?>


<head>
    <title>Customer Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="styling/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="styling/css/util.css">
    <link rel="stylesheet" type="text/css" href="styling/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-85 p-b-20">
            <form class="login100-form validate-form" method="post" action="controller/validateCustomerLogin.php">
					<span class="login100-form-title p-b-70">
						Welcome Customer
					</span>
                <span class="login100-form-avatar">
						<img src="styling/images/avatar-01.jpg" alt="AVATAR">
					</span>

                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate="Enter username">
                    <input class="input100" type="text" name="username">
                    <span class="focus-input100" data-placeholder="Username"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="container-login100-form-btn">
                    <input type="submit" value=""/>
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <ul class="login-more p-t-190">
                    <li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

                        <a href="" class="txt2">
                            Username / Password?
                        </a>
                    </li>

                    <li>
							<span class="txt1">
								Don???t have an account?
							</span>

                        <button type="button" class="txt2" data-toggle="modal" data-target="#exampleModal"
                                data-whatever="@mdo">Sign Up
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>

<!--Bootstrap Modal for Registration-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="controller/insertingCustomerInformation.php" method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Confirmed Password</label>
                        <input type="password" class="form-control" name="confirmed_password">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="M">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="F">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Register"/>
            </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="styling/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="styling/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="styling/vendor/bootstrap/js/popper.js"></script>
<script src="styling/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="styling/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="styling/vendor/daterangepicker/moment.min.js"></script>
<script src="styling/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="styling/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="styling/js/main.js"></script>

</body>
</html>