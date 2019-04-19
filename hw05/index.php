<!DOCTYPE html>
<html>
    <head>
        <title>This is the Library.</title>
        <link rel="stylesheet" href="all.css">
    </head>
    <body>
    
        <h1>Digi-Library</h1>


        <!-- each form here displays a different button to change what is displayed -->
        <form method="post" action="index.php">
            <input type="submit" value="Home" name="home"> 
        </form>
        <form method="post" action="index.php">
            <input type="submit" value="Authors" name="authors">
        </form>
        <form method="post" action="index.php">
            <input type="submit" value="Series" name="series"> 
        </form>
        <form method="post" action="index.php">
            <input type="submit" value="Books" name="books"> 
        </form>
        <form method="post" action="index.php">
            <input type="submit" value="Search" name="search"> 
        </form>
        <form method="post" action="index.php">
            <input type="submit" value="Image" name="image"> 
        </form>

    <?php
        include "functions.php";
        //displays a way for you to search for a book by isbn, author, title, publication date, and number of pages
        function search(){
            echo "<form method='get' action='index.php'> Search by
                    <label for='searchfield'>Searchfield:</label>
                        <input type='radio' name='searchterm' value='isbn' checked>ISBN
                        <input type='radio' name='searchterm' value='date'>Publication Date
                        <input type='radio' name='searchterm' value='pages'>Page Number
                        <input type='radio' name='searchterm' value='book_name'>Book<br>
                    <label for='searchtext' method='get'>
                        <input type='text' name='searchtext' size='10' maxlength='30' placeholder='search text' />
                    </label>
                </form>";
        }
        //displays the home page, how many books there are and what not
        function home()
        {
            $number_of_authors = get_author_count();
            $number_of_books = get_book_count();
            $number_of_series = get_series_count();
            echo "<h1>Authors</h1><br>";
            echo "There are {$number_of_authors} in this library<br>";
            echo "<h1>Books</h1><br>";
            echo "There are {$number_of_books} in this library<br>";
            echo "<h1>Series</h1>";
            echo "There are {$number_of_series} in this library<br>";
        }

        //displays the author's name, number of books, and example book
        //uses functions found in functions.php
        function authors(){
            echo "<table>";
            echo "<th>Author's Name</th>";
            echo "<th>Number of Books</th>";
            echo "<th>Example Book</th>";
            get_author_list();
            echo "</table>";    
        }

//displays the series, how many in each series, and example books
        function series(){
            echo "<table>";
            echo "<th>Series' Name</th>";
            echo "<th>Number of Books</th>";
            echo "<th>Example Book</th>";
            get_series_list();
            echo "</table>";
        }



        //displays the book's name, series, author, publisher, published date, # of pages, and book isbn
        function books(){
            echo "<table>
                <th>Book Name</th>
                <th>Book Series</th>
                <th>Book Author</th>
                <th>Book Publisher</th>
                <th>Published Date</th>
                <th>Number of Pages</th>
                <th>Book ISBN</th>";
                get_book_list();
            echo "</table>";
        }

        //brings up a page to upload an image
        function image_upload(){
            echo " <form action='index.php'>
            <input type='file' name='pic' accept='image/*>
            <input type='submit'>
          </form> ";
        }

        //i know it looks messy, but this allows you to switch what is displayed
        //on the page, switch cases will be used later if time permits
        if(isset($_POST['home']))
        {
            home();
        } 
        if(isset($_POST['authors']))
        {
            authors();
        }
        if(isset($_POST['image']))
        {
            image_upload();
        }
        if(isset($_POST['series']))
        {
            series();
        }
        if(isset($_POST['books']))
        {
            books();
        }
        if(isset($_POST['search']))
        {
            search($_POST['search']);
        }
        if(isset($_GET['search_book']))
        {
            search_book($_GET['search_book']);
        }
        if(isset($_GET['search_author']))
        {
            search_author($_GET['search_author']);
        }
        if(isset($_GET['search_series']))
        {
            search_series($_GET['search_series']);
        }
        if(isset($_GET['searchterm']))
        {
            by_isbn($_GET['searchtext']);
        }

    ?>
    </body>
</html>