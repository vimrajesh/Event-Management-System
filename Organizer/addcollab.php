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
      $oid = $_POST['o_id'];
      $eve = $_SESSION['eventid'];
      $sql = mysqli_query($connect,"INSERT IGNORE INTO `event_org_list`(`Event_Id`,`Organizer_Id`)
      VALUES ('$eve', '$oid')") or die("Error1: " . mysqli_error($connect));
      echo 'Collaborator Successfully added'."<br>"; 
    }
    if(isset($_POST['submit2'])){
      $conp = $_POST['conp_'];
      $conn = $_POST['cone_'];
      $eve = $_SESSION['eventid'];
      $sql = mysqli_query($connect,"INSERT IGNORE INTO `event_contact`(`event_id`,`contact_no`,`Name`)
      VALUES ('$eve', '$conp', '$conn')") or die("Error2: " . mysqli_error($connect)); 
      echo 'Contact Successfully added'."<br>";
    }
    if(isset($_POST['submit3'])){
      $org = $_SESSION['id'];
      $eve = $_SESSION['eventid'];
      $sql = mysqli_query($connect,"select COUNT(*) FROM `event_org_list` WHERE `Event_Id` = '$eve'") or 
      die("Error3: " . mysqli_error($connect)); 
      $count = mysqli_fetch_array($sql);
      $count = $count[0];
      // echo $count."<br>";
      if($count > 1 ){
        $sql1 = mysqli_query($connect,"DELETE FROM `event_org_list` WHERE 
        `Organizer_Id` = '$org' and `Event_id` = '$eve'")  or die("Error3: " . mysqli_error($connect)); 
        echo "<center>".'Collaborated Ended Successfully'."</center>"."<br>";
        echo "<center>"."Successfully Deleted Your Collaboration. "."</center>".'<center><br>'."Redirecting to Dashboard.....".'</center>';
        echo "<script>setTimeout(\"location.href = 'org_dashboard.php';\",5000);</script>";
      }
      else{
        echo 'You cannot be removed as a collaborator since you are the only Organizer for the event. To remove the event, use Delete Event'."<br>";
      }
      
    }
    if(isset($_POST['submit4'])){
      $conp = $_POST['delcontact'];
      $eve = $_SESSION['eventid'];
      $sql1 = mysqli_query($connect,"SELECT COUNT(*) FROM `event_contact` WHERE event_id = '$eve'") or die("Error4: ".mysqli_error($connect));
      $count1 = mysqli_fetch_array($sql1);
      $count1= $count1[0];
      if($count1 > 1){
        $sql = mysqli_query($connect,"DELETE FROM `event_contact` WHERE contact_no = '$conp' and event_id = '$eve'") or die("Error2: " . mysqli_error($connect)); 
        echo 'Contact Successfully Deleted'."<br>";
      }
      else
      {
        echo 'You cannot delete this contact as this is the only contact provided as reference.'."<br>";
      }
    }
    
    $connect->close();          
  }
?>

<h2 style = "color:green;"> Collaboration </h2>
<form enctype="multipart/form-data" action="addcollab.php" method="post">
    <tr>
            <td>
                Add Collaborator:
            </td>
            <td>
                <select name ="o_id" required > 
                <option disabled selected value> -- select an option -- </option>
                <?php 
                    $conn=mysqli_connect('localhost','root','','event_management_nitc'); 
                    $result=mysqli_query($conn,'SELECT Organizer_Id,Organizer_Name FROM event_organizer ORDER BY Organizer_Name'); 
                    while($row=mysqli_fetch_assoc($result)) {
                        if($row['Organizer_Id'] != $_SESSION['id']){
                            echo "<option value='$row[Organizer_Id]'>$row[Organizer_Name]</option>"; 
                        }
                        
                    } 
                ?> 
                </select>
            </td>
    </tr> <br><br>
    <input type="submit" name="submit1" value="Submit"/>
</form>
<br>
<h2 style = "color:green;"> Add Contacts </h2>
<form enctype="multipart/form-data" action="addcollab.php" method="post">
    <tr>
        <td>
            Event Contact(Ph. no) : 
            <input type= "text" name = "conp_" placeholder="Phone no." maxlength="15" size="15" required />
        </td>   
    </tr> <br> <br> 
    <tr>
        <td>
            Event Contact(Name) : 
            <input type= "text"  name = "cone_" placeholder="Name" maxlength="64" size="60" required />
        </td>   
    </tr> <br> <br> 
    <input type="submit" name="submit2" value="Submit"/>
    <br>
</form>

<br>
<h2 style = "color:green;"> Delete Your Collaboration </h2>
<form enctype="multipart/form-data" action="addcollab.php" method="post">
    <input type="submit" name="submit3" value="Delete Your Collaboration"/>
</form>

<br>
<h2 style = "color:green;"> Delete Contacts </h2>
<form enctype="multipart/form-data" action="addcollab.php" method="post">
    <tr>
            <td>
                Delete Contact Details:
            </td>
            <td>
                <select name ="delcontact" required > 
                <option disabled selected value> -- select an option -- </option>
                <?php 
                    $eve = $_SESSION['eventid'];
                    $conn=mysqli_connect('localhost','root','','event_management_nitc'); 
                    $result=mysqli_query($conn,"SELECT `contact_no`,`Name` FROM `event_contact`WHERE
                     `event_id` =  '$eve'"); 
                    while($row=mysqli_fetch_assoc($result)) {
                        
                          echo "<option value='$row[contact_no]'>$row[contact_no] - $row[Name]</option>"; 
                        
                        
                    } 
                ?> 
                </select>
            </td>
    </tr> <br><br>
    <input type="submit" name="submit4" value="Delete Contact"/>
</form>
<br>


</div>


</body>
</html>


