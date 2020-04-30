<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $DBname="project";
        $conn = new mysqli($servername, $username, $password,$DBname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);   
        } 
        $sql="CREATE TABLE plan(
        startDay VARCHAR(30) NOT NULL,
        hours INT(2) NOT NULL
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table plan created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        } 
        $sql="CREATE TABLE Tasks(
        name VARCHAR(30) NOT NULL,
        startDate DATE,
        workingHours INT(2) NOT NULL,
        dueDate DATE,
        isMileStone VARCHAR(3),
        taskID INT AUTO_INCREMENT PRIMARY KEY
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table Tasks created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        }
        $sql="CREATE TABLE subTasks(
        name VARCHAR(30) NOT NULL,
        startDate DATE,
        workingHours INT(2)NOT NULL,
        dueDate DATE,
        taskR INT,
        taskID INT AUTO_INCREMENT  PRIMARY KEY
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table subTasks created successfully"."<br>";
        } 
        else {
            echo "Error creating table: " . $conn->error."<br>";
        }
        $Sday;
        if (isset($_POST["Sday"]))
            $Sday=$_POST["Sday"];
        $hrsPday;
        if (isset($_POST["hrsPday"]))
            $hrsPday=$_POST["hrsPday"];
        
        $sql="INSERT INTO plan (startDay,hours)VALUES(
        '{$Sday}','{$hrsPday}'
        )";
        if ($conn->query($sql) === TRUE) {
            echo "plan added Succefuly"."<br>";
        } 
        else {
            echo "Error Adding plan: " . $conn->error."<br>";
        }
        $Tname;
        $Sdate;
        $Whrs;
        $Ddate;
        $NoST;
        $mileStone;
        if (isset($_POST["Tname"]))
            $Tname=$_POST["Tname"];
        if (isset($_POST["Sdate"]))
            $Sdate=$_POST["Sdate"];
        if (isset($_POST["Ddate"]))
            $Ddate=$_POST["Ddate"];
        if (isset($_POST["mileStone"]))
            $mileStone=$_POST["mileStone"];
        if (isset($_POST["Whrs"]))
            $Whrs=$_POST["Whrs"];
        if (isset($_POST["NoST"]))
            $NoST=$_POST["NoST"];
        $counter=0;
        foreach($Tname as $taskN){
            $taskSD=$Sdate[$counter];
            $taskWH=$Whrs[$counter];
            $taskDD=$Ddate[$counter];
            $taskMS=$mileStone[$counter];
            $counter++;
            echo  $taskN. "     ".$taskSD."     ".$taskWH."   ".$taskDD."<br>";
            
            $sql="INSERT INTO Tasks(name,startDate,workingHours,dueDate,isMileStone) VALUES(
            '{$taskN}','{$taskSD}','{$taskWH}','{$taskDD}','{$taskMS}')";
            if ($conn->query($sql) === TRUE) {
            echo "task added Succefuly"."<br>";
            } 
        else {
            echo "Error Adding task: " . $conn->error."<br>";
            }
        }
        $STname;
        $STsd;
        $SThrs;
        $STdd;
        if (isset($_POST["STname"]))
            $STname=$_POST["STname"];
        if (isset($_POST["STsd"]))
            $STsd=$_POST["STsd"];
        if (isset($_POST["SThrs"]))
            $SThrs=$_POST["SThrs"];
        if (isset($_POST["STdd"]))
            $STdd=$_POST["STdd"];
        $counter=0;
        $counter1=1;
        foreach($NoST as $n){
            echo $n."<br>";
            for($i=0;$i<$n;$i++){
                $taskN=$STname[$counter];
                $taskSD=$STsd[$counter];
                $taskWH=$SThrs[$counter];
                $taskDD=$STdd[$counter];
                $counter++;
                $sql="INSERT INTO subTasks(name,startDate,workingHours,dueDate,
               taskR)VALUES(
                '{$taskN}','{$taskSD}','{$taskWH}','{$taskDD}','{$counter1}'
                )";
                if ($conn->query($sql) === TRUE) {
                    echo "subtask added Succefuly"."<br>";
                } 
                else {
                    echo "Error Adding subtask: " . $conn->error."<br>";
                }
            }
            $counter1++;
        }
        header("Location: dependancy.php");
        exit;
    
    }
    else{
        echo "U can't go here directly";
    }     

?>