<?php

session_start();

if ($_SESSION['customer_ID'])
    header("Location: customerLogin.php");
else if ($_SESSION['staff_ID'])
    header("Location: staffLogin.php");

session_destroy();