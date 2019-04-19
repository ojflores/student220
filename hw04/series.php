<?php
    include "functions.php";

    //finds the number of books in a series
    function number_of_series($name){
        $book_id_arr = array();
        $books = file("library_series.csv");
        foreach($books as $book){
            list( , $series_name, ) = explode(',', $book);
            $book_id_arr[] = $series_name;
        }
        $number = count(array_keys($book_id_arr, $name));
        return $number;
    }

    //displays all the series info
    function series_info(){
        $books = file("library_series.csv");
        $check_array = array();
        //takes each line and seperates out by id, first, last names
        foreach($books as $book) {
            //assigns each item into variables
            list($book_id, $series_name, $position) = explode(",", $book);
            
            //takes off the newline
            $position = trim($position);

            $number = number_of_series($series_name);
            if(already_posted($check_array, $series_name)){
                continue;
            } else {
                $check_array[] = $series_name;
                $book_name = find_book($book_id);
                echo "<tr>
                    <td>{$series_name}</td>
                    <td>{$number}</td>
                    <td>{$book_name}</td>
                    </tr>";
            }
            
            
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
    <h1>Series Found in Library</h1>
    <?php
        echo "<table>
         <th>Book Series</th>
         <th>Number of Books</th>
         <th>Example Books</th>";
        series_info();
        echo "</table>";
    ?>
</body>
</html>