<!-- 
 * Name: Ha Nhu Y Tran, Cheng Qian - Group 9
 * Assignment 2
 * Date: Nov 23, 2024
 * Description: This script processes the form data submitted via POST request from newbook.php. 
 * It handles book information such as title, author, ISBN, genre, and publication year. The script also manages file uploads for book cover images and inserts data into the database, including storing the uploaded cover image path and inserting book details into the 'books' table. 
 * After successful insertion, the user is redirected to the "show" page to view the newly added book.
-->

<?php
session_start();
require_once('database.php');
$db = db_connect();

// Handle form values sent by newbook.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Ensure data is submitted via POST request
    $title = $_POST['title']; // Retrieve the form data
    $encoded_title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); // Converts special characters to HTML entities
    $author = $_POST['author'];
    $encoded_author = htmlspecialchars($author, ENT_QUOTES, 'UTF-8'); // Converts special characters to HTML entities
    $isbn = $_POST['isbn'];
    $genre_id = $_POST['genre_id'];
    $publication_year = $_POST['publication_year'];
    $summary = $_POST['summary'];
    $encoded_summary = htmlspecialchars($summary, ENT_QUOTES, 'UTF-8'); // Converts special characters to HTML entities
    $reference_source = $_POST['reference_source'];
    $encoded_reference_source = htmlspecialchars($reference_source, ENT_QUOTES, 'UTF-8'); // Converts special characters to HTML entities

    $file_path = ""; // Initialize with an empty string
    
    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        if ($_FILES['image']['size'] > 2097152) {
            $errors = 'Failed to upload: File size must not exceed 2 MB';
        }
        // If no errors, move the file to the target directory
        if (empty($errors) == true && isset($_FILES['image'])) {
            move_uploaded_file($file_tmp, "../../images/" . $_FILES['image']['name']);
            $file_path = "images/" . $_FILES['image']['name'];
        } else {
            echo "<br>";
            echo "<br>";
            print($errors);
        }
    }

    
    if ($file_path) {
        $cover_sql = "INSERT INTO covers (cover_url, alt_text, caption) VALUES ('$file_path', 'This is cover book that user uploaded','Cover of the newly added book')";
        $cover_result_set = mysqli_query($db, $cover_sql);

        // Get the last inserted `cover_id`
        $cover_id = mysqli_insert_id($db);
        $book_sql = "INSERT INTO books (title, author, isbn, cover_id, genre_id, publication_year, summary, reference_source) 
    VALUES ('$encoded_title', '$encoded_author', '$isbn', '$cover_id','$genre_id', '$publication_year', '$encoded_summary', '$encoded_reference_source')";
        $result = mysqli_query($db, $book_sql);
        $id = mysqli_insert_id($db);

        // Redirect to the "show" page with the newly inserted book's ID
        header("Location: show.php?id=$id");
    }
}
// Redirect to the form page if the request method is not POST
else {
    header("Location: newbook.php");
}

