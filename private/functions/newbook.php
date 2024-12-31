<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: This page allows logged-in users to add new books to the BookSpace catalog. If a user is not logged in, 
* they are redirected to the Login page. The form includes fields for the book title, author, ISBN, genre, 
* publication year, summary, reference link, and book cover image. The form uses client-side validation 
* through JavaScript (via the 'add-validation.js' script) before submission. The form data is sent to 'add.php' 
* for processing, and the user can either submit or reset the form. Upon successful submission, the new book 
* will be added to the database.
-->

<?php 
session_start();

// Redirect non-logged-in users to Login page
if (!isset($_SESSION['valid_user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page to add a new book to the catalogue.">
    <meta name="keywords" content="BookSpace, Book, Catalogue, Add, Title, Author, ISBN, Publication Year, Genres, Summary, Reference link, Book Cover">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title>Add Book - BookSpace</title>
    <link rel="stylesheet" href="../../stylesheet/style.css" />
    <script src="../../scripts/add-validation.js" defer></script>
</head>

<body>
    <!-- Header -->
    <?php include 'header2.php'; ?>
    <main>
        <a class="back-link" href="<?php echo 'booklist.php'; ?>">&laquo; Back to List</a>
        <section>
            <h2>Create New Book</h2>
            <form class="form-container" action="add.php" enctype="multipart/form-data" method="POST" onsubmit="return validateForm();">
                <div class="textfield">
                    <label for="title">Book Title</label>
                    <input type="text" name="title" id="title" />
                </div>

                <div class="textfield">
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" />
                </div>

                <div class="textfield">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" id="isbn" />
                </div>

                <div class="textfield">
                    <label>Genre</label>
                    <div class="genre-option">
                        <div class="checkbox">
                            <input type="radio" name="genre_id" value="1" id="fiction" />
                            <label for="fiction">Fiction</label>
                        </div>
                        <div class="checkbox">
                            <input type="radio" name="genre_id" value="2" id="biography" />
                            <label for="biography">Biography</label>
                        </div>
                        <div class="checkbox">
                            <input type="radio" name="genre_id" value="3" id="history" />
                            <label for="history">History</label>
                        </div>
                        <div class="checkbox">
                            <input type="radio" name="genre_id" value="4" id="technology" />
                            <label for="technology">Technology</label>
                        </div>
                    </div>
                </div>

                <div class="textfield">
                    <label for="publication_year">Publication Year</label>
                    <input type="text" name="publication_year" id="publication_year" />
                </div>

                <div class="textfield">
                    <label for="summary">Summary</label>
                    <textarea name="summary" id="summary" rows="8" cols="70" placeholder="Write your book summary here!" maxlength="300"></textarea>
                </div>

                <div class="textfield">
                    <label for="reference_source">Reference Link</label>
                    <input type="text" name="reference_source" id="reference_source" />
                </div>

                <div class="textfield">
                    <label for="image">Book Cover Image</label>
                    <input type="file" name="image" id="image" accept="image/*" />
                </div>

                <div class="action-button">
                    <button class="button" type="submit">Submit</button>
                    <button class="button" type="reset">Reset</button>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>