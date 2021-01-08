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
  <div style = "padding-left: 50px;">
  <?php
//$usr=$_SESSION["id"];

$connect=mysqli_connect('localhost','root','','event_management_nitc');

  if(mysqli_connect_errno($connect))
  {
      echo 'Failed to connect to database: '.mysqli_connect_error();
  }
  else
  {  
    if(isset($_POST["uid"]))
    {
        $eve=$_SESSION["eventid"];
        $msg = $_POST['msgs'];
        $a1=$_POST["uid"];
        $queryz=mysqli_query($connect,"SELECT fee from events where Event_Id=$eve ") or die("Error: " . mysqli_error($connect));
        $rowz=mysqli_fetch_array($queryz);
        if(!$rowz[0]){
            $query1=mysqli_query($connect,"DELETE from registrants_list where UserId='$a1' AND Event_Id=$eve") or die("Error: " . mysqli_error($connect));
            $sql1 = mysqli_query($connect,"INSERT INTO `messages`(`Event_Id`,`UserId`,`message`) VALUES ('$eve','$a1','$msg')");
            echo "Successfully Deleted the Registrant"."<br>";

            echo 'Message Successfully sent'."<br>"; 
        }
        else
        {
          $query3=mysqli_query($connect,"Select upload from registrants_list where UserID='$a1' and Event_Id=$eve ") or die("Error: " . mysqli_error($connect));
          $upl=mysqli_fetch_array($query3);
          if (!unlink($upl[0])) {  
            echo $upl[0]."cannot be deleted due to an error";  
            }  
        else {  
            //echo $upl[0]. "has been deleted"; 
            $query4=mysqli_query($connect,"DELETE from registrants_list where UserID='$a1' and Event_Id=$eve ") or die("Error: " . mysqli_error($connect)); 
            $sql1 = mysqli_query($connect,"INSERT INTO `messages`(`Event_Id`,`UserId`,`message`) VALUES ('$eve','$a1','$msg')");
            echo "Successfully Deleted the Registrant"."<br>";
            echo 'Message Successfully sent'."<br>";

        } 
    }
}}

    $connect->close();    
?>
  <h2 style = "color:green;"> Deregister this user: </h2>
<form enctype="multipart/form-data" action="delete_registrants.php" method="post">
<tr>
        <td>
            Select  User ID: 
            <select name ="uid" id = "uid" required > 
                    <option disabled selected value> -- select an option -- </option>
                    <?php 
                        $eve = $_SESSION['eventid'];
                        // echo "<option>".$eve."</option>";
                        $conn=mysqli_connect('localhost','root','','event_management_nitc'); 
                        $result=mysqli_query($conn,"SELECT u.UserId ,u.Registered_Name  FROM user as u 
                        JOIN registrants_list as rl
                        ON u.UserId = rl.UserId
                        WHERE rl.Event_Id = $eve") or die ("Error5: " . mysqli_error($connect)); 
                        while($row=mysqli_fetch_assoc($result)) 
                        {
                            echo "<option value='$row[UserId]'>".$row[UserId]." ".$row[Registered_Name]."</option>"; 
                        } 
                        $conn->close();          

                    ?>
                </select> 
        </td>   
    </tr> <br> <br> 
    <tr>
    <td>
        Message to Convey Registrant : <br>
        <textarea type= "text" id = "msgs" name = "msgs" placeholder="Message You Want To Convey as Reason For deletion" maxlength="1028" cols="100" rows="5" ></textarea>
    </td>   
    </tr> <br> <br>
<input type="submit" name="submit2" value="Submit"/>
<br> <br>
</form>
<?php
$connect=mysqli_connect('localhost','root','','event_management_nitc');

if(mysqli_connect_errno($connect))
{
    echo 'Failed to connect to database: '.mysqli_connect_error();
}
else{
     echo "<h3>Details of registered users</h3><br>";
     $eve=$_SESSION["eventid"];
   //   $que=$_POST["uid"];
     $query1=mysqli_query($connect,"SELECT u.UserId,u.Registered_Name,rl.Time_Stamp from user u,registrants_list rl where u.UserId=rl.UserId and rl.Event_Id=$eve") or die("Error: " . mysqli_error($connect));
     echo "<table border='1'> <tr>";
     echo "<th> User Id </th>";
     echo "<th> registered Name </th>";
     echo "<th> Timestamp </th></tr>";
     while($row1=mysqli_fetch_array($query1))
     {
       echo "<tr><td>".$row1[0]."</td>";
       echo "<td>".$row1[1]."</td>";
       echo "<td>".$row1[2]."</td></tr>"; 
     }
     echo "</table>";
}
     $connect->close();    

    
?>
</div>


</body>
</html>


