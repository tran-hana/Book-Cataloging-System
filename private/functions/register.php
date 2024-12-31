<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: This file handles the user registration process for BookSpace. It checks if the request is a POST method 
* and retrieves the username, email, password, and preferred genres from the form. It checks if the username or 
* email already exists in the database, and if so, it prompts the user to log in. If the user does not exist, 
* a new record is inserted into the users table, and the user's genre preferences are saved in the user_preferences 
* table. After successful registration, the user is redirected to the login page.
-->
<?php
session_start();
require_once('database.php');
$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = $_POST['password'];
    $genres = $_POST['genres'] ?? [];

    // Check for duplicate user
    $check_sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $check_result_set = mysqli_query($db, $check_sql);
    if (mysqli_num_rows($check_result_set) > 0) {
        echo "Username or Email already exists! Click here to <a href='login.php'>log in</a>.";
    } else {
        $register_sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($db, $register_sql)) {
            $user_id = mysqli_insert_id($db);
            foreach ($genres as $genre_id) {
                $genre_id = mysqli_real_escape_string($db, $genre_id);
                $pref_sql = "INSERT INTO user_preferences (user_id, genre_id) VALUES ($user_id, $genre_id)";
                mysqli_query($db, $pref_sql);
            }
            // Redirect user to login page
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($db);
        }
    }
}