<html>
<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link href="../styling/css/profilePage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../styling/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Import jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity=
            "sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous">
    </script>

    <script src=
            "https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity=
            "sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous">
    </script>

    <link href="../styling/css/profilePage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>
<?php session_start();
if (!isset($_SESSION['customer_ID'])) {
    header("Location: ../customerLogin.php");
}
include_once "../conf/DB_Connection.php";
?>

<body class="loggedin" style="background-color:#ccc2c2">
<nav class="navtop">
    <div>
        <h1>User Profile Page</h1>
        <a href="makeAppointment.php"><i class="fas fa-calendar-check"></i>Appointment</a>
        <a href="mainPage.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>
<div class="content">
    <h2>Profile Page</h2>
    <div>

        <table>
            <p>Your account details are below:
                <button style="border:none;background-color:transparent;overflow:hidden;outline:none;"
                        class="editButton">
                    <i class='fa fa-edit' style="font-size:20px;margin-left:20px;"></i>
                </button>
            </p>

            <?php $personalDetails = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customer WHERE ID =" . $_SESSION['customer_ID'])); ?>

            <tr>
                <td>Username:</td>
                <td><?= $personalDetails['username'] ?></td>
            </tr>

            <tr class="email">
                <td>Email :</td>
                <td><?= $personalDetails['email'] ?></td>
            </tr>

            <tr class="address">
                <td>Address:</td>
                <td><?= $personalDetails['address'] ?></td>
            </tr>

            <tr class="birthday">
                <td>Birthday:</td>
                <td><?php
                    if ($personalDetails['birthday'] == "0000-00-00") {
                        echo "Not Yet Set";
                    } else {
                        echo $personalDetails['birthday'];
                    } ?>
            </tr>

            <tr class="gender">
                <td>Gender:</td>
                <td><?php
                    if ($personalDetails['gender'] == 'M') {
                        echo "Male";
                    } else {
                        echo "Female";
                    }
                    ?></td>
            </tr>

            <tr>
                <td>Registered Time:</td>
                <td><?= $personalDetails['registered_time'] ?></td>
            </tr>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.editButton').on('click', function () {
                $('#updatePersonalDetailsModal').modal('show');

                // SETTING POP UP MODAL VALUE BASE ON THE INFORMATION PAGE USING JQUERY TR CLASS
                $('#email').val(jQuery(".email").find("td:eq(1)").text());
                $('#address').val(jQuery(".address").find("td:eq(1)").text());

                if ((jQuery(".birthday").find("td:eq(1)").text()) != "Not Yet Set") {
                    var birthday = (jQuery(".birthday").find("td:eq(1)").text()).trim();
                    $('#birthday').val(birthday);
                }

                // MAKE RADIO BUTTON CHECKED
                if (jQuery(".gender").find("td:eq(1)").text() == "Male")
                    $('input:radio[name="genderSelect"][value="M"]').prop('checked', true);
                else
                    $('input:radio[name="genderSelect"][value="F"]').prop('checked', true);
            }
        );
    });
</script>

<!--Bootstrap Modal for Updating New Personal Details-->
<div class="modal fade" id="updatePersonalDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Personal Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="updatePersonalDetails.php" method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genderSelect" class="genderSelect"
                                   id="flexRadioDefault1" value="M">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genderSelect" class="genderSelect"
                                   id="flexRadioDefault2" value="F">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="update" class="btn btn-primary" value="Update Personal Details"/>
            </div>
            </form>
        </div>
    </div>
</div>

</body>

<script src="../styling/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../styling/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../styling/vendor/bootstrap/js/popper.js"></script>
<script src="../styling/vendor/bootstrap/js/bootstrap.min.js"></script>
</html>
