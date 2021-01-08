<?php
  session_start();
  if(isset($_POST['event_name']))
{
  if($_SESSION["id"])
  {
  $_SESSION["eventid"]=$_POST['event_name'];
  header("Location:eventedit.php");
  }

}

?>
<?php
if(isset($_POST['ert']))
{
  if($_SESSION["id"])
  {
  $_SESSION["eventid"]=$_POST['ert'];
  $eve=$_SESSION["eventid"];
  $connect = mysqli_connect("localhost", "root", "", "event_management_nitc");  
        header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv;');
      ob_end_clean();
      ob_start();
      ob_end_clean();
      $output = fopen("php://output", "w");  
      ob_start();
      fputcsv($output, array('Registered Name', 'Roll No', 'Contact No', 'MailId')); 
      ob_end_flush(); 
      $query = "SELECT u.Registered_Name,u.UserId,u.Contact_No,u.Mail_Id from user u,registrants_list rl, where u.UserId=rl.UserId and rl.Event_Id=$eve";  
      $result = mysqli_query($connect, $query);
      ob_start();  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, array_map( 'strip_tags', $row )); 
      } 
      ob_end_flush();
      fclose($output);
      ob_start();
      ob_end_clean();
      ob_start(); 
       
  }
}
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

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  /overflow: hidden;/
  background-color: #f1f1f1;
}
  #content {
    width: 400px;
    margin: 0 auto;
    
}

</style>
</head>
</head>
<body>
<script src =  "js/jquery.js"></script>
     <script src = "js/bootstrap.min.js"></script>



<div class="topnahv">
    <h3 style="color:green; font-size:2rem; font-family: Verdana,sans-serif;" >Event Management System, NITC</h3>
    
  
    
    
</div>



<div class="topnav">
  <a class="active" href="http://localhost/DBMS/Organizer/org_dashboard.php">Dashboard</a>
  <a href="http://localhost/DBMS/Organizer/profile.php">Organizer Profile</a>
  <a href="http://localhost/DBMS/Organizer/eventregister.php">Add New Event</a>

  <a href="http://localhost/DBMS/Organizer/kyc.php">Know Your Club</a>
  <a href="http://localhost/DBMS/Organizer/schedule.php">Schedule</a>
  <a  href="http://localhost/DBMS/Organizer/aboutus.php">About The Team</a>
<?php
if(isset($_SESSION["id"])) {
  ?>

  <div class="topnav-right">
    <a href="#"><?php echo "Welcome, ". $_SESSION["name"]."!"; ?></a>

    <?php
    }
    else{
?>
<a href="http://localhost/DBMS/login/login_user.php">You are not logged in</a>
<?php
    }
    ?>
    <a href="http://localhost/DBMS/login/logout.php">Logout</a>
    
  </div>
  
  
</div>
<br>

<h2 style="color:black;">List of Events Hosted By Your Club:</h2>
<br>
<button type="button" class="collapsible">All Active Events</button>
<div class="card mb-3" style="width:400px"  id = "content">
  <?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $idx = $_SESSION["id"];
        // echo $idx;
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date,e.Picture, L.Location_Name, S.Status, e.Event_Id
        from events as e 
        join event_location as L
        
        join event_status as S 
        join event_organizer as eo
        join event_org_list as eol
        join organizer_type as o
        on e.Location_Id=L.Location_Id 
        and e.Status_Id=S.Status_Id
        and e.Event_Id = eol.Event_Id 
        
        and eol.Organizer_id = eo.Organizer_Id
        and eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where e.Event_Date >= CURDATE() 
        AND eol.Organizer_id = $idx
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));
        // Change Roll No. to Session Authentication Details
        while($row1=mysqli_fetch_array($query1))
        {
          ?>
          <img class="card-img-top" src="<?php echo "../".$row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="event_name" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Edit Event"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="ert" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Download Registrants list"/>
            </form>
          <?php
          echo '</div>';
        }
      }
    $connect->close();
?>
</div>


<br><br>
<button type="button" class="collapsible" >All Inactive Events</button>
<div class="card mb-3" style="width:400px"  id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    { 
        $idx = $_SESSION["id"];
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date,e.Picture, L.Location_Name, S.Status, e.Event_Id 
        from events as e 
        join event_location as L
        join registrants_list as R
        join event_status as S 
        join event_organizer as eo
        join event_org_list as eol
        join organizer_type as o
        on e.Location_Id=L.Location_Id 
        and e.Status_Id=S.Status_Id
        and e.Event_Id = eol.Event_Id 
        and R.Event_Id = e.Event_Id
        and eol.Organizer_id = eo.Organizer_Id
        and eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where e.Event_Date < CURDATE() 
        AND eol.Organizer_id = '$idx'
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));
        // Change Roll No. to Session Authentication Details
        while($row1=mysqli_fetch_array($query1))
        {
          ?>
          <img class="card-img-top" src="<?php echo "../".$row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="event_name" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Edit Event"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="ert" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Download Registrants list"/>
            </form>
          <?php
          echo '</div>';
        }
      }
    $connect->close();
?>
</div>

<br><br>


  
<br>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
     
   
</body>
</html>
<?php
ob_end_clean();
ob_start();
?>
