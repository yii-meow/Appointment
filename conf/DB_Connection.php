<?php

include_once "DB_configuration.php";

$connection = mysqli_connect($RDS_URL, $RDS_username, $RDS_password, $RDS_database);
mysqli_select_db($connection, $RDS_database) or die (mysqli->error);

if (!$connection) {
    echo "Unable to establish connection " . $mysqli->error;
}
