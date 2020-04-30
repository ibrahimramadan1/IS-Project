<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $DBname ="project";
    $conn = new mysqli($servername, $username, $password,$DBname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql="CREATE TABLE depend(
    task VARCHAR(30),
    dependOn VARCHAR(30)
    )";
    
    if ($conn->query($sql) === TRUE) {
            echo "Table depend created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        } 
    $task=$_POST["tasks"];
    $depend=$_POST["depend"];
    $number=$_POST["number"];
    $counter=0; 
    $counter1=0;
    
    
    foreach($task as $t){
        $n=$number[$counter];
        for ($i=0;$i<$n;$i++){
            $d=$depend[$counter1];
            $sql="INSERT INTO depend(task,dependOn)VALUES(
            '{$t}','{$d}'
            )";
            if ($conn->query($sql) === TRUE) {
            echo "dep added successfully"."<br>";
            }
            $counter1++;
            
        }
        $counter++;
    }
    header ("Location: addWorker.php");
    exit;
    

}


?>