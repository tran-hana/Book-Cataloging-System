<!--
* Name: Ha Nhu Y Tran, Qian Cheng - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: This is the logout page for the BookSpace website. When a user logs out, the session variables 
* valid_user and valid_user_id are unset, and the session is destroyed . This ensures the user is logged out 
* and no session data remains. After the session is cleared, the user is redirected to the index page (`../../index.php`), 
-->

<?php
session_start();

// Delete session variables and destroy session
unset($_SESSION['valid_user']);
unset($_SESSION['valid_user_id']);
session_unset();
session_destroy();

// Redirect back to the index page
header("Location: ../../index.php");
exit;
?>