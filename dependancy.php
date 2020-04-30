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
     <form class='container' method='post' action='depend.php'>
            <h1>Dependancy Tasks</h1>
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
    $result;
    $result=$conn->query($sql);
    $counter=0;
    if ($result->num_rows > 0){
        while (($row = $result->fetch_assoc())){
            if ($counter==0){
                $counter++;
                continue;
            }
            $r=$conn->query($sql);
            echo "<br>";
            echo "<div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                        <span class='input-group-text' id='basic-addon1'>Task</span>
                        </div>
                        <input name='tasks[]' type='text' class='form-control' 
                        placeholder={$row["name"]} value={$row["name"]}>
                    </div>";
            echo "<div class='input-group-prepend'>
                        <span class='input-group-text' id='basic-addon1'>Depend on</span>
                        </div>";
            echo'<div>
            <input name="number[]"  value="0" type="number" class="counter">
            <select name="depend[]" class="mdb-select" multiple>';
            while (($rw = $r->fetch_assoc())){
                echo"<option value={$rw["name"]} selected>{$rw["name"]}</option>";
                }
                
                
            echo '</select>';  
            echo '</div>';
        $counter++;
        
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
