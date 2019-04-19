<?php

//function takes you to the page that allows you to add a member to the seating chart
    function add_student(){
        echo "<form action='index.php' method='post' enctype='multipart/form-data'>
                First name: <input type='text' name='fname'><br>
                Last name: <input type='text' name='lname'><br>
                Seat Number: <input type='text' name='seat_number'><br>
                Choose a photo you would like to add: 
                <input type='file' name='pic' accept='image/*'><br>
                <input type='submit' value='Submit' name='added_student'>
                </form>";
    }

//function that takes you back to home page
//literally all this does is take off what the other functions output on the screen
    function home(){
    }

//function that outputs what is currently on the seating chart
    function view_chart(){
        $x = 1;
        $seating_chart = file("seating_chart.csv");
        $array_of_students = array();
        foreach($seating_chart as $seats){
            $student_info = array();
            list($fname, $lname, $seat, $picture) = explode(",", $seats);
            $student_info[] = $fname;
            $student_info[] = $lname;
            $student_info[] = $picture;
            $seat_number = intval($seat);
            $array_of_students[$seat_number] = $student_info;
            reset($student_info);
        }   
        
        
        //magic number 20 is how many people are in the class and available seats
        for($i=0; $i < 15; $i++){
            
            if(($i%5) == 0){
                echo "<br>";
            }
            if(empty($array_of_students[$i])){
                echo "<img src='empty-profile.png' alt='empty profile'>Empty Seat";
                continue;
            }
            echo "<img src='{$array_of_students[$i][2]}' alt='empty profile'>{$array_of_students[$i][0]}{$array_of_students[$i][1]}";
        }
        echo "<br><br><br><br><br><br>";
        
    }

//function that checks if a seat is available
    function check_seat($fname, $lname, $seat_number, $photo_name){
        $seating_chart = file("seating_chart.csv");
        foreach($seating_chart as $student){
            list( , , $seat, ) = explode(",", $student);
            if($seat == $seat_number){
                //left off here, can check if seat is taken, but calls a function and doesn't wait for you to resumbit the infor for new seat
                echo "this seat is already taken, please pick another";
                add_student();
                return;
            }
        }
        if($seat_number > 15){
            //makes sure that seat exists
            echo "This seat does not exist, please pick another";
            add_student();
            return;
        }
        add_to_csv($fname, $lname, $seat_number, $photo_name);
    }

//function that adds information to the csv file
    function add_to_csv($fname, $lname, $seat_number, $photo_name){
        echo "added to csv<br>";
        echo $photo_name;
        $handle = fopen("seating_chart.csv", "a");
        $array = array();
        $array[] = $fname;
        $array[] = $lname;
        $array[] = $seat_number;
        if($photo_name == ''){
            $array[] = 'empty-profile.png';
        } else{
            $file_name = $_FILES['pic']['name'];
            $file_tmp = $_FILES['pic']['tmp_name'];
            //name of directory your want to put it in
            $uploads_dir = '/midterm';
            //current permission don't allow me to upload files into this directory
            move_uploaded_file($file_tmp, $uploads_dir);
            $array[] = $file_name;
        }
        fputcsv($handle, $array);
    }
?>