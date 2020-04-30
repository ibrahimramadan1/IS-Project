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
    $sql="CREATE TABLE Actual(
    name VARCHAR(30),
    starDate DATE,
    days INT(3),
    dueDate DATE,
    doneOnTime INT(1)
    )";
    if ($conn->query($sql) === TRUE) {
            echo "Table actual created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        } 
    $tasks=$_POST["tasks"];
    $startDate=$_POST["startDate"];
    $actual=$_POST["actual"];
    $dueDate=$_POST["dueDate"];
    $counter=0;
    foreach ($tasks as $t){
        $sql="SELECT dueDate FROM Tasks WHERE name='{$t}'";
        $result=$conn->query($sql);
        $row = $result->fetch_assoc();
        $a=$actual[$counter];
        $s=$startDate[$counter];
        $d=$dueDate[$counter];
        $O;
        if ($row["dueDate"]==$d)
            $O=1;
        else
            $O=0;
        $sql="INSERT INTO Actual(name,starDate,days,dueDate,doneOnTime)VALUES(
        '{$t}','{$s}','{$a}','{$d}','{$O}'
        ) ";
        if ($conn->query($sql) === TRUE) {
            echo "task successfully"."<br>";
        } 
        $counter++;
    }
    
    header("Location: DrawExpected.php");
    exit;
    
    

}


?>