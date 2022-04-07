<?php

include_once "../conf/DB_Connection.php";

$customer_id = $_POST['customer_id'];
$staff_id = $_POST['staff_id'];
$appointment_time = $_POST['appointment_time'];
$appointment_name = $_POST['appointment_name'];
$appointment_description = $_POST['appointment_description'];

try {
    $customerData = "INSERT INTO appointment (customer_id,staff_id,appointment_time,appointment_name,appointment_description)
    VALUES ('$customer_id','$staff_id','$appointment_time','$appointment_name','$appointment_description')";

    mysqli_query($connection, $customerData);
    echo "<script>alert('Successfully insert the following record!');</script>";
    echo "<script>window.history.go(-1);</script>";

} catch (mysqli_sql_exception $ex) {
    echo "Error: " . $ex;
}

$connection->close();