window.onload = function() {
    var req = new XMLHttpRequest();

    req.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var students = req.responseText;
            students = students.split(', ');
            students.pop();
            for(var  i=0; i<students.length; i++){
                var option = document.createElement('OPTION');
                option.appendChild(document.createTextNode(students[i]));
                document.getElementById("student_names").appendChild(option);
            }
        }
    }

    req.open("GET", "gradebook.php?queries=first", true);
    req.send();
    document.getElementById("button").onclick = get_grades;
}

//function to get the grades of the student requested
    function get_grades(){
        var req = new XMLHttpRequest();

        req.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("grades").innerHTML = req.responseText;
            }
        }
        var student = document.getElementById("student_names").value;
        req.open("GET", "gradebook.php?queries=" + student, true);
        req.send();
    }