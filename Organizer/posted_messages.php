<?php 
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
<style>
  <?php include "styles.css" ?>
  /* <img src="hdx.jpg" width="200" height="200" class="ribbon"> */
  /* background-image: url('hdx.jpg'),url('hdx.jpg');
  background-repeat: repeat,repeat;
  background-attachment: scroll,scroll;
  background-position: right top,left top;
  background-blend-mode: lighten,lighten;
  background-size: 500px,500px ; */
</style>
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

.active, .collapssible:hover {
  background-color: #111;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
  .not {
    
    width: 1000px;
    margin: 0 auto;
    /* background-color:black;*/
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
<h2 style = "color:green;"><center> Messages For the Event </center></h2>

<?php 
    
    if(isset($_SESSION["eventid"])){
        $connect=mysqli_connect('localhost','root','','event_management_nitc');
        if(mysqli_connect_errno($connect))
        {
            echo 'Failed to connect to database: '.mysqli_connect_error();
        }
        else{
            $eve = $_SESSION["eventid"]; 
            $sql = mysqli_query($connect,"SELECT u.UserId, u.Registered_Name, m.Timestamp, m.message, e.Event_Name FROM events as e JOIN messages as m JOIN user as u
            ON e.Event_Id = m.Event_ID AND u.UserId = m.UserId WHERE e.Event_Id= '$eve'  ORDER BY m.Timestamp DESC LIMIT 10")  or die("Error2: " . mysqli_error($connect));;


            ?>

            <div class="not">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Timestamp</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Registered Name</th>
                    <th scope="col">Message</th>
                </tr>
                </thead>
                <tbody>
            <?php
            while($row = mysqli_fetch_array($sql))
            {
                echo "<tr>";
                echo "<th scope='row'>".$row[2]."</th>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[3]."</td>";
                echo "</tr>";
            }
        }
    }
?>

<!-- <div class="not">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Event Name</th>
      
      <th scope="col">Message</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>adkgkjs asgkjgaslgj  asfja f</td>
      
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
     
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      
      <td>@twitter</td>
    </tr> -->
  </tbody>
</table>
</div>

</body>

</html>