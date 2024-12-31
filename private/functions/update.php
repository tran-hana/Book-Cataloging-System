<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: Update book information in the BookSpace system. This page allows the user to update book details including title, author, ISBN, genre, publication year, summary, and reference source. The form submits the updated data to the database.
-->

<?php 
session_start();
require_once('database.php');
$db = db_connect();

// Redirect non-logged-in users to Login page
if (!isset($_SESSION['valid_user'])) {
    header("Location: login.php");
    exit();
}

// Redirect to Booklist page if id is not included
if (!isset($_GET['id'])) { header("Location: booklist.php"); }

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title']; // access the form data
    $encoded_title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $author = $_POST['author'];
    $encoded_author = htmlspecialchars($author, ENT_QUOTES, 'UTF-8');
    $isbn = $_POST['isbn'];
    $genre_id = $_POST['genre_id'];
    $publication_year = $_POST['publication_year'];
    $summary = $_POST['summary'];
    $encoded_summary = htmlspecialchars($summary, ENT_QUOTES, 'UTF-8');
    $reference_source = $_POST['reference_source'];
    $encoded_reference_source = htmlspecialchars($reference_source, ENT_QUOTES, 'UTF-8');

    // Update the table with new information
    $sql = "UPDATE books set title = '$encoded_title' , author= '$encoded_author' , isbn = '$isbn', genre_id =  '$genre_id', publication_year = '$publication_year', summary = '$encoded_summary', reference_source = '$encoded_reference_source' where book_id = '$id' ";
    $result = mysqli_query($db, $sql);
    // Redirect to show page
    header("Location: show.php?id= $id");
} else {
    $sql = "SELECT * FROM books WHERE book_id= '$id' ";
    $result_set = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($result_set);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Update book details in BookSpace, a comprehensive catalogue for book enthusiasts. Edit your book entries to keep your collection up to date.">
    <meta name="keywords" content="BookSpace, Book, Catalogue, Update, Title, Author, ISBN, Publication Year, Genres, Summary, Reference link">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title>Update <?php echo $result['title']; ?> - BookSpace</title>
    <link rel="stylesheet" href="../../stylesheet/style.css">
    <script src="../../scripts/add-validation.js" defer></script>
</head>

<body>
    <!-- Header -->
    <?php include("header2.php"); ?>

    <main>
        <a class="back-link" href="booklist.php">&laquo; Back to List</a>
        <section>
            <h2>Update Book</h2>
            <form class="form-container" action="<?php echo 'update.php?id=' . $result['book_id']; ?>" method="POST" onsubmit="return validateForm();">
                <div class="textfield">
                    <label for="title">Book Title</label>
                    <input type="text" name="title" id="title" value="<?php echo $result['title']; ?>" />
                </div>
                <div class="textfield">
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" value="<?php echo $result['author']; ?>" />
                </div>

                <div class="textfield">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" id="isbn"  value="<?php echo $result['isbn']; ?>"/>
                </div>
                <div class="textfield">
                    <label>Genre</label>
                    <div class="genre-option">
                        <div class="checkbox">
                            <input type="radio" name="genre_id" value="1" id="fiction" <?php if ($result['genre_id'] == 1) echo 'checked'; ?> />
                            <label for="fiction">Fiction</label> 
                        </div>
                        <div class="checkbox">
                            <input type="radio" name="genre_id" value="2" id="biography" <?php if ($result['genre_id'] == 2) echo 'checked'; ?> />
                            <label for="biography">Biography</label>
                        </div>
                        <div class="checkbox">
                            <input type="radio" name="genre_id" value="3" id="history" <?php if ($result['genre_id'] == 3) echo 'checked'; ?> />
                            <label for="history">History</label>
                        </div>
                        <div class="checkbox">
                            <input type="radio" name="genre_id" value="4" id="technology" <?php if ($result['genre_id'] == 4) echo 'checked'; ?> />
                            <label for="technology">Technology</label>
                        </div>
                    </div>
                </div>

                <div class="textfield">
                    <label for="publication_year">Publication Year</label>
                    <input type="text" name="publication_year" id="publication_year" value="<?php echo $result['publication_year']; ?>" />
                </div>

                <div class="textfield">
                    <label for="summary">Summary</label>
                    <textarea name="summary" id="summary"> <?php echo $result['summary']; ?> </textarea>
                </div>

                <div class="textfield">
                    <label for="reference_source">Reference Link</label>
                    <input type="text" name="reference_source" id="reference_source" value="<?php echo $result['reference_source']; ?>" />
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
