<?php
    include "functions.php";
    //finds how many books an author wrote
    function number_of_series($name, $filename){
        $author_names = array();
        $books = file($filename);
        foreach($books as $book){
            list( , $firstname, $lastname) = explode(',', $book);
            $appended = $firstname . " " . $lastname;
            $book_id_arr[] = $appended;
        }
        $number = count(array_keys($book_id_arr, $name));
        return $number;
    }
    
    

    
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="all.css">
    <title>
        These are the authors.
    </title>
</head>
<body>
    <div class="topnav">
        <a href="books.php">Books</a>
        <a href="authors.php">Authors</a>
        <a href="series.php">Series</a>
        <a href="index.php">Home</a>
    </div>
    <h1>These are the Authors</h1>
    <?php
        echo "<table>";
        echo "<th>Author's Name</th>";
        echo "<th>Number of Books</th>";
        echo "<th>Example Book</th>";
        print_authors();
        echo "</table>"
    ?>
</body>
</html>