<?php

//function to import the information in the csv file into js
    function import_csv($filename){
        $questions = file($filename);
        $data = array();
        $temp = array();
        foreach($questions as $individual_question){
            list($puzzle, $category, , ) = explode(",", $individual_question);
            $temp[0] = $puzzle;
            $temp[1] = $category;
            $data[] = $temp;
        }
        return $data;
    }

//import puzzle questions and shift over the array so as to not have an awkward extra line with identifier
$data = import_csv("puzzles.csv");
array_shift($data);
    

echo "var puzzles = [\n";
for($i = 0; $i < count($data); $i++){
    echo " [";
    echo "" . $data[$i][0] . ", " . $data[$i][1] . "";
    if($i == (count($data) - 1)){
        echo "]\n";
    } else {
        echo "], \n";
    }
}
echo "];\n";

