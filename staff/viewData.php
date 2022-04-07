<html>
<head>
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

</head>
<body class="loggedin" style="background-color:#6e404c">

<nav class="navtop">
    <div>
        <h1>Customer Data</h1>
        <a href="viewData.php"><i class="bi bi-person-lines-fill"></i>Customer Information</a>
        <a href="handleAppointment.php"><i class="fas fa-calendar-check"></i>Appointment</a>
        <a href="mainPortal.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>

    </div>
</nav>

<?php
session_start();
if (!isset($_SESSION['staff_ID'])) {
    header("Location: ../staffLogin.php");
    end();
}

include_once "../conf/DB_Connection.php";

$data = mysqli_query($connection, "SELECT * FROM customer") or die (mysqli->error);
print "</br>";
print("<table class='table table-bordered table-hover'><tr>
<thead class='thead-light'>
        <th scope='col'>USERNAME</th>
        <th scope='col'>EMAIL</th>
        <th scope='col'>ADDRESS</th>  
        </tr></thead>");

while ($information = mysqli_fetch_array($data)) {
    print "<tr class='table-primary'><td>" . $information['username'] . "</td>";
    print "<td>" . $information['email'] . "</td>";
    print "<td>" . $information['address'] . "</td></tr>";
}
echo "</table>";

?>
</body>
</html>

