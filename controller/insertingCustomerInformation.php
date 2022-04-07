<?php

include_once "../conf/DB_Connection.php";

// DECLARE POST VARIABLE FROM CUSTOMER REGISTRATION
$username = $_POST['username'];
$password = md5($_POST['password']);
$confirmed_password = md5($_POST['confirmed_password']);
$email = $_POST['email'];

if (isset($_POST['address'])) $address = $_POST['address'];
else $address = "";

if (isset($_POST['birthday'])) $birthday = $_POST['birthday'];
else $birthday = "";

if (isset($_POST['gender'])) {
    if ($_POST['gender'] == 'M')
        $gender = 'M';
    else
        $gender = 'F';
} else $gender = "";

$registered_time = date("Y-m-d H:i:s");

// CHECKING ARE THE BOTH PASSWORD MATCHED
if (!($password === ($confirmed_password))) {
    echo "<script>alert('Password not match!');</script>";
    echo "<script>window.location='../customerLogin.php'</script>";
} else {
    try {
        $customerData = "INSERT INTO customer (username,password,email,address,birthday,gender,registered_time) VALUES ('$username','$password','$email','$address','$birthday','$gender','$registered_time')";

        mysqli_query($connection, $customerData);
        echo "Successfully insert the following record!";

        session_start();
        // SETTING SESSION VARIABLE
        $_SESSION['customer_ID'] = mysqli_insert_id($connection); // TO OBTAIN THE AUTO INCREMENT VALUE FROM THE INSERT STATEMENT
        $_SESSION["customer_name"] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['birthday'] = $birthday;
        $_SESSION['gender'] = $gender;
        $_SESSION['registered_time'] = $registered_time;

        header("Location: ../customer/mainPage.php");

    } catch (mysqli_sql_exception $ex) {
        echo "Error: " . $ex;
    }
}

$connection->close();