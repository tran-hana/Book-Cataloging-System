<!--
 * Name: Ha Nhu Y Tran, Cheng Qian - Group 9
 * Assignment 2
 * Date: Nov 23, 2024
 * Description: This is the booklist (or homepage afer user log into their account) for the BookSpace platform. It displays a list of books and allows users to search for books by title, author, ISBN, or summary. 
 *  Users can also filter books by genre. Each book listing includes options to view, update, or delete the book. 
 *  The page ensures that only logged-in users can access the catalog by redirecting non-logged-in users to the login page.
 * All the book cover images are taken from folder 'images', their source are also documented in 'covers' table in 'bookspace' database.
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A catalogue of books that BookSpace offers and user can use searhing and filtering tool to enhance their experience, in addition to navigating how to add, read details, update or delete books.">
    <meta name="keywords" content="BookSpace, Book, Catalogue, Show, Add, Delete, Update, Search, Filter">
    <meta name="author" content="Cheng Qian, Ha Nhu Y Tran">
    <title>Booklist - BookSpace</title>
    <link rel="stylesheet" href="../../stylesheet/style.css">
</head>

<body>
    <!-- Header -->
    <?php include("header2.php"); ?>

    <main id="home">

        <section class="search-section">
            <form id="search-form" method="POST" action="">
                <div id="search_box">
                    <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($_POST['search'] ?? ''); ?>">
                    <div class="search-button">
                        <button class="button" type="submit">Search</button>
                        <button class="button" type="reset" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'">Reset</button>
                    </div>
                </div>

                <div class="search-filter-style">
                    <div id="search_type">
                        <p>Search in:</p>

                        <div>
                            <input type="radio" id="search_all" name="search_type" value="all"
                                <?php echo (!isset($_POST['search_type']) || $_POST['search_type'] === 'all') ? 'checked' : ''; ?>>
                            <label for="search_all">All</label>
                        </div>

                        <div>
                            <input type="radio" id="search_title" name="search_type" value="title"
                                <?php echo (isset($_POST['search_type']) && $_POST['search_type'] === 'title') ? 'checked' : ''; ?>>
                            <label for="search_title">Title</label>
                        </div>

                        <div>
                            <input type="radio" id="search_author" name="search_type" value="author"
                                <?php echo (isset($_POST['search_type']) && $_POST['search_type'] === 'author') ? 'checked' : ''; ?>>
                            <label for="search_author">Author</label>
                        </div>

                        <div>
                            <input type="radio" id="search_isbn" name="search_type" value="isbn"
                                <?php echo (isset($_POST['search_type']) && $_POST['search_type'] === 'isbn') ? 'checked' : ''; ?>>
                            <label for="search_isbn">ISBN</label>
                        </div>

                        <div>
                            <input type="radio" id="search_summary" name="search_type" value="summary"
                                <?php echo (isset($_POST['search_type']) && $_POST['search_type'] === 'summary') ? 'checked' : ''; ?>>
                            <label for="search_summary">Summary</label>
                        </div>
                    </div>

                    <div id="filter">
                        <label for="filter">Filter by Genre:</label>
                        <select id="filter" name="filter">
                            <option value="" <?php echo (!isset($_POST['filter']) || $_POST['filter'] === '') ? 'selected' : ''; ?>>All</option>
                            <?php
                            $genres_sql = "SELECT genre_name FROM genres";
                            $genres_result_set = mysqli_query($db, $genres_sql);
                            while ($genres_results = mysqli_fetch_assoc($genres_result_set)) {
                                $selected = (isset($_POST['filter']) && $_POST['filter'] === $genres_results['genre_name']) ? 'selected' : '';
                                echo '<option value="' . $genres_results['genre_name'] . '" ' . $selected . '>' . $genres_results['genre_name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </section>

        <section class="recommended-books">
            <h2>Let's Take A Look At Our Books</h2>
            <p> <strong> Click <a class="add-link" href="add.php" class="nav-link" class="blur-background">here</a> to Add a Book!</strong></p>

            <div class="homediv">

                <?php
                $search_sql = "SELECT books.book_id, books.title, books.author, books.isbn, genres.genre_name, covers.cover_url, covers.alt_text 
                                    FROM books 
                                    INNER JOIN covers ON books.cover_id = covers.cover_id
                                    INNER JOIN genres ON books.genre_id = genres.genre_id";

                $search_text = mysqli_real_escape_string($db, $_POST['search'] ?? '');
                $search_type = mysqli_real_escape_string($db, $_POST['search_type'] ?? 'all');
                $genre = mysqli_real_escape_string($db, $_POST['filter'] ?? '');

                $conditions = [];
                // Define conditions by search type
                if (!empty($search_text)) {
                    switch ($search_type) {
                        case 'title':
                            $conditions[] = "books.title LIKE '%$search_text%'";
                            break;
                        case 'author':
                            $conditions[] = "books.author LIKE '%$search_text%'";
                            break;
                        case 'isbn':
                            $conditions[] = "books.isbn LIKE '%$search_text%'";
                            break;
                        case 'summary':
                            $conditions[] = "books.summary LIKE '%$search_text%'";
                            break;
                        case 'all':
                        default:
                            $conditions[] = "(books.title LIKE '%$search_text%' OR books.author LIKE '%$search_text%' OR books.isbn LIKE '%$search_text%' OR books.summary LIKE '%$search_text%')";
                            break;
                    }
                }
                // Define conditions by genre
                if (!empty($genre)) {
                    $conditions[] = "genres.genre_name = '$genre'";
                }
                // Combine conditions
                if (!empty($conditions)) {
                    $search_sql .= " WHERE " . implode(" AND ", $conditions);
                }

                $search_result_set = mysqli_query($db, $search_sql);

                if (mysqli_num_rows($search_result_set) > 0) {
                    while ($search_result = mysqli_fetch_assoc($search_result_set)) { ?>
                        <div>
                            <img class="bookimage" src="<?php echo "../../" . htmlspecialchars($search_result['cover_url']); ?>"
                                alt="<?php echo htmlspecialchars($search_result['alt_text']); ?>">
                            <p><strong><?php echo $search_result['title']; ?></strong></p>
                            <p>Author: <?php echo $search_result['author']; ?></p>
                            <p>ISBN: <?php echo $search_result['isbn']; ?></p>
                            <nav class="main-nav">
                                <a href="<?php echo "show.php?id=" . $search_result['book_id']; ?>" class="nav-link">Show</a>
                                <a href="<?php echo "delete.php?id=" . $search_result['book_id']; ?>" class="nav-link">Delete</a>
                                <a href="<?php echo "update.php?id=" . $search_result['book_id']; ?>" class="nav-link">Update</a>
                            </nav>
                        </div>
                    <?php }
                } else { ?>
                    <p>Sorry! No results found for your search criteria.</p>
                <?php } ?>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <?php include("footer.php"); ?>
</body>

</html>