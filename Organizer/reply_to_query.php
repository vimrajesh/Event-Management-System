<?php 
session_start();
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
<?php
    if(isset($_SESSION["queryid"])){
        $connect=mysqli_connect('localhost','root','','event_management_nitc');
        if(mysqli_connect_errno($connect))
        {
            echo 'Failed to connect to database: '.mysqli_connect_error();
        }
        else{
            $rep = $_SESSION["queryid"]; 
            $sql = mysqli_query($connect,"SELECT u.UserId, u.Registered_Name, q.Timestamp, q.Query, e.Event_Name, q.Query_Id FROM events as e JOIN queries as q JOIN user as u
            ON e.Event_Id = q.Event_Id AND u.UserId = q.UserId WHERE q.Query_Id= $rep ")  or die("Error2: " . mysqli_error($connect));
            
            // <!-- <input hidden type="text" class="btn btn-primary" style= "" value="Reply"/> -->
            
            $rowx = mysqli_fetch_array($sql);
        }
        $connect->close();
    }
    else{
        echo "<h3><center>"."Please Try Again".'</center></h3>';
        echo "<script>setTimeout(\"location.href = 'reply_queries.php';\",1500);</script>";    
    }
?>
<div style = "padding-left :50px; padding-right:500px">

<h2 style = "color:green;"><center> Reply to this Query </center></h2>
 <form method="post" action="reply_to_query.php">
    <tr>
        <td>
            Query Received : <br>
            <textarea type= "text" id = "name_" name = "name_" placeholder="<?php echo $rowx[3]; ?>"  maxlength="256" cols="100" rows="5"  disabled required></textarea>   
            <!-- <textarea type= "text" id = "desc_" name = "desc_" placeholder="Describe your event" maxlength="4096" cols="100" rows="5" required></textarea> -->

        </td>   
    </tr> <br> <br>   
    <tr>
        <td>
            Reply Query :  <br>
            <textarea type= "text" id = "reply_" name = "reply_" placeholder="Reply" maxlength="1024" cols="100" rows="5" required></textarea>
        </td>   
    </tr> <br> <br>  
    <input type="submit" style = "width: 250px;" class="btn btn-primary" value="Submit"/>
    <input type="reset" style = "width: 250px;" class="btn btn-primary" value="Reset"/>
 </form>   
<?php
    if(isset($_POST["reply_"])){
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else{
        $rep = $_SESSION["queryid"];
        $eve = $_SESSION["eventid"];
        $reply=$_POST["reply_"]; 
        $sql = mysqli_query($connect,"SELECT u.UserId, u.Registered_Name, q.Timestamp, q.Query, e.Event_Name, q.Query_Id, q.Event_Id FROM events as e JOIN queries as q JOIN user as u
        ON e.Event_Id = q.Event_Id AND u.UserId = q.UserId WHERE q.Query_Id= $rep ")  or die("Error2: " . mysqli_error($connect));
        $rowx = mysqli_fetch_array($sql);
        
        $reply = "Dear ".$rowx[1].", the answer to your Query \'".$rowx[3]."\' is: ".$reply;
        $sqlx = mysqli_query($connect, "INSERT INTO `messages`(`Event_Id`,`UserId`,`message`) VALUES ($eve,'$rowx[0]','$reply')") or die("Error2: " . mysqli_error($connect));
        //echo "Successfully Replied to the Query";
        $sqlz = mysqli_query($connect, "DELETE FROM queries WHERE Query_Id= $rep ") or die("Error2: " . mysqli_error($connect));
        echo "<h3><center>"."Successfully Replied to the Query".'</center></h3>';
        echo "<script>setTimeout(\"location.href = 'reply_queries.php';\",1500);</script>";
        }
    $connect->close();
    }
?>
</div>

</body>

</html>