<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<style>

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav-right {
  float: right;
}
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
#responsive-image {  width: 100px;  height: 100px; } 
#responsive-image1 {  width: 120px;  height: 120px; } 
.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  /overflow: hidden;/
  background-color: #f1f1f1;
}
.text{
    position:absolute;
    bottom: 260px;
     left:350px; 
}
#bt1{
  position:relative;
  left:45px;
  top:170px;
  
}
#bt2{
  position:relative;
  left:50px;
  top:170px;
  
}
.par{
  position:absolute;

}
.tet{
  position:relative;
  left:120px;
  bottom:160px;
}
</style>

</head>


<body>
<script src =  "js/jquery.js"></script>
     <script src = "js/bootstrap.min.js"></script>


     <div class="topnahv">
    <h3 style="color:green; font-size:2rem; font-family: Verdana,sans-serif;" >Event Management System, NITC</h3>
    
  
    
    
</div>



<div class="topnav">
  <a  href="org_dashboard.php">Dashboard</a>
  <a href="profile.php">Organizer Profile</a>
  <a href="eventregister.php">Add New Event</a>
  <a href="kyc.php">Know Your Club</a>
  <a href="schedule.php">Schedule</a>
  <a href="filterdate.php">Filter Events by Date</a>
  <a  href="aboutus.php">About The Team</a>
<?php
if(isset($_SESSION["id"])) {
  ?>

  <div class="topnav-right">
    <a href="#"><?php echo "Welcome, ". $_SESSION["name"]."!"; ?></a>

    <?php
    }
    else{
?>
<a href="../login/login_organizer.php">You are not logged in</a>
<?php
    }
    ?>
    <a href="../login/logout.php">Logout</a>
    
  </div>
  
  
</div>
<br>


<body>

<?php
    
    
        $connect=mysqli_connect('localhost','root','','event_management_nitc');
        $insert=false;
        //check connection
        if(mysqli_connect_errno($connect))
        {
            echo 'Failed to connect to database: '.mysqli_connect_error();
        }
        else{
        //echo 'Connected Successfully!!';
            $eve=$_SESSION["eventid"];
            $qx = mysqli_query($connect,"select e.Event_Name,e.Event_Date from events as e where e.Event_Id = '$eve'")
            or die("Error: " . mysqli_error($connect));;
            $rx= mysqli_fetch_array($qx);
            $query1=mysqli_query($connect,"select u.UserId, u.Registered_Name, r.Review_Title, r.Review_Description, r.Timestamp, u.Picture
            from user as u 
            join review as r
            on r.UserId = u.UserId
            where r.event_id = '$eve'") or die("Error: " . mysqli_error($connect));
            
            echo "<table border='2'>
            <tr>
            </tr>"."<h4>".$rx[0].", ".$rx[1]."</h4>"."<tr>
            </tr>";
            echo "</table>";
            // Execute the query
            echo '<p style="text-align:left">';
            while($row1=mysqli_fetch_array($query1))
            {
              ?>
              <div class="card mb-3" style="max-width: 1500px;">
                 <div class="row g-0">
                     <div class="col-md-1">
                     <img src="../<?php echo $row1[5]; ?>" id="responsive-image1" alt="../Profiles/default.jpeg">
     
                     </div>
                     <div class="col-md-9">
                     <div class="card-body">
                     
                     <h5 class="card-text"><?php echo $row1[2]; ?></h5>
                     <p class="card-text"><?php echo $row1[3]; ?></p>
                     <!-- <p class = "card-title">Posted by </p> -->
                     <p class="card-text"><small class="text-muted"><?php echo 'Posted By '.$row1[1].' at '.$row1[4]; ?></small></p>
                     </div>
                   </div>
                 </div>
               </div>
                 <?php            

            }
            echo '</p>';
            $connect->close();
        }
    
?>
</body>
</html>

