<?php
    include "functions.php";
    //makes an array of series with the ids of the books that are in that series as the index
    function get_series(){
        $book_id_arr = array();
        $books = file("library_series.csv");
        foreach($books as $book){
            list($book_id, $series_name, $position) = explode(',', $book);
            $book_id_arr[$book_id] = $series_name;
        }
        return $book_id_arr;
    }

    
    function book_info(){
        $books = file("library_books.csv");
        $authors_arr = get_authors();
        $series = get_series();
        //takes each line and seperates out by id, first, last names
        foreach($books as $book) {
            //assigns each item into variables
            list($book_id, $book_name, $book_publisher, $published_date, $pages, $isbn) = explode(",", $book);
            
            //takes off the newline
            $isbn = trim($isbn);

            //outputs it as a table
            echo "<tr>
                    <td>{$book_name}</td>
                    <td>{$series[$book_id]}</td>
                    <td>{$authors_arr[$book_id]}</td>
                    <td>{$book_publisher}</td>
                    <td>{$published_date}</td>
                    <td>{$pages}</td>
                    <td>{$isbn}</td>
                    </tr>";
        }
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
    <h1>These are the Books</h1>
    <?php
        
        echo "<table>
         <th>Book Name</th>
         <th>Book Series</th>
         <th>Book Author</th>
         <th>Book Publisher</th>
         <th>Published Date</th>
         <th>Number of Pages</th>
         <th>Book ISBN</th>";
        book_info();
        echo "</table>";
        
    ?>
</body>
</html>