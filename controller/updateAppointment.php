<?php

include_once "../conf/DB_Connection.php";

if (isset($_POST['update'])) {

    $appointment_ID = $_POST['appointment_ID'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_name = $_POST['appointment_name'];
    $appointment_description = $_POST['appointment_description'];

    $query = "UPDATE appointment SET APPOINTMENT_TIME = '$appointment_time', APPOINTMENT_NAME = '$appointment_name', APPOINTMENT_DESCRIPTION = '$appointment_description' WHERE APPOINTMENT_ID = '$appointment_ID'";

    if (mysqli_query($connection, $query)) {
        echo "<script>
alert('Successful to update the record!');
window.history.go(-1);              
</script>";
    }
}
