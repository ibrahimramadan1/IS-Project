<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $DBname="project";
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "CREATE DATABASE IF NOT EXISTS ".$DBname;
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully"."<br>";
        } 
        else {
            echo "Error creating database: " . $conn->error."<br>";
        }
        $conn->close();
        $conn = new mysqli($servername, $username, $password,$DBname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql="CREATE TABLE IF NOT EXISTS description(
        name VARCHAR(30) NOT NULL,
        cost INT NOT NULL,
        Sdate DATE,
        Ddate DATE
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table describtion created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        }
        $Pname="";
        if (isset($_POST["Pname"]))
            $pname=$_POST["Pname"];
        $cost="";
        if (isset($_POST["cost"]))
            $cost=$_POST["cost"];
        $Sdate;
        if (isset($_POST["Sdate"]))
            $Sdate=$_POST["Sdate"];
        $Ddate;
        if (isset($_POST["Ddate"]))
            $Ddate=$_POST["Ddate"];
        $sql="INSERT INTO description (name,cost,Sdate,Ddate)VALUES(
        '{$Pname}','{$cost}','{$Sdate}','{$Ddate}'
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Describtion added successfully"."<br>";
        } 
        else {
            echo "Error adding decribtion: " . $conn->error."<br>";
        }
        $sql="CREATE TABLE IF NOT EXISTS workers(
        name VARCHAR(30) NOT NULL,
        title VARCHAR(30) NOT NULL,
        hours INT(2) UNSIGNED NOT NULL
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table workers created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        }
        $sql="CREATE TABLE IF NOT EXISTS deliverables(
        name VARCHAR(30) NOT NULL)";
        if ($conn->query($sql) === TRUE) {
            echo "Table deliverable created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        }
        $deliverable;
        if (isset($_POST["deliv"])){
            $deliverable=$_POST["deliv"];
        }
        
        foreach($deliverable as $del){
            $sql="INSERT INTO deliverables (name) VALUES ('{$del}')";
            if ($conn->query($sql) === TRUE) {
                echo "deliv added successfully"."<br>";
            } 
            else {
                echo "Error adding deliv: " . $conn->error."<br>";
            }
        }
        $counter=0;
        $Wname;
        $Wtitle;
        $Whrs;
        
        if (isset($_POST["Wname"])){
            $Wname=$_POST["Wname"];
        }
        if (isset($_POST["Wtitle"])){
            $Wtitle=$_POST["Wtitle"];
        }
        if (isset($_POST["Whrs"])){
            $Whrs=$_POST["Whrs"];
        }
        foreach ($Wname as $workerN){
            $workerT=$Wtitle[$counter];
            $workerH=$Whrs[$counter];
            $sql="INSERT INTO workers (name,title,hours)VALUES(
            '{$workerN}','$workerT','{$workerH}'
            )";
            $counter++;
            if ($conn->query($sql) === TRUE) {
                echo "worker added successfully"."<br>";
            } 
            else {
                echo "Error adding worker: " . $conn->error."<br>";
            }
        }
        
        header("Location: planconfig.html");
        exit;
        
    }
    else{
        echo "U can't go here directly";
    }             
?>