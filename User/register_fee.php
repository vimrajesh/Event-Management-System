<?php
session_start();
if(isset($_POST["upload"]))
{
  $connect=mysqli_connect('localhost','root','','event_management_nitc');
  if(mysqli_connect_errno($connect))
  {
      echo 'Failed to connect to database: '.mysqli_connect_error();
  }
  else
  {   
      $d1=$_SESSION["eventname"];
      $query1=mysqli_query($connect,"SELECT Event_Id from events where Event_Name='$d1'") or die("Error: " . mysqli_error($connect));
      $row1=mysqli_fetch_array($query1);
          //echo "HELLO";
  // echo $row1[0];
    $a1=$_SESSION["id"];
    
    $output_dir = "../Documents/".$row1[0]."/";
    // echo $output_dir;
    $filename = $_FILES['file']['name']; 
    $tempname = $_FILES['file']['tmp_name'];

    $filename = str_replace(' ', '_', $filename);
    $tempname = str_replace(' ', '_', $tempname);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    // echo $ext;
    if(isset($filename) && !empty($filename)){
      if (!file_exists($output_dir))
      {
          @mkdir($output_dir, 0777);
          //echo "Hello";
      }   
      
      if($filename == ""){
          $folder ="NULL";
          $folder1 = "NULL";
      }
      else{
          $folder  = "../Documents/".$row1[0]."/".$a1."_receipt.".$ext;
          $folder1 = "../Documents/".$row1[0]."/".$a1."_receipt.".$ext; 

      }

      

      if (move_uploaded_file($tempname, $folder))  { 
          $msg = "File uploaded successfully"; 
          $query2=mysqli_query($connect,"INSERT into registrants_list (UserID,Event_Id) values('$a1',$row1[0])") or die("Error: " . mysqli_error($connect));
          $sql = "UPDATE `registrants_list` SET `upload` = '$folder1' WHERE `UserId` = '$a1' AND `Event_Id` = $row1[0]"; 
          $qzzz = mysqli_query($connect, $sql); 
          echo "<h3><center>".$msg."</center></h3>".'<center><h3>'."Redirecting to Events Page.....".'</center></h3>';
          echo "<script>setTimeout(\"location.href = 'register.php';\",1500);</script>";
      }
      else{ 
          $msg = "Failed to upload documents/ receipt"."<br>"; 
          echo $msg;
          echo "<script>setTimeout(\"location.href = 'register_fee.php';\",1500);</script>";
      }
  }
  $connect->close();    
  }
}
?>
<!DOCTYPE html>
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
    bottom: 300px;
     left:350px; 
 }
#bt1{
  position:relative;
  left:380px;
  bottom:70px;
  
}
#bt2{
  position:relative;
  left:520px;
  bottom:108px;
  
}
#responsive-image {  width: 100px;  height: 100px; } 
#responsive-image1 {  width: 120px;  height: 120px; } 
#bt3{
  position:relative;
  left:380px;
  bottom:70px;
  
} 
q
.par{
  position:absolute;

}
.tet{
  position:relative;
  left:120px;
  bottom:160px;
}

.top1{
  position:absolute;
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

<div style = "padding-left: 50px;">

<?php
echo "<h3 style = 'color: green;'> Upload your Fee Payment Receipt (Max 2048 KB)</h3>";
    ?>
    <form enctype="multipart/form-data" action="register_fee.php" method="post">
    <input type="file" name="file" id="file" required/> <br> <br>
    <input type="submit" name="upload" id="upload" class="btn btn-warning" value=Upload />
    </form>
</div>
</body>
</html>