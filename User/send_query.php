<?php
session_start()
?>

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
  <a href="loggedinpage.php">Events</a>
  <a href="profile.php">User Profile</a>
  <a href="dashboard.php">Dashboard</a>
  <a href="kyc.php">Know Your Club</a>
  <a href="schedule.php">Schedule</a>
  <a href="filterdate.php">Filter Event By Date</a>
  <a href="view_sent_queries.php">View Unresponded Queries</a>
  <a href="user_notifications.php">View Notifications</a>
  <a href="aboutus.php">About The Team</a>
<?php
if(isset($_SESSION["id"])) {
  ?>

  <div class="topnav-right">
    <a href="#"><?php echo "Welcome, ". $_SESSION["name"]."!"; ?></a>

    <?php
    }
    else{
?>
<a href="../login/login_user.php">You are not logged in</a>
<?php
    }
    ?>
    <a href="../login/logout.php">Logout</a>
    
  </div>
  
  
</div>
<br>


<div style = "padding-left :50px; padding-right:500px">
<h3 style = "color:green;"> Ask Your Query: </h3>
<form enctype="multipart/form-data" action="send_query.php" method="post">
<tr>
    <td>
        <h4>What is the Query : </h4><br>       
        <textarea type= "text" id = "msg" name = "msg" placeholder="Enter your Query Here" maxlength="256" cols="100" rows="5" ></textarea>
    </td>
</tr> <br> <br>
<input type="submit" name="submit" style = "width: 250px;" class="btn btn-primary" value="Submit"/>
<br>
</form>
<?php
if(isset($_POST["msg"]))
{
  $usr=$_SESSION["id"];
  $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        $msg=$_POST["msg"];
        $d1=$_SESSION['eventname'];
        // $que=$_POST["msg"];
        $query1=mysqli_query($connect,"SELECT Event_Id from events where Event_Name='$d1'") or die("Error1: " . mysqli_error($connect));
        $row1=mysqli_fetch_array($query1);
        $eve=$row1[0];
        $a1=$_SESSION["id"];
        $query2=mysqli_query($connect,"INSERT INTO `queries` (`UserId`,`Event_Id`,`Query` ) VALUES ('$usr',$eve,'$msg')") or die("Error2: " . mysqli_error($connect));
        echo "Query Successfully Sent to the Organizer."."<br>";
      }    
  $connect->close();    
}
?>
</div>
  
</body>

</html>