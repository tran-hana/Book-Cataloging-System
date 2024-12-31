<!--
 * Name: Ha Nhu Y Tran, Cheng Qian - Group 9
 * Assignment 2
 * Date: Nov 23, 2024
 * Description: This file contains two functions to manage the connection to the MySQL database including
 * db_connect() connects to the MySQL database using the credentials defined in 'db_credentials.php'.
 * If the connection fails, it terminates the script and outputs the error message.
 * db_disconnect() closes the active database connection, if it exists, to free up system resources.
-->

<?php
require_once('db_credentials.php');
// Connect to the database then confirm the connection otherwise return error
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
    return $connection;
}

function db_disconnect($connection)
{
    if (isset($connection)) {
        mysqli_close($connection);
    }
}
