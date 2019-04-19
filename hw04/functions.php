<?php
    //checks if a name has already been displayed on the screen
    function already_posted($array, $series_name){
        for($i=0; $i < count($array); $i++){
            if($array[$i] == $series_name){
                return true;
            }
        }
        return false;
    }
    //finds books corresponding to a given book id
    function find_book($given_id){
        $books = file("library_books.csv");
        foreach($books as $line){
            list($book_id, $book_name, $book_publisher, $published_date, $pages, $isbn) = explode(",", $line);
            if($book_id == $given_id){
                return $book_name;
            }
        }
    }
    //makes an array of authors with indexes storing the ids of the books they wrote
    function get_authors(){
        $book_id_arr = array();
        $books = file("library_authors.csv");
        foreach($books as $book){
            list($book_id, $first, $second) = explode(',', $book);
            $appended = $first . " " . $second;
            $book_id_arr[$book_id] = $appended;

        }
        return $book_id_arr;
    }
    //can use already_posted and find_book() => series.php
    function print_authors(){
        $check_array = array();
        $books = file("library_authors.csv");
        foreach($books as $book){
            list($book_id, $firstname, $lastname) = explode(',', $book);
            $appended = $firstname . " " . $lastname;
            $number = number_of_series($appended, "library_authors.csv");
            if(already_posted($check_array, $appended)){
                continue;
            } else {
                $check_array[] = $appended;
                $book_name = find_book($book_id);
                echo "<tr>
                    <td>{$appended}</td>
                    <td>{$number}</td>
                    <td>{$book_name}</td>
                    </tr>";
            }
        }
    }
    
?>