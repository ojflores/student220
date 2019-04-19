<?php

    
//Read in library csv files and store them as global variables
    $series = file("library_series.csv");
    $authors = file("library_authors.csv");
    $books = file("library_books.csv");
    array_shift($books);
    array_shift($authors);
    array_shift($series);

//function to search by isbn
//PROFESSOR CARMAN: I straight up do not understand what is wrong with this function, it won't work
//the conditional statement never returns that the two items are identical
//which is weird because i used the same method as the other functions
    function by_isbn($isbn){
        global $books;
        foreach($books as $book) {
            $book = str_replace('"', "", $book);
            $bookarr = explode(',', $book);
            if($bookarr[5] == $isbn){
                echo $isbn;
            }
        }        
    }

//function to search by publication date


//function to search by number of pages


//finds all the books in the series by getting the series name, running it through
//series list, the returning all the books by id in that series as an array
    function search_series($series_name){
        
        global $series;
        $series_list = array();
        foreach($series as $lines){
            $series_temp = str_getcsv($lines);
            if($series_temp[1] == $series_name){
                $series_list[] = $series_temp[0];
            }
        }
        echo "<h1>Books in this Series</h1><br>";
        echo "<h2>$series_name</h2><br>";
        foreach($series_list as $bookid){
            $books = get_book_by_id($bookid);
            echo $books;
            echo "<br>";
        }
    }

//function that searches all the things written by an author
    function search_author($author_name){
        global $authors;
        $allAuths = array();
        $needed_books = array();
        foreach($authors as $author) {
            $author = str_replace('"', "", $author);
            $authorarr = explode(',', $author);
            $thisAuthor = trim($authorarr[1] . " " . $authorarr[2]);
            $allAuths[$authorarr[0]] = $thisAuthor;
        }
        foreach($allAuths as $books => $names){
            if($author_name == $names){
                $needed_books[] = $books;
            }
        }
        echo "<h1>Book(s) written by {$author_name}</h1><br>";
        foreach($needed_books as $bookid){
            $books = get_book_by_id($bookid);
            echo $books;
            echo "<br>";
        }
    }

//searches and displays everything about a book by book name
    function search_book($book_name){
        global $books;
        foreach($books as $book) {
            $book = str_replace('"', "", $book);
            $bookarr = explode(',', $book);
            if($bookarr[1] == $book_name){
                $bookid = $bookarr[0];
                $pub_date = $bookarr[3];
                $isbn = $bookarr[5];
                break;
            }
        }
        $book_author = get_author($bookid);
        $book_series = get_series($bookid);
        echo "<h1>Book: {$book_name}</h1><br>";
        echo "Title: {$book_name}<br>";
        echo "Author: {$book_author}<br>";
        echo "Series: {$book_series}<br>";
        echo "Publication date: {$pub_date}<br>";
        echo "ISBN: {$isbn}<br>";

    }

//Function that returns the number of books in the library
    function get_book_count(){
        global $books;
        return count($books);
    }

//Function that returns the number of authors in the library
//Does this by pushing each author to an array, getting rid of duplicate elements, then returning the number of elements in the array.
    function get_author_count(){
        global $authors;
        $allAuthArr = array();
        foreach($authors as $author){
            $authorarr = str_getcsv($author);
            array_push($allAuthArr,$authorarr[1].$authorarr[2]);
        }
        return count(array_unique($allAuthArr));
    }

//Function that returns the number of series in the library
//Does this by pushing each series to an array, getting rid of duplicate elements, then returning the number of elements in the array.
    function get_series_count(){
        global $series;
        $allSerArr = array();
        foreach($series as $set){
            $setarr =str_getcsv($set);
            array_push($allSerArr,$setarr[1]);
        }
        return count(array_unique($allSerArr));
    }

//Function to return all the authors in the library
    function get_all_authors(){
        global $authors;
        $allAuthArr = array();
        foreach($authors as $author){
            $authorarr = str_getcsv($author);
            array_push($allAuthArr,trim($authorarr[1]." ".$authorarr[2]));
        }
        return array_unique($allAuthArr);
    }

//Function to return all the series in the library
    function get_all_series(){
        global $series;
        $allSeriesArr = array();
        foreach($series as $set) {
            $set = str_replace('"', "", $set);
            $setarr = explode(',', $set);
            array_push($allSeriesArr,$setarr[1]);
        }
        return array_unique($allSeriesArr);
    }

//Function to retrieve what Series a book is in using the book's ID number
//Returns a string containing the series' name or "None", whichever applies
    function get_series($bookID) {
        global $series;
        foreach($series as $set) {
            $set = str_replace('"', "", $set);
            $setarr = explode(',', $set);
            if($bookID == $setarr[0]){
                return "$setarr[1]";
            }
        }
        return "None";
    }

//Function to retrieve a book's name using its ID number
//Returns a string containing the books's name or "None", whichever applies
    function get_book_by_id($bookid){
        global $books;
        foreach($books as $book) {
            $book = str_replace('"', "", $book);
            $bookarr = explode(',', $book);
            if($bookid==$bookarr[0]){
                return $bookarr[1];
            }
        }
        return "None";
    }

//Function to get the author of a book using the book's ID number
//Returns a string containing the author's name or "None", whichever applies
    function get_author($bookID) {
        global $authors;
        foreach($authors as $author) {
            $author = str_replace('"', "", $author);
            $authorarr = explode(',', $author);
            if($bookID == $authorarr[0]){
                return trim($authorarr[1] . " " . $authorarr[2]);
            }
        }
        return "None";
    }

//Function that prints out authors, the number of books that they wrote, and a title of a book they wrote.
    function get_author_list(){
        global $authors;
        $allAuths = array();

        //Set up an array with all the authors in it call allAuths
        foreach($authors as $author) {
            $author = str_replace('"', "", $author);
            $authorarr = explode(',', $author);
            $thisAuthor = trim($authorarr[1] . " " . $authorarr[2]);
            array_push($allAuths, $thisAuthor);
        }

        //Count the number of books each author wrote
        $authKeyArr = array_count_values($allAuths);

        //For each author in the array of authors, find a book that they wrote and associate it with that author using a hash
        foreach($authors as $author) {
            $author = str_replace('"', "", $author);
            $authorarr = explode(',', $author);
            $thisbookid = $authorarr[0];
            $thisAuthor = trim($authorarr[1] . " " . $authorarr[2]);
            $allAuthT[$thisAuthor] = get_book_by_id($thisbookid);
        }

        //set up an array that is all of the authors sorted alphabetically
        $authors1 = get_all_authors();
        sort($authors1);

        //Print the author, the number of books they've written, and a title of one of their books
        foreach($authors1 as $author) {
            $thisNum = $authKeyArr[$author];
            $thisTitle = $allAuthT[$author];
            echo "<tr>
				<td><a href='?search_author=$author'>$author</a></td>
				<td>$thisNum</td>
				<td><a href='?search_book=$thisTitle'>$thisTitle</a></td>
			</tr>
			";
        }
    }

//Function that prints out series, the number of books in the series, and the titles of the books in the series.
    function get_series_list(){
        global $series;
        $seriesHash = array();
		$seriesCount = array();

        //Set up hash storing all the books in a certain series corresponding to the series they're in
        foreach($series as $set){
			$set = str_replace('"', "", $set);
			$setarr = explode(',', $set);
			$seriesHash[$setarr[1]] = $setarr[1] . ", " . get_book_by_id($setarr[0]);
			$seriesHash[$setarr[1]] = ltrim($seriesHash[$setarr[1]], ',');
			//Set up hash storing the number of books in each series
			if (array_key_exists($setarr[1], $seriesCount)) {
				$seriesCount[$setarr[1]] += 1;
			} else {
				$seriesCount[$setarr[1]] = 1;
			}
			
        }

        //Print all the series with the number of books in the series and the titles of those books
        $series1 = get_all_series();
        foreach($series1 as $set) {
            $thisNum = $seriesCount[$set];
            $thisTitles = $seriesHash[$set];
            print "<tr>
				<td><a href='?search_series=$set'>$set</a></td>
				<td>$thisNum</td>
				<td>$thisTitles</td>
			</tr>
			";
        }
    }

//Function that prints out all the books along with other information about the book.
    function get_book_list(){
        global $books;
        foreach($books as $book) {
            $book = str_replace('"', "", $book);
            $bookarr = explode(',', $book);
            $thisSeries = get_series($bookarr[0]);
            $thisAuthor = get_author($bookarr[0]);
            print "<tr>
				<td><a href='?search_book=$bookarr[1]'>$bookarr[1]</a></td>
				<td><a href='?search_series=$thisSeries'>$thisSeries</a></td>
				<td><a href='?search_author=$thisAuthor'>$thisAuthor</a></td>
				<td>$bookarr[4]</td>
				<td>" . trim($bookarr[5]) . "</td>
				<td>$bookarr[3]</td>
				<td>$bookarr[2]</td>
			</tr> 
			";
        }
    }
?>