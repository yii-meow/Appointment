<?php
session_start();
include_once "../conf/DB_Connection.php";

if (isset($_POST['update'])) {

    $email = $_POST['email'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $genderSelect = $_POST['genderSelect'];

    $query = "UPDATE customer SET email = '$email', address = '$address', birthday = '$birthday', gender = '$genderSelect' WHERE ID = " . $_SESSION['customer_ID'];

    if (mysqli_query($connection, $query)) {
        echo "<script>
            alert('Successful to update personal details!');
            window.history.go(-1);
        </script>";
    }
}
