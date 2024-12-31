<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description:This script displays the detailed information for a specific book from the database. It retrieves the book details 
* (title, author, ISBN, genre, publication year, summary, and reference source) and the community reviews for that book. 
* If the user is not logged in, they are redirected to the Login page.
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

// Redirect back to booklist page if no valid id in URL parameter
if (!isset($_GET['id'])) {
    header("Location: booklist.php");
}

$book_id = $_GET['id'];
$books_sql = "SELECT books.title, books.author, books.isbn, genres.genre_name, books.publication_year, books.summary, books.reference_source
                FROM books 
                INNER JOIN genres 
                ON books.genre_id = genres.genre_id 
                WHERE books.book_id = '$book_id'";
$books_result_set = mysqli_query($db, $books_sql);
$books_result = mysqli_fetch_assoc($books_result_set);

$reviews_sql = "SELECT username, rating, review_text, review_date 
                FROM reviews 
                INNER JOIN users ON reviews.user_id = users.user_id 
                WHERE book_id = '$book_id' 
                ORDER BY review_date DESC";
$reviews_result_set = mysqli_query($db, $reviews_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="See book detatils here and user can also leave the reviees and ratings in this page.">
    <meta name="keywords" content="BookSpace, Book, Catalogue, Title, Author, ISBN, Publication Year, Genres, Summary, Reference link">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title><?php echo $books_result['title']; ?> - BookSpace</title>
    <link rel="stylesheet" href="../../stylesheet/style.css">
</head>

<body>
    <!-- Header -->
    <?php include("header2.php");?>
    <main>
        <a class="back-link" href="booklist.php">&laquo; Back to List</a>
        <section id="ss1">
            <h2><?php echo $books_result['title']; ?></h2>
            <div class="attributes">
                <dl>
                    <dt>Title</dt>
                    <dd><?php echo $books_result['title']; ?></dd>
                </dl>
                <dl>
                    <dt>Author</dt>
                    <dd><?php echo $books_result['author']; ?></dd>
                </dl>
                <dl>
                    <dt>ISBN</dt>
                    <dd><?php echo $books_result['isbn']; ?></dd>
                </dl>
                <dl>
                    <dt>Genre</dt>
                    <dd><?php echo $books_result['genre_name']; ?></dd>
                </dl>
                <dl>
                    <dt>Publication Year</dt>
                    <dd><?php echo $books_result['publication_year']; ?></dd>
                </dl>
                <dl>
                    <dt class="summary">Summary</dt>
                    <dd><?php echo $books_result['summary']; ?></dd>
                </dl>
                <dl>
                    <dt>Reference source</dt>
                    <dd><?php echo $books_result['reference_source']; ?></dd>
                </dl>
            </div>
            <div id="rate-and-review">
                <form action="submit_review.php" method="POST">
                    <h3>Rate and Review</h3>
                        <!-- Include book_id in the form to submit -->
                        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                        <div class="rating-style">
                            <div class="rating-value">
                                <input type="radio" id="rating1" name="rating" value="1">
                                <label for="rating1">1 (Very Bad)</label>
                            </div>
                            <div class="rating-value">
                                <input type="radio" id="rating2" name="rating" value="2">
                                <label for="rating2">2 (Below Average)</label>
                            </div>
                            <div class="rating-value">
                                <input type="radio" id="rating3" name="rating" value="3">
                                <label for="rating3">3 (Average)</label>
                            </div>
                            <div class="rating-value">
                                <input type="radio" id="rating4" name="rating" value="4">
                                <label for="rating4">4 (Good)</label>
                            </div>
                            <div class="rating-value">
                                <input type="radio" id="rating5" name="rating" value="5">
                                <label for="rating5">5 (Excellent)</label>
                            </div>
                        </div>
                        <div id="review-container">
                            <textarea name="review" placeholder="Write your review here!"></textarea>
                        </div>
                    <div class="action-button">
                        <button class="button" type="submit">Submit</button>
                        <button class="button" type="reset">Reset</button>
                    </div>
                </form>
            </div>

            <div id="community-reviews">
                <h3>Community Reviews</h3>
                    <?php if (mysqli_num_rows($reviews_result_set) > 0): ?>
                        <div class="review-list">
                            <?php while ($reviews_result = mysqli_fetch_assoc($reviews_result_set)): ?>
                                <div class="review-item">
                                    <div class="reviewer_username"><a href="<?php echo "profile.php?user=" . $reviews_result['username']; ?>"><?php echo htmlspecialchars($reviews_result['username']); ?></a></div>
                                    <div class="review_date"><?php echo htmlspecialchars($reviews_result['review_date']); ?></div>
                                    <div class="rating">
                                        <?php 
                                        // Display rating values by Unicode star symbols
                                        $full_star = "★";
                                        $empty_star = "☆";
                                        $stars = str_repeat($full_star, $reviews_result['rating']) . str_repeat($empty_star, 5 - $reviews_result['rating']);
                                        echo $stars;
                                        ?>
                                    </div>
                                    <div class="review_text"><?php echo htmlspecialchars($reviews_result['review_text']); ?></div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-center">No reviews for this book yet. Be the first to review!</p>
                    <?php endif; ?>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <?php include("footer.php"); ?>
</body>

</html>