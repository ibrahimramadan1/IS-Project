<?php 
  $servername = "localhost";
    $username = "root";
    $password = "";
    $DBname ="project";
  // Create connection
  $conn = new mysqli($servername, $username, $password,$DBname);
  $result = $conn -> query("SELECT starDate FROM actual ORDER BY starDate ASC");
  $minStart = $result -> fetch_assoc();
  $result = $conn-> query("SELECT dueDate FROM actual ORDER BY dueDate DESC");
  $maxEnd = $result -> fetch_assoc();
  $minStart = strtotime($minStart['starDate']);
  $maxEnd = strtotime($maxEnd['dueDate']);
  $datediff = $maxEnd - $minStart;
  $era = round($datediff / (60 * 60 * 24));
  $result = $conn-> query("SELECT * FROM actual");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel = "stylesheet" href="style.css">
</head>
<body>
    <div class="chart-wrapper">
        <ul class="chart-values">
          <?php for ($i=0; $i < $era+1; $i++){
            echo"<li>day_$i</li>";
          }?>
        </ul>
        <ul class="chart-bars">
          <?php while($row = $result->fetch_assoc()):?>
          <li data-duration=<?php
                $start = strtotime($row['starDate']);
                $end = strtotime($row['dueDate']);
                $datediffs = $start - $minStart;
                $datediff2 = $end - $minStart;
                $diff = round($datediffs / (60 * 60 * 24));
                $diff2 = round($datediff2 / (60 * 60 * 24));
                echo "day_$diff-day_$diff2"; 
              ?> data-color="#b03532"><?php echo $row['name']."    ";?>
              <?php if ($row['doneOnTime']==1){
                    echo "didn't exceeded";
                    }
                    else{
                        echo "exceeded";
                    }
              ?>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>

      <script src="custom.js"></script>
</body>
</html>