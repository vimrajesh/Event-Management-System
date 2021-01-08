
<?php
session_start();
// echo $_SESSION["name"];
if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    if($_SESSION['id'] == "root" && $_SESSION['name'] == "root")
    {

    }
}
else{
    echo "<h3><center>"."Are you the real Root?! Coz you dont smell like one."."</h3></center>";
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);
    unset($_SESSION["eventname"]);
    unset($_SESSION["eventid"]);
    unset($_SESSION["organizer_id"]);
    
    echo "<script>setTimeout(\"location.href = '../Homepage/home.php';\",1500);</script>";
}
?>
<?php

    if(isset($_POST['userid']))
    {
        $conn=mysqli_connect('localhost','root','','event_management_nitc');
        $delete=false;
        //check connion
        if(mysqli_connect_errno($conn))
        {
            echo 'Failed to conn to database: '.mysqli_conn_error();
        }
        else{
            $id = $_POST['userid'];
            $result1=mysqli_query($conn,"DELETE FROM review WHERE UserId = '$id'") or die("Error1: " . mysqli_error($conn));
            $result2=mysqli_query($conn,"DELETE FROM user_authentication WHERE UserId = '$id'") or die("Error2: " . mysqli_error($conn));
            $result3=mysqli_query($conn,"DELETE FROM registrants_list WHERE UserId = '$id'") or die("Error3: " . mysqli_error($conn));
            
            $sql = "DELETE FROM `event_management_nitc`.`user` WHERE UserId = '$id'" or die("Error4: " . mysqli_error($conn));
            if($conn->query($sql) == true){
                print "Successfully Deleted". "<br>";
                
                $delete = true;
                $result='<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Form</strong> Sucessfully submitted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
            else{        
                echo "ERROR: $sql <br> $conn->error";
            }
            // Close the database connion
            $conn->close();
        }
    }
?>
<!doctype html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {margin:0;font-family:Arial}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}
.topnav-right {
  float: right;
}
.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}
</style>
</head>
    <body>
    <script src =  "js/jquery.js"></script>
     <script src = "js/bootstrap.min.js"></script>
<div class="topnahv">
    <h3 style="color:green; font-size:2rem; font-family: Verdana,sans-serif;" >Event Management System, NITC</h3>    
</div>
<div class="topnav" id="myTopnav">
  <a href="home.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Manage Users
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" >
      <a href="insert_user.php">Insert User</a>
      <a href="delete_user.php"  >Delete User</a>
      <a href="update_user.php">Update User</a>
      <a href="retrieve_user.php">Retrieve User</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Manage Organizers
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="insert_organizer.php">Insert Organizer</a>
      <a href="delete_organizer.php">Delete Organizer</a>
      <a href="update_organizer.php">Update Organizer</a>
      <a href="retrieve_organizer.php">Retrieve Organizer</a>
    </div>
  </div>
  <div class="dropdown" >
    <button class="dropbtn">Manage Events
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="insert_event.php">Insert Event</a>
      <a href="delete_event.php">Delete Event</a>
      <a href="update_event.php">Update Event</a>
      <a href="retrieve_event.php">Retrieve Event</a>
    </div>
  </div> 

  <a href="moderatereviews.php">Moderate Reviews</a>

  <div class="dropdown">
    <button class="dropbtn">Reset Password
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="reset_pswd_user.php">Reset User Password</a>
      <a href="reset_pswd_organizer.php">Reset Organizer Password</a>
    </div>
  </div>
  <a href="query.php">Own SQL Query</a>
  <a href="kyc.php">Know the Club</a>
  <a href="aboutus.php">RDB Diagram </a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>

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



    <script>
    function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
    }
    </script>
    <div style = "padding-left: 50px;">
    <h2 style="color:green;">Delete an User</h2>
        <form enctype="multipart/form-data" action="delete_user.php" method="post">
            <tr>
                <td>
                    <h3>Enter User Id (Format is [A-Z]{1}\d{6}[A-Z]{2} ) :</h3>
                </td>
                <td>
                <input type="text" name="userid" pattern="[A-Z]{1}\d{6}[A-Z]{2}" maxlength="9" required/>
                </td>
            </tr> <br><br>
            
            <input type="submit"  value="Submit"/>
            <input type="reset" value="Reset"/>
            <br><br>    
            <h4><a href="home.php"> Go Back to Home Page</a></h4>
        </form>
        </div>
    </body>
</html>

