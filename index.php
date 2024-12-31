<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: Homepage for BookSpace. This page serves as the landing page for users who are not logged in. 
* It introduces the BookSpace platform and provides links to login and sign up pages. 
-->

<?php 
session_start(); 
// Redirect logged-in users to Booklist page
if (isset($_SESSION['valid_user'])) {
    header("Location: private/functions/booklist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BookSpace is an online platform designed for book enthusiasts, offering a comprehensive catalog of books and tailed platform that users can see book details, update, add and delete books, leave a review and ratings">
    <meta name="keywords" content="BookSpace, Book, Catalogue">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title>Home - BookSpace</title>
    <link rel="stylesheet" href="stylesheet/style.css">
</head>

<body>
    <header id="header1">
        <img src="images/logo1.png" alt="This is logo of BookSPace website, representing a stack of pastel-colored books with a playful design" class="logo">
        <!-- Source: https://www.canva.com/design/DAGWT1XFreI/ryxOHi092bBfbCHIDE-06A/edit?utm_content=DAGWT1XFreI&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton -->
        <h1>BookSpace</h1>
        <nav class="header-nav">
            <a href="index.php">Home</a>
        </nav>
    </header>

    <main>
        <section class="back-ground">
            <h2>Welcome to BookSpace!</h2>
            <p>At BookSpace, we believe in the power of books to transform lives.</p>
            <p class="intro-blur">Whether you're an avid reader or just getting started, our platform provides an <span class="intro-highlight">endless collection</span> of books to <span class="intro-highlight">inspire</span> and <span class="intro-highlight">entertain</span>.
            Join us to explore your <span class="intro-highlight">next great read</span>!</p>
            <p class="intro-highlight blur-background">"A book is a dream that you hold in your hand." - Neil Gaiman</p>
        </section>

        <section class="intro-content">
            <h2>Why Choose BookSpace?</h2>
            <div class="flex-container">
                <div class="flex-item">
                    <h3>Extensive Collection</h3>
                    <p>From gripping thrillers to heartwarming stories, explore a wide variety of genres including
                        fiction, technology, biography, and history.</p>
                </div>

                <div class="flex-item">
                    <h3>Tailored Platform</h3>
                    <p> Users can view book details, add, remove, or update books in the catalog on the website.</p>
                </div>

                <div class="flex-item">
                    <h3>Reviews and Ratings</h3>
                    <p>Leave your reviews of the books you have read to share your opinion with the reading community.
                    </p>
                </div>

                <div class="flex-item">
                    <h3>Access Anytime</h3>
                    <p>Enjoy reading on your favorite devices, whether on your phone, tablet, or computer. BookSpace is
                        accessible 24/7.</p>
                </div>
            </div>
        </section>

        <nav class="main-nav">
            <a class="home-login" href="private/functions/login.php">Login</a>
            <a href="private/functions/signup.php">Sign Up</a>
        </nav>
    </main>

    <!-- Footer -->
    <?php include("private/functions/footer.php"); ?>
</body>

</html>