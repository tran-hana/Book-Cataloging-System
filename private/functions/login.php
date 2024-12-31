<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: This is the login page for the BookSpace website. The page allows registered users to log in using their 
* username and password. It starts by querying the 'users' table in the database to retrieve user credentials 
* (username, password, user_id) and stores them in an associative array. When login form is submitted,
* this script will check if this match any entry in the database. If valid, the user is logged in and then redirected 
* to the booklist page. If the credentials are invalid, an error message is displayed.
* The page also provides a link to the signup page for users who do not have an account yet.
-->

<?php
session_start();
require_once('database.php');
$db = db_connect();

$users_sql = "SELECT user_id, username, password FROM users";
$users_result_set = mysqli_query($db, $users_sql);

// Convert database result to an associative array
$users = array();
while ($row = mysqli_fetch_assoc($users_result_set)) {
    $users[$row['username']] = [
        'password' => $row['password'],
        'user_id' => $row['user_id']
    ];
}

$error_message = ''; 

if (isset($_POST['username']) && isset($_POST['password'])) {
    // If the user has just tried to log in
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the existence of the user and password in the associative array
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['valid_user'] = $username;
        $_SESSION['valid_user_id'] = $users[$username]['user_id'];
        // Redirect user to Booklist page
        header("Location: booklist.php");
        exit;
    } else {
        // Invalid username or password
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Page for users who already have account with BookSpace.">
    <meta name="keywords" content="BookSpace, Book, Login, Username, Password">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title>Login - BookSpace</title>
    <link rel="stylesheet" href="../../stylesheet/style.css">
</head>

<body>
    <!-- Header -->
    <?php include("header1.php"); ?>

    <!-- Main Content -->
    <main>
        <section id="login-section" class="login-container  back-ground">
            <h2>Login to BookSpace</h2>

            <?php if (!empty($error_message)): ?>
                    <p class="error-message text-center"><?php echo $error_message; ?></p>
                <?php endif; ?>

            <form id="login-form" method="POST" action="login.php" class="login-form">
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                </div>

                <div class="login-button">
                    <button type="submit" class="button">Login</button>
                </div>

                <p class="signup-link blur-background">Don't have an account? <a href="signup.php">Sign up here</a></p>
            </form>

        </section>
    </main>
    
    <!-- Footer -->
    <?php include("footer.php"); ?>
</body>
</html>