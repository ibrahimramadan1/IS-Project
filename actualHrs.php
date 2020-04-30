<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Dependancy</title>
    <style>
        .container{ 
            padding: 50px;
        }
    </style>
</head>
<body>
     <form class='container' method='post' action='Actual.php'>
            <h1>Actual Hours</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $DBname ="project";
    $conn = new mysqli($servername, $username, $password,$DBname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql="SELECT name FROM Tasks";
    $result=$conn->query($sql);
    if ($result->num_rows > 0){
        while (($row = $result->fetch_assoc())){
            echo "<br>";
            echo "<div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                        <span class='input-group-text' id='basic-addon1'>Task</span>
                        </div>
                        <input name='tasks[]' type='text' class='form-control' 
                        placeholder={$row["name"]} value={$row["name"]}>
                    </div>";
            echo "<div class='input-group-prepend'>
                        <span class='input-group-text' id='basic-addon1'>Start Date</span>
                        </div>";
            echo'<div>
            <input name="startDate[]" type="Date" class="counter" placeholder="start date">';
            echo '</div>';  
            
            
            echo "<div class='input-group-prepend'>
                        <span class='input-group-text' id='basic-addon1'>Actual days</span>
                        </div>";
            echo'<div>
            <input name="actual[]" type="number" class="counter" placeholder="Actual days">';
            echo '</div>';
            
            
             echo "<div class='input-group-prepend'>
                        <span class='input-group-text' id='basic-addon1'>Due Date</span>
                        </div>";
            echo'<div>
            <input name="dueDate[]" type="Date" class="counter" placeholder="Due date">';
            echo '</div>';  
    }
    }
    
       echo '<input type="submit" class="w-100 btn btn-success" value="Submit">
        </form>';
?>
    <script src="jquery.js"></script>
    <script src="materialize.min.js"></script>
    <script>
        $(document).ready(function(){
        $('select').formSelect();
        })
    </script>

</body>
</html> 