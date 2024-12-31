<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: This file handles the user profile page for BookSpace. It checks if the user is logged in and 
* redirects to the login page if not. It retrieves and displays the user's preferred genres and the 
* books they have reviewed, including ratings and reviews from the database.
-->

<?php
session_start();

// Redirect non-logged-in users to Login page
if (!isset($_SESSION['valid_user'])) {
    header("Location: login.php");
    exit();
}

require_once('database.php');
$db = db_connect();

if (!isset($_GET['user'])) {
    echo "No username specified.";
    exit;
}

// Get user_id
$username = $_GET['user'];
$username_sql = "SELECT user_id FROM users WHERE username = '$username'";
$username_result_set = mysqli_query($db, $username_sql);
$username_result = mysqli_fetch_assoc($username_result_set);
$user_id = $username_result['user_id'];


// Get user's preferred genres
$user_genres_sql = "SELECT genre_name 
                    FROM user_preferences 
                    INNER JOIN genres ON user_preferences.genre_id = genres.genre_id 
                    WHERE user_id = $user_id" ;
$user_genres_result_set = mysqli_query($db, $user_genres_sql);

// Get reviewed books
$books_reviewed_sql = "SELECT reviews.book_id AS book_id, title, user_id, rating, review_text, review_date 
                        FROM reviews 
                        INNER JOIN books ON reviews.book_id = books.book_id 
                        WHERE user_id = $user_id 
                        ORDER BY review_date DESC" ;
$books_reviewed_result_set = mysqli_query($db, $books_reviewed_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="User's profile on BookSpace that includes preferred genres and reviewed books.">
    <meta name="keywords" content="BookSpace, Book, Catalogue, Profile, Preferred Genre, Books Reviewed">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title><?php echo $username; ?>'s Profile - BookSpace</title>
    <link rel="stylesheet" href="../../stylesheet/style.css">
</head>
<body>
    <!-- Header -->
    <?php include("header2.php"); ?>

    <!-- Main Content -->
    <main>
        <section id="user-profile">
            <h2><?php echo $username; ?>'s Profile</h2>
            <div id="user-genres">
                <h3>Preferred Genres</h3>
                <ul>
                    <?php while ($user_genres_result = mysqli_fetch_assoc($user_genres_result_set)): ?>
                        <li><?php echo $user_genres_result['genre_name']; ?></li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div id="books-reviewed">
                <h3>Books Reviewed</h3>
                <?php if (mysqli_num_rows($books_reviewed_result_set) > 0): ?>
                    <div class="review-list">
                        <?php while ($books_reviewed_result = mysqli_fetch_assoc($books_reviewed_result_set)): ?>
                            <div class="review-item">
                                <div class="reviewed_book_title"><a href="<?php echo "show.php?id=" . $books_reviewed_result['book_id']; ?>"><?php echo htmlspecialchars($books_reviewed_result['title']); ?></a></div>
                                <div class="review_date"><?php echo htmlspecialchars($books_reviewed_result['review_date']); ?></div>
                                <div class="rating">
                                    <?php 
                                    // Display rating values by Unicode star symbols
                                    $full_star = "★";
                                    $empty_star = "☆";
                                    $stars = str_repeat($full_star, $books_reviewed_result['rating']) . str_repeat($empty_star, 5 - $books_reviewed_result['rating']);
                                    echo $stars;
                                    ?>
                                </div>
                                <div class="review_text"><?php echo htmlspecialchars($books_reviewed_result['review_text']); ?></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p>This user has not rated any books yet.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <?php include("footer.php"); ?>
</body>
</html>
