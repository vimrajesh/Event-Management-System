<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        body{
            background-color: whitesmoke;
            text-align: center;
        }
        .tabl{
            margin: auto;
        }
        

    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<script src =  "js/jquery.js"></script>
     <script src = "js/bootstrap.min.js"></script>
    <h1><center>Events</center></h1>
    
  
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date, L.Location_Name, S.Status 
        from events as e 
        join event_location as L
        join event_status as S where e.Location_Id=L.Location_Id and e.Status_Id=S.Status_Id and e.Event_Date >=CURDATE() 
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));
        $count=0;
        echo '<p style="text-align:left">';
        while($row1=mysqli_fetch_array($query1))
        {
  ?>
          <a class="btn btn-warning btn-lg btn-block" data-toggle="collapse" text-align: left href="#collapseExample_<?php echo $count; ?>"  role="button" aria-expanded="false" aria-controls="collapseExample">
        <?php
          echo $row1[0];
          echo "</a>";
  ?>  
        
          <div class="collapse" id="collapseExample_<?php echo $count; ?>" >
          <?php
          echo '<div class="card card-body">';
          echo "Event date : " . $row1[1] . "<br>Event Location : ". $row1[2] . "<br>Event Status : ".$row1[3];
          echo "</div>";
          echo "</div> <br>";
          $count=$count+1;
          // echo "<a class="btn btn-light " data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">";
          // echo $row1[0];
          // echo "</a>";             
        }
        echo '</p>';
    }
    $connect->close();
?>

</body>
</html>