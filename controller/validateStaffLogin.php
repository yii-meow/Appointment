<html>
<head>
</head>
<body>
<?php
session_start();
include '../conf/DB_Connection.php';

mysqli_select_db($connection, $RDS_database) or die (mysqli->error);
$data = mysqli_query($connection, "SELECT * FROM staff") or die (mysqli->error);

while ($information = mysqli_fetch_array($data)) {
    if ($_POST['username'] == $information['USERNAME']) {
        if (md5($_POST['password'] == $information['PASSWORD'])) {
            echo "<script>alert('Login successfully!')</script>";
            $_SESSION["staff_ID"] = $information['ID'];
            header("Location: ../staff/mainPortal.php");
            die();
        }
    }
}
echo "<script>alert('Login Unsuccessfully. Please check your username or password');</script>";
echo "<script>window.history.go(-1);</script>";
?>

</body>
</html>