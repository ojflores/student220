<!DOCTYPE html>
<html lang=en>
    <head>
        <title>EXAM/Seating chart</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="hero-image">
            <form method="post" action="index.php">
                <input type="submit" value="Home" name="home"> 
            </form>
            <form method="post" action="index.php">
                <input type="submit" value="Add_student" name="add_student">
            </form>
            <form method="post" action="index.php">
                <input type="submit" value="View Chart" name="view_chart">
            </form>
            <a href="http://floros-cptr220.cs.wallawalla.edu/exams/midterm/index.php">Link to this page</a>
            <a href="https://www.wallawalla.edu/">Link to the university page</a>
        </div>
        <br>    
        <h1>Welcome to the Classroom Seating Page</h1>
        <p>
            If you would like to add yourself to the seating chart<br>
            please click on Add Student at the top of the page and follow those instructions<br>
            Otherwise, you can also click on View Chart at the top of the page to see everyone<br>
            enrolled.
        </p>
        
        <?php
            include "functions.php";
            if(isset($_POST['home']))
            {
                home();
            }
            if(isset($_POST['add_student']))
            {
                add_student();
            }
            if(isset($_POST['view_chart']))
            {
                view_chart();
            }
            if(isset($_POST['added_student']))
            {
                check_seat($_POST['fname'], $_POST['lname'], $_POST['seat_number'], $_FILES['pic']['tmp_name']);
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