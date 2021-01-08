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
  $connect=mysqli_connect('localhost','root','','event_management_nitc');
  if(mysqli_connect_errno($connect))
  {
      echo 'Failed to connect to database: '.mysqli_connect_error();
  }
  else{
    if(isset($_POST['submit1'])){
      $eve_stat = $_POST['status_id'];
      $eve = $_SESSION['eventid'];

      
      $sql0 = mysqli_query($connect,"SELECT Event_name FROM `events` WHERE Event_Id = $eve");
      $eve_name = mysqli_fetch_array($sql0);
      $eve_name = $eve_name[0];
      
      $sql = mysqli_query($connect,"UPDATE `events` SET `Status_Id` = $eve_stat WHERE `Event_Id` = $eve") or die("Error1: " . mysqli_error($connect));
      $sql2 = mysqli_query($connect,"SELECT `Status` FROM `event_status` WHERE Status_Id = $eve_stat");

      $eve_stat_i = mysqli_fetch_array($sql2);
      $eve_stat_i = $eve_stat_i[0];
      
      $sqlx = mysqli_query($connect,"SELECT rl.UserId,u.Registered_Name from registrants_list as rl
      JOIN user as u
      ON u.UserId = rl.UserId
      where rl.Event_Id = $eve");
      while($rowx = mysqli_fetch_array($sqlx)){
        
        $z = 'Dear '.$rowx[1].', the status of Event '.$eve_name.' has changed to '.$eve_stat_i;
        $sql1 = mysqli_query($connect,"INSERT INTO `messages`(`Event_Id`,`UserId`,`message`) VALUES ('$eve','$rowx[0]','$z')");
      }
      echo 'Message Successfully sent'."<br>"; 
    }

    if(isset($_POST['submit2'])){
      $eve = $_SESSION['eventid'];

      $msg = $_POST['msg'];
      $sqlx = mysqli_query($connect,"SELECT rl.UserId,u.Registered_Name from registrants_list as rl
      JOIN user as u
      ON u.UserId = rl.UserId
      where rl.Event_Id = $eve");
      while($rowx = mysqli_fetch_array($sqlx)){
        $sql1 = mysqli_query($connect,"INSERT INTO `messages`(`Event_Id`,`UserId`,`message`) VALUES ('$eve','$rowx[0]','$msg')");
      }
      echo 'Message Successfully sent'."<br>"; 

    }
    if(isset($_POST['submit3'])){
      $eve = $_SESSION['eventid'];
      $uid = $_POST['uid'];
      $msg = $_POST['msgs'];

      $sql1 = mysqli_query($connect,"INSERT INTO `messages`(`Event_Id`,`UserId`,`message`) VALUES ('$eve','$uid','$msg')");
    
      echo 'Message Successfully sent'."<br>"; 

    }
    
    $connect->close();          
  }
?>

<h2 style = "color:green;"> Change Status </h2>

<form enctype="multipart/form-data" action="send_messages.php" method="post">
    <tr>
        <td>
        <?php
        $connect=mysqli_connect('localhost','root','','event_management_nitc');
        if(mysqli_connect_errno($connect))
        {
            echo 'Failed to connect to database: '.mysqli_connect_error();
        }
        else{
            $eve = $_SESSION['eventid'];
            $sql = mysqli_query($connect,"SELECT es.Status_Id, es.Status  FROM event_status as es
            JOIN events as e
            ON e.Status_id = es.Status_Id WHERE e.event_id = '$eve'") or die("Error2: " . mysqli_error($connect));
            $row1 = mysqli_fetch_array($sql);    
        }
        $connect->close();          

      ?>
            Old Event Status : 
            <input disabled type= "text" name = "oes" placeholder="<?php echo $row1[1]?>" value="<?php echo $row1[1]?>"  maxlength="15" size="15" required />
        </td>   
    </tr> <br> <br> 
    <tr>
        <td>
            New Event Status : 
            <select name ="status_id" id = "status_id" required > 
                    <option disabled selected value> -- select an option -- </option>
                    <?php 
                        $conn=mysqli_connect('localhost','root','','event_management_nitc'); 
                        $result=mysqli_query($conn,'SELECT `Status_Id`,`Status` FROM event_status ORDER BY Status'); 
                        while($row=mysqli_fetch_assoc($result)) {
                            if($row['Status'] == $row1[1]){
                                continue;
                            }
                            echo "<option value='$row[Status_Id]'>$row[Status]</option>"; 
                        }
                        $conn->close();          
 
                    ?>
                </select> 
        </td>   
    </tr> <br> <br> 
    <input type="submit" name="submit1" value="Submit"/>
    <br>
</form>

<br>
<h2 style = "color:green;"> Select a Specific Message to All Registrants: </h2>
<form enctype="multipart/form-data" action="send_messages.php" method="post">
<tr>
    <td>
        Message to Notify all Registrants : <br>
        <textarea type= "text" id = "msg" name = "msg" placeholder="Message You Want To Send" maxlength="1024" cols="100" rows="5" ></textarea>
    </td>   
</tr> <br> <br>
<input type="submit" name="submit2" value="Submit"/>
<br>
</form>
<br>

<h2 style = "color:green;"> Send a Specific Message to Specific Participant: </h2>
<form enctype="multipart/form-data" action="send_messages.php" method="post">
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
        Message to the Specific Participant : <br>
        <textarea type= "text" id = "msgs" name = "msgs" placeholder="Message You Want To Send" maxlength="1028" cols="100" rows="5" ></textarea>
    </td>   
</tr> <br> <br>
<input type="submit" name="submit3" value="Submit"/>
<br>
</form>
<br>
</div>

</body>
</html>


