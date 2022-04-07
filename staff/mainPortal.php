<html>
<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link href="../styling/css/profilePage.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<?php session_start();

if (!isset($_SESSION['staff_ID'])){
    header("Location: ../staffLogin.php");
    end();
}
?>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>Main Page</h1>
        <a href="viewData.php"><i class="bi bi-person-lines-fill"></i>Customer Information</a>
        <a href="handleAppointment.php"><i class="fas fa-calendar-check"></i>Appointment</a>
        <a href="mainPortal.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>

    </div>
</nav>
<div class="content">
    <h2>Profile Page</h2>
    <div>
        <p>Your account details are below:</p>
        <table>
            <tr>
                <td>Staff ID:</td>
                <td><?= $_SESSION['staff_ID'] ?></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>