<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: This PHP script handles the user registration process for the BookSpace website. It includes a form for users to sign up, including fields for username, email, password, and preferred genres. 
* Upon submission, the form data is validated using JavaScript before being sent to the server for processing.
-->

<?php
session_start();
require_once('database.php');
$db = db_connect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign up BookSpace to begin your literary journey.">
    <meta name="keywords" content="BookSpace, Book, Catalogue, User Name, Email, Password, Preferred genres, Sign-up">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title>Sign Up - BookSpace</title>
    <link rel="stylesheet" href="../../stylesheet/style.css">
    <script src="../../scripts/signup_validation.js" defer></script>
</head>

<body>
    <!-- Header -->
    <?php include("header1.php"); ?>

    <!-- Main Content -->
    <main>
        <section id="s1" class="signup-container">
            <h2>Sign Up for BookSpace</h2>
            <form id="signup-form" class="signup-form" method="POST" action="register.php" onsubmit="return validate();" autocomplete="off">
                <p class="login-link">Already have an account? <a href="login.php">Log in here</a></p>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username should be non-empty, and within 30 characters long.">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" placeholder="Email address should be non-empty with the format xyz@xyz.xyz.">
                </div>               

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password should be at least 8 characters long.">
                </div>

                <div class="form-group">
                    <label for="password-confirmation">Confirm Password</label>
                    <input type="password" id="password-confirmation" placeholder="Please retype your password.">
                </div>

                <div class="form-group">
                    <label id="genresLabel" for="genres">Select at least one preferred genre:</label>
                    <div id="genres" class="flex-style">
                        <?php
                            $genres_sql = "SELECT * FROM genres";
                            $genres_result_set = mysqli_query($db, $genres_sql);
                            while ($genres_results = mysqli_fetch_assoc($genres_result_set)) {
                                echo '<label><input type="checkbox" name="genres[]" value="' . $genres_results['genre_id'] . '">' . $genres_results['genre_name'] . '</label>';
                            }
                            ?>
                    </div>
                </div>
                
                <div class="signup-button">
                <button type="submit" class="button">Sign Up</button>
                <button type="reset" class="button">Reset</button>
                </div>
                
            </form>
        </section>
    </main>
    
    <!-- Footer -->
    <?php include("footer.php"); ?>
</body>

</html>