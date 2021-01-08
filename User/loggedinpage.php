<?php
session_start();
// echo $_SESSION["name"];
if(isset($_POST['event_name']))
{
  if($_SESSION["id"])
  {
  $_SESSION["eventname"]=$_POST["event_name"];
  header("Location:register.php");
  }
}
if(isset($_POST['ask']))
{
  if($_SESSION["id"])
  {
  $_SESSION["eventname"]=$_POST["ask"];
  header("Location:send_query.php");
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
  <a class="active" href="loggedinpage.php">Events</a>
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

<h2 style="color:black;">List of events:</h2>
<br>
<button type="button" class="collapsible">Technical Club Hosted Events</button>
<div class="card lg-12"   id = "content">
  <?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date,e.Picture, L.Location_Name, S.Status 
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
        where o.Organizer_type = 'Technical Club' 
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));

         echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[2] = "../".$row1[2];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top"  width="300px" height="300px" src="<?php echo $row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="event_name" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Event"/>
            </form>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="ask" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Ask Query to the Organizer"/>
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
<button type="button" class="collapsible" aria-expanded="false">Cultural Club Hosted Events</button>
<div class="card lg-12"   id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date,e.Picture, L.Location_Name, S.Status 
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
        where o.Organizer_type = 'Cultural Club' 
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));

        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[2] = "../".$row1[2];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          //echo $row1[2]; 
          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo $row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="event_name" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Event"/>
            </form>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="ask" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Ask Query to the Organizer"/>
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
<button type="button" class="collapsible">Sports and Fitness Related Events</button>
<div class="card lg-12"  id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date,e.Picture, L.Location_Name, S.Status 
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
        where o.Organizer_type = 'Sports and Fitness Clubs' 
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));

        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[2] = "../".$row1[2];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo $row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="event_name" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Event"/>
            </form>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="ask" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Ask Query to the Organizer"/>
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
<button type="button" class="collapsible">Department Associations</button>
<div class="card lg-12"   id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date,e.Picture, L.Location_Name, S.Status 
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
        where o.Organizer_type = 'Department Associations' 
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));
        
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[2] = "../".$row1[2];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo $row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="event_name" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Event"/>
            </form>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="ask" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Ask Query to the Organizer"/>
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
<button type="button" class="collapsible">SAC Hosted Events</button>
<div class="card lg-12"   id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date,e.Picture, L.Location_Name, S.Status 
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
        where o.Organizer_type = 'Students Body/ Council' 
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));
        
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        { $row1[2] = "../".$row1[2];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top"  width="300px" height="300px" src="<?php echo $row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="event_name" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Event"/>
            </form>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="ask" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Ask Query to the Organizer"/>
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
<button type="button" class="collapsible">Socially Related Events</button>
<div class="card lg-12"  id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date,e.Picture, L.Location_Name, S.Status 
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
        where o.Organizer_type = 'Social Cause Club' 
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));
        
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        { $row1[2] = "../".$row1[2];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top"  width="300px" height="300px" src="<?php echo $row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="event_name" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Event"/>
            </form>
            <form action="loggedinpage.php" method="post">
            <input hidden type="text"  name="ask" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Ask Query to the Organizer"/>
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