<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description: This page allows users to confirm the deletion of a book from the BookSpace catalogue.
* If the user confirms, the book is deleted from the database. If the user is not logged in,
* they are redirected to the login page. The title of the book to be deleted is displayed as a confirmation before deletion.
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

// Redirect to Booklist page if no id exists
if (!isset($_GET['id'])) { header("Location: booklist.php"); }

$id = $_GET['id'];

// If we decided to delete, execute delete query and redirect to the main page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM books WHERE book_id ='$id'";
    $result = mysqli_query($db, $sql);
    // Redirect to the main page
    header("Location: booklist.php");
} else {
    // To access the book data
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
    <meta name="description" content="Page for confirmation before deleting the book from the catalogue.">
    <meta name="keywords" content="BookSpace, Book, Catalogue">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title>Delete <?php echo $result['title']; ?> - BookSpace</title>
    <link rel="stylesheet" href="../../stylesheet/style.css">
</head>

<body>
    <!-- Header -->
    <?php include 'header2.php'; ?>

    <main id=home>
    <a class="back-link" href="booklist.php">&laquo; Back to List</a>
        <section>      
            <h2>Delete Book</h2>
            <div class="page-delete">
                <p>Are you sure you want to delete this book? This action cannot be undone!</p>
                <h3 class="item"><?php echo $result['title']; ?></h3>

                <form action="<?php echo 'delete.php?id=' . $result['book_id']; ?>" method="post">
                    <input class="button" type="submit" name="commit" value="Delete Book" />
                </form>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <?php include("footer.php"); ?>
</body>

</html>