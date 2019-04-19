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
        //global to be used when calling books() so as to show no collection value
        $default_collection = 1;
        include "function.php";
        

        //i know it looks messy, but this allows you to switch what is displayed
        //on the page, switch cases will be used later if time permits
        if(isset($_POST['home']))
        {
            home();
        } 
        if(isset($_POST['authors']))
        {
            find_authors('authorFirst');
        }
        if(isset($_POST['series']))
        {
            series('seriesName');
        }
        if(isset($_POST['books']))
        {
            books('bookTitle', $default_collection);
        }
        if(isset($_POST['search']))
        {
            search($_POST['search']);
        }
        if(isset($_GET['booksort']))
        {
            books($_GET['booksort'], $default_collection);
        }
        if(isset($_GET['series_sort'])){
            series($_GET['series_sort']);
        }
        if(isset($_GET['authorsort'])){
            find_authors($_GET['authorsort']);
        }
        if(isset($_GET['collection_retrieve'])){
            books('bookTitle', $_GET['collection']);
        }
        if(isset($_GET['search_term'])){
            search_book($_GET['searchterm'], $_GET['collection_term'], $_GET['searchtext']);
        }

    ?>
        <footer class="footer">
            <p><a href="https://validator.w3.org/check/referer">validate me</a></p> 
            <p>
                Made By Oscar Flores
            </p>
        </footer>
    </body>
</html>