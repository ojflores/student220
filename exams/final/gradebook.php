<?php
$db_host = '127.0.0.1';
$db_port = '3306';
$db_user = 'dbuser';
$db_pass = 'test123';
$db_name = 'gradebook';

$dbh = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
if($_GET['queries'] == 'first'){
    $SQL = "SELECT gb_student_first, gb_student_last ";
    $SQL .= "FROM gb_student";
    $sth = $dbh->prepare($SQL);
    $sth->execute();

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        echo $row['gb_student_first'] . " " . $row['gb_student_last'] . ", ";
    }
} else {
    $student = explode(" ", $_GET['queries']);
    $SQL = "SELECT gb_grade_assignment, gb_grade_letter ";
    $SQL .= "FROM gb_grade a ";
    $SQL .= "JOIN gb_student b ON a.gb_student_id = b.gb_student_id ";
    $SQL .= "WHERE b.gb_student_first = '" . $student[0] . "' AND b.gb_student_last = '" . $student[1] . "'";

    $sth = $dbh->prepare($SQL);
    $sth->execute();
    echo "<table align='center'>";
    while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>" . $row['gb_grade_assignment'] . "</td>";
        echo "<td>" . $row['gb_grade_letter'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}