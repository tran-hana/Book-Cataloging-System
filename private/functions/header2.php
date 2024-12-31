<!--
* Name: Ha Nhu Y Tran, Cheng Qian - Group 9
* Assignment 2
* Date: Nov 23, 2024
* Description:  This section contains the header of the BookSpace website, which includes the website logo
* and the title "BookSpace". This header is shared between booklist.php, newbook.php, show.php, update.php, delete.php, and profile.php.
-->

<header id="header2">
    <nav class="header-left">
        <a href="booklist.php">Home</a>
    </nav>

    <div>
        <img class="image" src="../../images/logo1.png" alt="Logo of BookSPace website, representing a stack of pastel-colored books with a playful design">
        <h1>BookSpace</h1>
    </div>

    <nav class="header-right">
        <a href="<?php echo "profile.php?user=" . $_SESSION['valid_user']; ?>"><?php echo $_SESSION['valid_user']; ?></a>
        <button class="logout-format"onclick="window.location.href='logout.php'">Log Out</button>
    </nav>
</header>
