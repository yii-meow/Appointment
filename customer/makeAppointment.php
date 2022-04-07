<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <?php
    // INCLUDE DATABASE CONNECTION
    include_once "../conf/DB_Connection.php";

    // CHECK FOR THE SESSION
    session_start();
    if (!isset($_SESSION['customer_ID'])) {
        header("Location: ../customerLogin.php");
        end();
    }

    // INITIALIZE MODE (UPDATE/DELETE) AND WHICH RECORD IT IS
    isset($_REQUEST['mode']) ? $mode = $_REQUEST['mode'] : $mode = "";
    isset($_REQUEST['id']) ? $record_id = $_REQUEST['id'] : $record_id = "";

    // DELETE RECORD FROM REQUEST USING APPOINTMENT ID
    if ($mode == "delete") {
        if (mysqli_query($connection, "DELETE FROM appointment WHERE APPOINTMENT_ID = '$record_id'"))
            echo "<script>alert('Successfully deleted the record with ID='+$record_id)</script>";
        echo "<script>window.history.go(-1);</script>";
    }

    // TO CHECK THE APPOINTMENT MADE BY THE CUSTOMER
    $data = mysqli_query($connection, "SELECT * FROM appointment WHERE customer_ID =" . $_SESSION['customer_ID']) or die (mysqli->error);

    ?>
    <title>Make Appointment Page</title>

</head>

<body class="loggedin" style="background-color:#6e404c">

<nav class="navtop">
    <div>
        <h1>Appointment Page</h1>
        <a href="makeAppointment.php"><i class="fas fa-calendar-check"></i>Appointment</a>
        <a href="mainPage.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>
</br>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
    Create New Appointment
</button>
<br><br>
<table class="table table-bordered table-hover">
    <thead class="thead-light">
    <tr>
        <th scope="col">Appointment ID</th>
        <th scope="col">Staff ID - Staff Name</th>
        <th scope="col">Appointment Time</th>
        <th scope="col">Appointment Name</th>
        <th scope="col">Appointment Description</th>
        <th scope="col">Action</th>
    </tr>
    </thead>

    <tbody>
    <?php

    while ($information = mysqli_fetch_array($data)) {
        $staff_name = mysqli_fetch_array(mysqli_query($connection, "SELECT NAME FROM staff WHERE ID = " . $information['STAFF_ID']));

        print "<tr class='table-primary'><td>" . $information['APPOINTMENT_ID'] . "</td>";
        print "<td>" . $information['STAFF_ID'] . " - " . $staff_name['NAME'] . "</td>";
        print "<td>" . $information['APPOINTMENT_TIME'] . "</td>";
        print "<td>" . $information['APPOINTMENT_NAME'] . "</td>";
        print "<td>" . $information['APPOINTMENT_DESCRIPTION'] . "</td>";
        print("<td>
        
            <!-- Call to action buttons -->
        <ul class='list-inline m-0'>     
            <li class='list-inline-item'>
                <button class='btn btn-success btn-sm rounded-0 editButton' type='button' data-whatever='@mdo' data-placement='top' title='Edit'><i class='fa fa-edit'></i></button>
            </li>
            
            <li class='list-inline-item'>    
            <a href='{$_SERVER['PHP_SELF']}?mode=delete&id={$information['APPOINTMENT_ID']}' >
                <button class='btn btn-danger btn-sm rounded-0' type='button' data-toggle='tooltip' data-placement='top' title='Delete' type='submit'><i class='fa fa-trash'></i></button>
            </a>
            </li>
        </ul>
        
            </td></tr>");
    } ?>

    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('.editButton').on('click', function () {
                $('#updateAppointmentModal').modal('show');

                // GET THE TABLE ROW VALUE
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                // REPLACE THE 'T' IN BETWEEN DATE AND TIME TO SOLVE MISREADING
                $('#appointment_ID').val(data[0]);
                $('#appointment_time').val(data[2].replace(/\s/g, 'T'));
                $('#appointment_name').val(data[3]);
                $('#appointment_description').val(data[4]);
            }
        );
    });
</script>

<!--Bootstrap Modal for Handling New Appointment-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Appointment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/insertingAppointment.php" method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Appointment Time</label>
                        <input type="datetime-local" class="form-control" name="appointment_time">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Appointment Name</label>
                        <input type="text" class="form-control" name="appointment_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Appointment Description</label>
                        <input type="text" class="form-control" name="appointment_description">
                    </div>

                    <?php
                    $data = mysqli_query($connection, "SELECT ID FROM staff") or die (mysqli->error);

                    // TO ASSIGN RANDOM EXISTING STAFF ID TO HANDLE THE APPOINTMENT
                    $random_staff_id = rand(1, mysqli_num_rows($data));

                    ?>

                    <input type="hidden" name="staff_id" value='<?php echo $random_staff_id; ?>'/>
                    <input type="hidden" name="customer_id" value='<?php echo $_SESSION['customer_ID']; ?>'/>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Create New Appointment"/>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Bootstrap Modal for Updating New Appointment-->
<div class="modal fade" id="updateAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Appointment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/updateAppointment.php" method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Appointment Time</label>
                        <input type="datetime-local" class="form-control" id="appointment_time" name="appointment_time">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Appointment Name</label>
                        <input type="text" class="form-control" id="appointment_name" name="appointment_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Appointment Description</label>
                        <input type="text" class="form-control" id="appointment_description"
                               name="appointment_description">
                    </div>

                    <input type="hidden" name="appointment_ID" id="appointment_ID" ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="update" class="btn btn-primary" value="Update Appointment"/>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="../styling/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../styling/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../styling/vendor/bootstrap/js/popper.js"></script>
<script src="../styling/vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>