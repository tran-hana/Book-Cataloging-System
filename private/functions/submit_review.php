<!--
* Name: Ha Nhu Y Tran, Qian Cheng - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: This PHP script handles the submission of a book review by a logged-in user. It checks if the request is a POST request, 
* retrieves the review data from the form submission, and inserts the review into the database. 
* Upon successful insertion, the user is redirected back to the book details page. If there is an error, an error message is displayed.
-->

<?php
session_start();
require_once('database.php');
$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['valid_user_id'];
    $book_id = intval($_POST['book_id']);
    $rating = intval($_POST['rating']);
    $review_text = mysqli_real_escape_string($db, $_POST['review']);

    // Insert review into the database
    $review_sql = "INSERT INTO reviews (book_id, user_id, rating, review_text) VALUES ($book_id, $user_id, $rating, '$review_text')";
    if (mysqli_query($db, $review_sql)) {
        $showbook_url = "show.php?id=" . $book_id;
        header("Location: $showbook_url");
        exit;
    } else {
        die("Error: Could not submit your review. Please try again later.");
    }
}
?>
