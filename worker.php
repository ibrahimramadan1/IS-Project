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

    $sql="CREATE TABLE taskWorkers(
    task VARCHAR(30),
    worker VARCHAR(30)
    )";
    
    if ($conn->query($sql) === TRUE) {
            echo "Table depend created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        } 
    $task=$_POST["tasks"];
    $worker=$_POST["worker"];
    $number=$_POST["number"];

    $counter=0; 
    $counter1=0;
    foreach($task as $t){
        $n=$number[$counter];
        for ($i=0;$i<$n;$i++){
            $w=$worker[$counter1];
            $sql="INSERT INTO taskWorkers(task,worker)VALUES(
            '{$t}','{$w}'
            )";
            if ($conn->query($sql) === TRUE) {
            echo "worker added successfully"."<br>";
            } 
            $counter1++;
        }
        $counter++;
        
    }
    
    header ("Location: actualHrs.php");
    exit;

}


?>