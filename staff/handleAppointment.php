<!DOCTYPE html>
<head>
    <?php
    include_once "../conf/DB_Connection.php";
    session_start();

    if (!isset($_SESSION['staff_ID'])) {
        header("Location: ../staffLogin.php");
        end();
    }

    if (isset($_POST['update'])) {
        $appointment_time = $_POST['appointment_time'];
        if (mysqli_query($connection, "UPDATE appointment SET APPOINTMENT_TIME = '$appointment_time'" . " WHERE APPOINTMENT_ID = " . $_POST['appointment_ID'])) {
            echo "<script>alert('update successfully!')</script>";
        } else {
            echo "<script>alert('Update failed!')</script>";
        }
    }


    $data = mysqli_query($connection, "SELECT * FROM appointment WHERE STAFF_ID = " . $_SESSION['staff_ID']) or die (mysqli->error);

    ?>

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="../styling/css/profilePage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <title>Handle Appointment Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body class="loggedin" style="background-color:#6e404c">

<nav class="navtop">
    <div>
        <h1>Handle Appointment Page</h1>
        <a href="viewData.php"><i class="bi bi-person-lines-fill"></i>Customer Information</a>
        <a href="handleAppointment.php"><i class="fas fa-calendar-check"></i>Appointment</a>
        <a href="mainPortal.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>

    </div>
</nav>
<br/>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
    Create New Appointment
</button>
<br><br>
<table class="table table-bordered table-hover">
    <thead class="thead-light">
    <tr>
        <th scope="col">Appointment ID</th>
        <th scope="col">Customer ID</th>
        <th scope="col">Appointment Time</th>
        <th scope="col">Appointment Name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>

    <tbody>
    <?php
    // Fetch data from database and display
    while ($information = mysqli_fetch_array($data)) {
        print "<tr class='table-primary'><td>" . $information['APPOINTMENT_ID'] . "</td>";
        print "<td>" . $information['CUSTOMER_ID'] . "</td>";
        print "<td>" . $information['APPOINTMENT_TIME'] . "</td>";
        print "<td>" . $information['APPOINTMENT_NAME'] . "</td>";
        print("<td>
        
            <!-- Call to action buttons -->
        <ul class='list-inline m-0'>     
            <li class='list-inline-item'>
                <button class='btn btn-success btn-sm rounded-0 editButton' type='button' data-whatever='@mdo' data-placement='top' title='Edit'><i class='fa fa-edit'></i></button>
            </li>
        </ul>       
            </td></tr>");
    }
    ?>
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

                $('#appointment_ID').val(data[0]);
                $('#appointment_time').val(data[2].replace(/\s/g, 'T'))
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
                        <!-- Choose Customer ID from database -->
                        <label for="recipient-name" class="col-form-label">Customer ID</label>
                        <select name="customer_id" class="form-control" id="ID">
                            <?php

                            $data = mysqli_query($connection, "SELECT ID FROM customer ORDER BY ID ASC") or die (mysqli->error);

                            while ($information = mysqli_fetch_array($data)) {
                                $id = $information['ID'];
                                echo "<option value='$id'>" . $id . "</option>";
                            }
                            ?>

                        </select>
                    </div>
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

                    <input type="hidden" name="staff_id" value='<?php echo $_SESSION['staff_ID'] ?>'/>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Create New Appointment"/>
            </div>
            </form>
        </div>
    </div>
</div>
<!--Bootstrap Modal for Handling New Appointment-->

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
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Appointment Time</label>
                        <input type="datetime-local" class="form-control" id="appointment_time" name="appointment_time">
                    </div>

                    <input type="hidden" name="appointment_ID" id="appointment_ID"/>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="update" class="btn btn-primary" value="Update Appointment"/>
            </div>
            </form>
        </div>
    </div>
</div>
<!--Bootstrap Modal for Updating New Appointment-->

<script src="../styling/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../styling/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../styling/vendor/bootstrap/js/popper.js"></script>
<script src="../styling/vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>