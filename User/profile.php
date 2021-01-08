<?php
    session_start();
// echo $_SESSION["name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

/* .active, .collapsible:hover {
  background-color: #555;
} */

.content {
  padding: 0 18px;
  display: none;
  /overflow: hidden;/
  background-color: #f1f1f1;
}







/* 

body{ 
     background: -webkit-linear-gradient(left, #3931af, #00c6ff); 
} */
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff; 
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;     
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
#responsive-image {  width: 200px;  height: 200px; } 
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work input{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
#page5{
    position:relative;
    left:365px;
    bottom:90px;
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
  <a class = "active" href="profile.php">User Profile</a>
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



<!------ Include the above in your HEAD tag ---------->
<?php 
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    $ax = $_SESSION["id"];
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        $query1 = mysqli_query($connect,"SELECT u.UserId, u.Display_Name, u.Picture,
            u.Last_Login_Info,u.Registered_name, u.Contact_No, u.Mail_Id, ua.Password                                           
            from user as u 
            join user_authentication as ua
            on u.UserId = ua.UserId
            where u.UserId='$ax'") or die("Error: " . mysqli_error($connect));
        $row1=mysqli_fetch_array($query1);
        // echo "Thanks for the Input"."<br>";
    } 
    $connect->close();?>
    
<div class="container emp-profile">
            <!-- <form method="post"> -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src= <?php $msgx = "../".$row1[2]; echo $msgx; ?> id="responsive-image" alt=""/>
                            <!-- <div class="file btn btn-lg btn-primary">
                                Change Photo
                                 <input type="file" name="file"/> -->
                            <!-- </div> --> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h3>
                                        <?php 
                                        echo $row1[4]; ?>
                                    </h3>
                                    <!-- <h6>
                                        Web Developer and Designer
                                    </h6> -->
                                    <!-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li> -->
                            </ul>
                        </div>
                    </div><form action="profile.php" method="POST">
                    <div class="col-md-2">
                        <input type="submit"  name="btnAddMore" value="Edit Profile"/>
                            <?php 
                                if(isset($_POST["btnAddMore"]))
                                {
                                  $con=mysqli_connect('localhost','root','','event_management_nitc');
                                    if(mysqli_connect_errno($con))
                                    {
                                        echo 'Failed to connect to database: '.mysqli_connect_error();
                                    }
                                    else
                                    {   
                                        $uid=$_SESSION["id"];
                                        $name = $_POST['dname'];
                                        $email = $_POST['email'];
                                        $number = $_POST['number'];
                                        if($name == ""){
                                            $name = $row1[1];
                                        }
                                        if($email == ""){
                                            $email = $row1[6];
                                        }
                                        if($number == ""){
                                            $number = $row1[5];
                                        }

                                        $queryasd=mysqli_query($con,"UPDATE `user` SET `Display_Name` = '$name',
                                         `Contact_No` = '$number',
                                         `Mail_Id` = '$email'
                                         where `UserId`='$uid'") or die("Error: " . mysqli_error($con));
                                        
                                        $con->close();

                                    }
                                }

                                       
                                
                            ?>
                        
                        <?php 
                            $connect=mysqli_connect('localhost','root','','event_management_nitc');
                            $ax = $_SESSION["id"];
                            if(mysqli_connect_errno($connect))
                            {
                                echo 'Failed to connect to database: '.mysqli_connect_error();
                            }
                            else
                            {   
                                $query1 = mysqli_query($connect,"SELECT u.UserId, u.Display_Name, u.Picture,
                                    u.Last_Login_Info,u.Registered_name, u.Contact_No, u.Mail_Id                                          
                                    from user as u 
                                    join user_authentication as ua
                                    on u.UserId = ua.UserId
                                    where u.UserId='$ax'") or die("Error: " . mysqli_error($connect));
                                $row1=mysqli_fetch_array($query1);
                                // echo "Thanks for the Input"."<br>";
                            } 
                            $connect->close();?>
                    </div>
                </div>
                <div class="row" id="page5">
                    
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>UserID</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <?php echo $row1[0]; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Registered Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <?php echo $row1[4]; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Last Login Info</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                  <?php echo $row1[3]; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Display Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                    $prt1=$row1[1];
                                                    if($row1[1] == "")
                                                    {
                                                        $prt1 = "Not Added Yet";
                                                    }

                                                    ?>
                                                <input type= "text" id = "dname"  
                                                placeholder = "<?php echo $prt1; ?>"
                                                name = "dname"/>
            
                                            
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email ID</label>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                    $prt2=$row1[6];
                                                    if($row1[6] == "")
                                                    {
                                                        $prt2 = "Not Added Yet";
                                                    }

                                                    ?>
                                                <input type= "text" id = "email"  
                                                    placeholder = "<?php echo $prt2; ?>"
                                                    name = "email"/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                $prt3=$row1[5];
                                                if($row1[5] == "")
                                                {
                                                    $prt3 = "Not Added Yet";
                                                }

                                                ?>
                                                <input type= "text" id = "number"  
                                                    placeholder = "<?php echo $prt3; ?>"
                                                    name = "number"/>
                                                    
                                            </div>
                                        </div>
                                       
                                        <a href = "changepwd.php">Change Password </a> <br>
                                        <a href = "changedp.php">Change Profile Photo </a>
                                    
                            </div>
                        </div>
                    </div>
                   

                </div>
            </form>           
        </div>
</body>
</html>