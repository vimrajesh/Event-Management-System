<?php
session_start();
// echo $_SESSION["name"];
if(isset($_POST['organizer_id']))
{
  if($_SESSION["id"])
  {
    $_SESSION["organizer_id"]=$_POST['organizer_id'];
    header("Location:club_profile.php");
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

.active, .collapssible:hover {
  background-color: #111;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
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
  <a  href="org_dashboard.php">Dashboard</a>
  <a href="profile.php">Organizer Profile</a>
  <a href="eventregister.php">Add New Event</a>
  <a class="active" href="kyc.php">Know Your Club</a>
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

<h2 style="color:black;">List of Clubs/ Associations:</h2>
<br>
<button type="button" class="collapsible">Technical Clubs</button>
<div class="card lg-12"   id = "content">
  <?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select distinct eo.Picture,eo.Organizer_Name, eo.Description, eo.Email_Id,
        o.Organizer_type, eo.Organizer_Id
        from event_organizer as eo
        join organizer_type as o
        on eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where o.Organizer_type = 'Technical Club'") or die("Error: " . mysqli_error($connect));
        
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[0] = "../".$row1[0];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo $row1[0]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[1]; ?></h4>
            <p class="card-text"style="color:gray;">Email Id:     <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Organizer Type: <?php echo $row1[4]; ?></p>
            <p class="card-text"style="color:gray;">Description:   <?php echo $row1[2]; ?></p>
            <p class="card-text"style="color:gray;">Events Conducted:   <?php 
            $que = mysqli_query($connect,"select  e.Event_Name from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
            $quez = mysqli_query($connect,"select COUNT(*) from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
             $cnt = mysqli_fetch_array($quez);
             $cnt = $cnt[0];
             while($rowx=mysqli_fetch_array($que))
            {
                if($cnt >1){
                    echo "$rowx[0]"." , ";
                }
                else{
                    echo "$rowx[0]";
                }
                $cnt = $cnt -1 ;
            }
             ?></p>
          <form action="kyc.php" method="post">
          <input hidden type="text"  name="organizer_id" value="<?php echo $row1[5]; ?>" />
          <input  type="submit" class="btn btn-primary" value="View Organizer Details"/>
          </form>
            <!--  -->
          <?php
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '<br>';
        }
        echo '</div>';
      }
    $connect->close();
?>
</div>


<br><br>
<button type="button" class="collapsible" aria-expanded="false">Cultural Clubs</button>
<div class="card lg-12"   id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select distinct eo.Picture,eo.Organizer_Name, eo.Description, eo.Email_Id,
        o.Organizer_type, eo.Organizer_Id    
        from event_organizer as eo
        join organizer_type as o
        on eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where o.Organizer_type ='Cultural Club'") or die("Error: " . mysqli_error($connect));
        
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[0] = "../".$row1[0];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;

          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo $row1[0]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[1]; ?></h4>
            <p class="card-text"style="color:gray;">Email Id:     <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Organizer Type: <?php echo $row1[4]; ?></p>
            <p class="card-text"style="color:gray;">Description:   <?php echo $row1[2]; ?></p>
            <p class="card-text"style="color:gray;">Events Conducted:   <?php 
            $que = mysqli_query($connect,"select  e.Event_Name from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
            $quez = mysqli_query($connect,"select COUNT(*) from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
             $cnt = mysqli_fetch_array($quez);
             $cnt = $cnt[0];
             while($rowx=mysqli_fetch_array($que))
            {
                if($cnt >1){
                    echo "$rowx[0]"." , ";
                }
                else{
                    echo "$rowx[0]";
                }
                $cnt = $cnt -1 ;
            }
             ?></p>
          <form action="kyc.php" method="post">
          <input hidden type="text"  name="organizer_id" value="<?php echo $row1[5]; ?>" />
          <input  type="submit" class="btn btn-primary" value="View Organizer Details"/>
          </form>
          <?php
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '<br>';
        }
        echo '</div>';
      }
    $connect->close();
?>
</div>

<br><br>
<button type="button" class="collapsible">Sports and Fitness Clubs</button>
<div class="card" style="width:400px"  id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select distinct eo.Picture,eo.Organizer_Name, eo.Description, eo.Email_Id,
        o.Organizer_type, eo.Organizer_Id  
        from event_organizer as eo
        join organizer_type as o
        on eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where o.Organizer_type = 'Sports and Fitness Clubs'") or die("Error: " . mysqli_error($connect));
        
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[0] = "../".$row1[0];
          ?>
          <img class="card-img-top" src="<?php echo $row1[0]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[1]; ?></h4>
            <p class="card-text"style="color:gray;">Email Id:     <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Organizer Type: <?php echo $row1[4]; ?></p>
            <p class="card-text"style="color:gray;">Description:   <?php echo $row1[2]; ?></p>
            <p class="card-text"style="color:gray;">Events Conducted:   <?php 
            $que = mysqli_query($connect,"select  e.Event_Name from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
            $quez = mysqli_query($connect,"select COUNT(*) from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
             $cnt = mysqli_fetch_array($quez);
             $cnt = $cnt[0];
             while($rowx=mysqli_fetch_array($que))
            {
                if($cnt >1){
                    echo "$rowx[0]"." , ";
                }
                else{
                    echo "$rowx[0]";
                }
                $cnt = $cnt -1 ;
            }
             ?></p>
          <form action="kyc.php" method="post">
          <input hidden type="text"  name="organizer_id" value="<?php echo $row1[5]; ?>" />
          <input  type="submit" class="btn btn-primary" value="View Organizer Details"/>
          </form>
          <?php
          echo '</div>';
        }
      }
    $connect->close();
?>
</div>

<br><br>
<button type="button" class="collapsible">Department Associations</button>
<div class="card" style="width:400px"  id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select distinct eo.Picture,eo.Organizer_Name, eo.Description, eo.Email_Id,
        o.Organizer_type, eo.Organizer_Id   
        from event_organizer as eo
        join organizer_type as o
        on eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where o.Organizer_type = 'Department Associations'") or die("Error: " . mysqli_error($connect));
        
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[0] = "../".$row1[0];
          ?>
          <img class="card-img-top" src="<?php echo $row1[0]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[1]; ?></h4>
            <p class="card-text"style="color:gray;">Email Id:     <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Organizer Type: <?php echo $row1[4]; ?></p>
            <p class="card-text"style="color:gray;">Description:   <?php echo $row1[2]; ?></p>
            <p class="card-text"style="color:gray;">Events Conducted:   <?php 
            $que = mysqli_query($connect,"select  e.Event_Name from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
            $quez = mysqli_query($connect,"select COUNT(*) from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
             $cnt = mysqli_fetch_array($quez);
             $cnt = $cnt[0];
             while($rowx=mysqli_fetch_array($que))
            {
                if($cnt >1){
                    echo "$rowx[0]"." , ";
                }
                else{
                    echo "$rowx[0]";
                }
                $cnt = $cnt -1 ;
            }
             ?></p>
          <form action="kyc.php" method="post">
          <input hidden type="text"  name="organizer_id" value="<?php echo $row1[5]; ?>" />
          <input  type="submit" class="btn btn-primary" value="View Organizer Details"/>
          </form>
          <?php
          echo '</div>';
        }
      }
    $connect->close();  
?>
</div>

<br><br>
<button type="button" class="collapsible">Student Body/ Council</button>
<div class="card" style="width:400px"  id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select distinct eo.Picture,eo.Organizer_Name, eo.Description, eo.Email_Id,
        o.Organizer_type, eo.Organizer_Id   
        from event_organizer as eo
        join organizer_type as o
        on eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where o.Organizer_type ='Students Body/ Council'") or die("Error: " . mysqli_error($connect));
        
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[0] = "../".$row1[0];
          ?>
          <img class="card-img-top" src="<?php echo $row1[0]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[1]; ?></h4>
            <p class="card-text"style="color:gray;">Email Id:     <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Organizer Type: <?php echo $row1[4]; ?></p>
            <p class="card-text"style="color:gray;">Description:   <?php echo $row1[2]; ?></p>
            <p class="card-text"style="color:gray;">Events Conducted:   <?php 
            $que = mysqli_query($connect,"select  e.Event_Name from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
            $quez = mysqli_query($connect,"select COUNT(*) from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
             $cnt = mysqli_fetch_array($quez);
             $cnt = $cnt[0];
             while($rowx=mysqli_fetch_array($que))
            {
                if($cnt >1){
                    echo "$rowx[0]"." , ";
                }
                else{
                    echo "$rowx[0]";
                }
                $cnt = $cnt -1 ;
            }
             ?></p>
          <form action="kyc.php" method="post">
          <input hidden type="text"  name="organizer_id" value="<?php echo $row1[5]; ?>" />
          <input  type="submit" class="btn btn-primary" value="View Organizer Details"/>
          </form>
          <?php
          echo '</div>';
        }
      }
    $connect->close();
?>
</div>

<br><br>
<button type="button" class="collapsible">Social Cause Clubs</button>
<div class="card" style="width:400px"  id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select distinct eo.Picture,eo.Organizer_Name, eo.Description, eo.Email_Id,
        o.Organizer_type, eo.Organizer_Id   
        from event_organizer as eo
        join organizer_type as o
        on eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where o.Organizer_type ='Social Cause Club'") or die("Error: " . mysqli_error($connect));
        
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[0] = "../".$row1[0];
          ?>
          <img class="card-img-top" src="<?php echo $row1[0]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[1]; ?></h4>
            <p class="card-text"style="color:gray;">Email Id:     <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Organizer Type: <?php echo $row1[4]; ?></p>
            <p class="card-text"style="color:gray;">Description:   <?php echo $row1[2]; ?></p>
            <p class="card-text"style="color:gray;">Events Conducted:   <?php 
            $que = mysqli_query($connect,"select  e.Event_Name from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
            $quez = mysqli_query($connect,"select COUNT(*) from events as e
             join event_org_list as eo
             on eo.Event_Id = e.Event_Id
             where eo.Organizer_id = '$row1[5]' ") or die("Error: " . mysqli_error($connect));
             $cnt = mysqli_fetch_array($quez);
             $cnt = $cnt[0];
             while($rowx=mysqli_fetch_array($que))
            {
                if($cnt >1){
                    echo "$rowx[0]"." , ";
                }
                else{
                    echo "$rowx[0]";
                }
                $cnt = $cnt -1 ;
            }
             ?></p>
          <form action="kyc.php" method="post">
          <input hidden type="text"  name="organizer_id" value="<?php echo $row1[5]; ?>" />
          <input  type="submit" class="btn btn-primary" value="View Organizer Details"/>
          </form>
          <?php
          echo '</div>';
        }
      }
    $connect->close();
?>
</div>

  
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