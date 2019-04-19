<!DOCTYPE html>
<html>
<head>
    <title>This is the Library.</title>
    <link rel="stylesheet" href="all.css">
</head>
<body>
    <div class="topnav">
        <a href="books.php">Books</a>
        <a href="authors.php">Authors</a>
        <a href="series.php">Series</a>
        <a href="index.php">Home</a>
    </div>
    <h1>Digi-Library</h1>
    <?php
    include "functions.php";
        $number_of_books = count(get_authors());
        echo "<p>Welcome to the Digi-Library website. This site consists of {$number_of_books}
        books within the library written by  authors. These<br>
        books make up a collection of different series, all found in one place for your 
        enjoyment. Feel free to browse at your leisure.</p>";
    ?>
    
</body>
</html>