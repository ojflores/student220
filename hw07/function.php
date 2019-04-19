<?php

# include database configuration file
include('db.php');

# connect to database
$dbh = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);

//function that returns example book by querying the database for a single example book written by a given authorid
    function get_example_book($author_id){
        global $dbh;
        
        $SQL = "SELECT bookTitle ";
        $SQL .= "FROM author a ";
        $SQL .= "JOIN book_author b ON a.authorID=b.authorID ";
        $SQL .= "JOIN book c ON b.bookID=c.bookID ";
        $SQL .= "WHERE a.authorID = $author_id ";
        $SQL .= "LIMIT 1";
        
        $sth = $dbh->prepare($SQL);
        $sth->execute();
        
        while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo "<td>{$row['bookTitle']}</td>";
        }
    }

//function that grabs how many authors, books and series are in the database
    function find_authors($sort_by){
        global $dbh;
        
        $SQL = "SELECT author.authorFirst, author.authorLast, COUNT(book_author.authorID) as number_of_books, author.authorID ";
        $SQL .= "FROM author, book_author ";
        $SQL .= "WHERE author.authorID = book_author.authorID ";
        $SQL .= "GROUP BY author.authorID ";
        $SQL .= "ORDER BY {$sort_by}";
        
        $sth = $dbh->prepare($SQL);
        $sth->execute();

        echo "<table>
                <th><a href='?authorsort=authorFirst'>Author Name</a></th>
                <th><a href='?authorsort=number_of_books'>Number of Books</th>
                <th>Example Book</th>";

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>
            <td>{$row['authorFirst']} {$row['authorLast']}</td>
            <td>{$row['number_of_books']}</td>";
            get_example_book($row['authorID']);
            echo "</tr>";
        }

        echo "</table>";
    }
    
    //displays the book's name, series, author, publisher, published date, # of pages, and book isbn
    function books($sort_by, $collection){
        global $dbh;

        if ($collection == 1){
            $SQL = "SELECT bookTitle, seriesName, authorFirst, authorLast, bookISBN, bookPages, bookPublishedDate, bookPublisher ";
            $SQL .= "FROM book b ";
            $SQL .= "JOIN book_series s ON b.bookID=s.bookID ";
            $SQL .= "JOIN series d on s.seriesID=d.seriesID ";
            $SQL .= "JOIN book_author a ON b.bookID=a.bookID ";
            $SQL .= "JOIN author u ON a.authorID=u.authorID ";
            $SQL .= "ORDER BY {$sort_by}";
        } else {
            $SQL = "SELECT bookTitle, seriesName, authorFirst, authorLast, bookISBN, bookPages, bookPublishedDate, bookPublisher ";
            $SQL .= "FROM book b ";
            $SQL .= "JOIN book_series s ON b.bookID=s.bookID ";
            $SQL .= "JOIN series d on s.seriesID=d.seriesID ";
            $SQL .= "JOIN book_author a ON b.bookID=a.bookID ";
            $SQL .= "JOIN author u ON a.authorID=u.authorID ";
            $SQL .= "JOIN book_collection c ON b.bookID=c.collectionID ";
            $SQL .= "WHERE c.bookID = {$collection} ";
            $SQL .= "ORDER BY {$sort_by}";
        }
        
        echo "<form>
                <input type='radio' name='collection' value='1' checked>My Library<br>
                <input type='radio' name='collection' value='2'>Wishlist<br>
                <input type='radio' name='collection' value='3'>Unread<br>
                <input type='radio' name='collection' value='4'>Read<br>
                <input type='submit' value='Submit' name='collection_retrieve'>
            </form>";


        $sth = $dbh->prepare($SQL);
        $sth->execute();
        
        echo "<table>
            <th><a href='?booksort=bookTitle'>Book Name</a></th>
            <th><a href='?booksort=seriesName'>Series Name</a></th>
            <th><a href='?booksort=authorFirst'>Book Author</a></th>
            <th><a href='?booksort=bookPublisher'>Book Publisher</a></th>
            <th><a href='?booksort=bookPublishedDate'>Published Date</a></th>
            <th><a href='?booksort=bookPages'>Number of Pages</a></th>
            <th><a href='?booksort=bookISBN'>Book ISBN</a></th>";
        
        while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>
                    <td>{$row['bookTitle']}</td>
                    <td>{$row['seriesName']}</td>
                    <td>{$row['authorFirst']} {$row['authorLast']}</td>
                    <td>{$row['bookPublisher']}</td>
                    <td>{$row['bookPublishedDate']}</td>
                    <td>{$row['bookPages']}</td>
                    <td>{$row['bookISBN']}</td>
                </tr>";
        }
        
        echo "</table>";
    }

//function that returns an example book given a seriesid
//is called from the series() function as a helper 
    function find_ex_series($seriesID){
        global $dbh;
        
        $SQL = "SELECT bookTitle ";
        $SQL .= "FROM series a ";
        $SQL .= "JOIN book_series b ON a.seriesID=b.seriesID ";
        $SQL .= "JOIN book c ON b.bookID=c.bookID ";
        $SQL .= "WHERE a.seriesID = $seriesID ";
        $SQL .= "LIMIT 1";
        
        $sth = $dbh->prepare($SQL);
        $sth->execute();
        
        while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo "<td>{$row['bookTitle']}</td>";
        }
    }

//function displays the series, how many in each series, and example books
//called from the if statements back on index.php
    function series($sort_by){
        global $dbh;

        $SQL = "SELECT seriesName, COUNT(bookID) as number_of_books, series.seriesID ";
        $SQL .= "FROM series, book_series ";
        $SQL .= "WHERE series.seriesID = book_series.seriesID ";
        $SQL .= "GROUP BY series.seriesID ";
        $SQL .= "ORDER BY {$sort_by}";
        
        echo "<table>";
        echo "<th><a href='?series_sort=seriesName'>Series' Name</a></th>";
        echo "<th><a href='?series_sort=number_of_books'>Number of Books</a></th>";
        echo "<th>Example Book</th>";
        
        $sth = $dbh->prepare($SQL);
        $sth->execute();
        
        while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>
                <td>{$row['seriesName']}</td>
                <td>{$row['number_of_books']}</td>";
                find_ex_series($row['seriesID']);
            echo "</tr>";
        }
        
        echo "</table>";
    }

    //displays a way for you to search for a book by isbn, author, title, publication date, and number of pages
    function search(){
        echo "<form method='get' action='index.php'> Search by
                <label for='searchfield'>Searchfield:</label>
                    <input type='radio' name='searchterm' value=bookTitle>Book
                    <input type='radio' name='searchterm' value=authorFirst>Name<br>
                <label for='searchfield'>Collection Field:</label>
                    <input type='radio' name='collection_term' value='1' checked>My library
                    <input type='radio' name='collection_term' value='2'>Wishlist
                    <input type='radio' name='collection_term' value='3'>Unread
                    <input type='radio' name='collection_term' value='4'>Read<br>
                <label for='searchtext' method='get'>
                    <input type='text' name='searchtext' size='10' maxlength='30' placeholder='search text' />
                </label>
                <input type='submit' value='Submit' name='search_term'>
            </form>";
    }
    //function that dearches for information on a given book
    function search_book($search_by, $collection, $search_text){
        global $dbh;
        
        if($search_by == 'bookTitle'){
            $SQL = "SELECT bookTitle, seriesName, authorFirst, authorLast, bookISBN, bookPages, bookPublishedDate, bookPublisher ";
            $SQL .= "FROM book b ";
            $SQL .= "JOIN book_series s ON b.bookID=s.bookID ";
            $SQL .= "JOIN series d on s.seriesID=d.seriesID ";
            $SQL .= "JOIN book_author a ON b.bookID=a.bookID ";
            $SQL .= "JOIN author u ON a.authorID=u.authorID ";
            $SQL .= "JOIN book_collection c ON b.bookID=c.collectionID ";
            $SQL .= "WHERE c.bookID = {$collection} AND bookTitle = '{$search_text}'";

            $sth = $dbh->prepare($SQL);
            $sth->execute();
            
            echo "<table>
                <th><a href='?booksort=bookTitle'>Book Name</a></th>
                <th><a href='?booksort=seriesName'>Series Name</a></th>
                <th><a href='?booksort=authorFirst'>Book Author</a></th>
                <th><a href='?booksort=bookPublisher'>Book Publisher</a></th>
                <th><a href='?booksort=bookPublishedDate'>Published Date</a></th>
                <th><a href='?booksort=bookPages'>Number of Pages</a></th>
                <th><a href='?booksort=bookISBN'>Book ISBN</a></th>";
            
            while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr>
                        <td>{$row['bookTitle']}</td>
                        <td>{$row['seriesName']}</td>
                        <td>{$row['authorFirst']} {$row['authorLast']}</td>
                        <td>{$row['bookPublisher']}</td>
                        <td>{$row['bookPublishedDate']}</td>
                        <td>{$row['bookPages']}</td>
                        <td>{$row['bookISBN']}</td>
                    </tr>";
            }
            
            echo "</table>";
        } else {
            $SQL = "SELECT author.authorFirst, author.authorLast, COUNT(book_author.authorID) as number_of_books, author.authorID ";
            $SQL .= "FROM author, book_author ";
            $SQL .= "WHERE author.authorID = book_author.authorID AND author.authorFirst = '{$search_text}' ";
            $SQL .= "GROUP BY author.authorID ";
            
            $sth = $dbh->prepare($SQL);
            $sth->execute();

            echo "<table>
                    <th><a href='?authorsort=authorFirst'>Author Name</a></th>
                    <th><a href='?authorsort=number_of_books'>Number of Books</th>
                    <th>Example Book</th>";

            while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>
                <td>{$row['authorFirst']} {$row['authorLast']}</td>
                <td>{$row['number_of_books']}</td>";
                get_example_book($row['authorID']);
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    //function that displays how many books are in the database
    function home(){
        global $dbh;
        $books = $dbh->query($SQL = 'SELECT COUNT(bookID) FROM book');
        $authors = $dbh->query($SQL = 'SELECT COUNT(authorID) FROM author');
        $series = $dbh->query($SQL = 'SELECT COUNT(seriesID) FROM series');
        echo "<div>";
        echo "<h2 style = \"text-align: center;\">Welcome</h2>";
        echo "<p style = \" text-align: center; font-size: 30px;\">
                On this site there are {$books->fetchColumn()} books written by
                {$authors->fetchColumn()} authors, for a total of {$series->fetchColumn()} series.<br> 
                Feel free to browse around and explore!</p>";
        echo "</div>";
    }   

            
?>
