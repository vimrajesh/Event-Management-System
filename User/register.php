<?php
session_start();
// echo $_SESSION["eventname"];
if(isset($_POST["Delrew"]))
{
  $review_id=$_POST["Delr"];
  //echo $review_id;
  $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        //$d1=$_SESSION["eventname"];
        $query1=mysqli_query($connect,"DELETE FROM `review` where `Review_Id`=$review_id") or die("Error: " . mysqli_error($connect));
        // $row1=mysqli_fetch_array($query1);

    }    
  // echo $row1[0];
  
  $connect->close();    
}
if(isset($_POST["register"]))
{
  $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        $d1=$_SESSION["eventname"];
        $query1=mysqli_query($connect,"SELECT Event_Id,fee from events where Event_Name='$d1'") or die("Error: " . mysqli_error($connect));
        $row1=mysqli_fetch_array($query1);
      }    
  // echo $row1[0];
  $a1=$_SESSION["id"];
  if(!$row1[1])
  {
  $query2=mysqli_query($connect,"INSERT into registrants_list (UserID,Event_Id) values('$a1',$row1[0])") or die("Error: " . mysqli_error($connect));
  }
  else
  {
    header("Location:register_fee.php");
    
  }
  $connect->close();    
}
if(isset($_POST["review"]))
{
  $gh_1=$_POST["review_title"];
  $gh_2=$_POST["review"];
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
        $eve=$row1[0];
        $a1=$_SESSION["id"];
        $query2=mysqli_query($connect,"INSERT into review (Review_Description,Review_Title,UserId,event_id) values('$gh_2','$gh_1','$a1',$eve)") or die("Error: " . mysqli_error($connect));
      }    
  $connect->close();    
}
if(isset($_POST["deregister"]))
{
  $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        $d1=$_SESSION["eventname"];
        $query1=mysqli_query($connect,"SELECT Event_Id,fee from events where Event_Name='$d1'") or die("Error: " . mysqli_error($connect));
        $row1=mysqli_fetch_array($query1);

      }    
  //echo $row1[0];
  $a1=$_SESSION["id"];
  if(!$row1[1])
  {
  $query2=mysqli_query($connect,"DELETE from registrants_list where UserID='$a1' and Event_Id=$row1[0] ") or die("Error: " . mysqli_error($connect));
  }
  else
  {
    $query3=mysqli_query($connect,"Select upload from registrants_list where UserID='$a1' and Event_Id=$row1[0] ") or die("Error: " . mysqli_error($connect));
    $upl=mysqli_fetch_array($query3);
    if (!unlink($upl[0])) {  
      echo $upl[0]."cannot be deleted due to an error";  
  }  
  else {  
      //echo $upl[0]. "has been deleted"; 
      $query4=mysqli_query($connect,"DELETE from registrants_list where UserID='$a1' and Event_Id=$row1[0] ") or die("Error: " . mysqli_error($connect)); 
  } 
  }
  $connect->close();    
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
<hr style="height:2px; color:black; background-color:black">


<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        $d1=$_SESSION["eventname"];
        $query1=mysqli_query($connect,"SELECT * from events where Event_Name='$d1'") or die("Error: " . mysqli_error($connect));
        $row1=mysqli_fetch_array($query1);

      }
      $connect->close();
  ?>
<img  src="<?php echo "../".$row1[10]; ?>" width="325px" height="400px" alt="" style="padding-left:20px;">
<div class="text">
<h3 id="head1"><?php echo $row1[1]; ?></h3>
<?php
if($row1[2]== NULL)
{
  $row1[2]="--:--:--";
} 
?>
<button type="button" class="btn btn-success"><?php echo $row1[2]; ?></button>
<?php
if($row1[3]== NULL)
{
  $row1[3]="--:--:--";
} 
?>
<button type="button" class="btn btn-success"><?php echo $row1[3]; ?></button>
<?php
if($row1[5]== NULL)
{
  $row1[5]="--:--:--";
} 
?>
<button type="button" class="btn btn-success"><?php echo $row1[5];  ?></button>
<br>
<h4>Description:</h4>
<textarea rows="8" cols="200" disabled="disabled" style="width:500px;">
<?php echo $row1[4]; ?>

</textarea>

</div>
<?php
$connect=mysqli_connect('localhost','root','','event_management_nitc');
if(mysqli_connect_errno($connect))
{
    echo 'Failed to connect to database: '.mysqli_connect_error();
}
else
{   
    $d1=$_SESSION["eventname"];
    $query1=mysqli_query($connect,"SELECT Event_Limit,Event_Id from events where Event_Name='$d1'") or die("Error: " . mysqli_error($connect));
    $row1=mysqli_fetch_array($query1);
    $cc=$row1[0];
    $eve = $row1[1];
    //echo $row1[1];
    $query1=mysqli_query($connect,"SELECT COUNT(UserId) FROM registrants_list WHERE Event_Id=$row1[1];") or die("Error: " . mysqli_error($connect));
    $row=mysqli_fetch_array($query1);
    $c=$row[0];
    
    $a1=$_SESSION["id"];
    $d1=$_SESSION["eventname"];
    
    $query1=mysqli_query($connect,"SELECT * FROM registrants_list WHERE UserId='$a1' and Event_Id =$row1[1]") or die("Errorb: " . mysqli_error($connect));
    $row1=mysqli_fetch_array($query1);
    // echo $row1."<br>";
    // echo $row1[]."<br>";
    
    $flag=1;  
    // echo $rowst[0]." ".$c." ".$cc." ".(is_array($row1))." ".$flag."<br>";
    $query2 = mysqli_query($connect,"SELECT Status_Id FROM events WHERE Event_Name='$d1'") or die("Errorb: " . mysqli_error($connect));
    $rowst=mysqli_fetch_array($query2);
    if(($c < $cc) && ($rowst[0] == 9) ){
      $queryx = mysqli_query($connect,"UPDATE events as e SET e.Status_Id = '1' WHERE Event_Id =$eve") or die("Errorb: " . mysqli_error($connect));
      $rowst[0] =1;
    }
    if($c == $cc){
      $query3 = mysqli_query($connect,"UPDATE events as e SET e.Status_Id = '9' WHERE Event_Id =$eve") or die("Errorb: " . mysqli_error($connect));
    }
    // $query2 = mysqli_query($connect,"SELECT Status_Id FROM events WHERE Event_Name='$d1'") or die("Errorb: " . mysqli_error($connect));
    // $rowst=mysqli_fetch_array($query2);
    if( ($rowst[0]==2) || ($rowst[0]==3) || ($rowst[0]==6) || ($rowst[0]==8) || ($rowst[0]==9) )
    {
      $flag=0;
    }
    
    // echo ((is_array($row1)) &&( $c<$cc) && ($flag))."<br>"; 
    // echo $rowst[0]." ".$c." ".$cc." ".(is_array($row1))." ".$flag."<br>";

    if((is_array($row1))) {    
?>
<form action="register.php" method="post">
<input type="submit" name="deregister" id="bt1" class="btn btn-danger" value=Deregister />
</form>
<?php
} else if(($c<$cc) && ($flag ==1)){
?>
<form action="register.php" method="post">
<input type="submit" name="register" id="bt3" class="btn btn-warning" value=Register />
</form>
<?php
        }else if ($flag==0 || $c==$cc){
?>
<button type="button" class="btn btn-success">
  <?php 
    $x = mysqli_query($connect,"SELECT s.Status FROM events as e JOIN event_status  as s
    ON e.Status_Id = s.Status_Id  WHERE Event_Id =$eve") or die("Errorb: " . mysqli_error($connect));
    $rowzz=mysqli_fetch_array($x);
    echo $rowzz[0]; ?>
  </button>
<?php
      }
      $connect->close();}
?>
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        $d1=$_SESSION["eventname"];
        $query1=mysqli_query($connect,"SELECT Event_Limit,Event_Id from events where Event_Name='$d1'") or die("Error: " . mysqli_error($connect));
        $row1=mysqli_fetch_array($query1);
        $cc=$row1[0];
        $query1=mysqli_query($connect,"SELECT COUNT(UserId) FROM registrants_list WHERE Event_Id=$row1[1];") or die("Error: " . mysqli_error($connect));
        $row=mysqli_fetch_array($query1);
        $c=$row[0];
        ?>
       <input type="submit"  id="bt2" class="btn btn-primary" value="<?php echo $c; ?>/<?php echo $cc; ?>"/>
        <?php
      }
      $connect->close();
  ?>



<hr style="height:2px; color:black; background-color:black">
<br>
<?php
$connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        $a1=$_SESSION["id"];
        $query1=mysqli_query($connect,"SELECT Picture from user where UserId='$a1'") or die("Error: " . mysqli_error($connect));
        $zxc=mysqli_fetch_array($query1);
      }    
  ?>
<img class="img-thumbnail" src=<?php echo "../".$zxc[0]; ?> id="responsive-image" alt=""><br>
<!-- <h4><?php // echo " "." ".$_SESSION["name"]; ?></h4> -->
<div class=par>
<div class="tet">
<br><br>  

<h4>Post your Review:</h4>
<form action="register.php" method="post">

<input type="text" name="review_title" placeholder="Review Title" style="width: 350px; height: 30px;"><br><br>
<!-- <input type="text" style="width: 500px; height: 20px;"> -->

 <textarea name="review" rows="3" cols="20"  style="width:500px;">

</textarea> 
<br>
<button type="submit" class="btn btn-info">Post</button>
</form>
</div>
</div>

<hr style="height:2px; color:black; background-color:black">


<h2 style= 'color:green;' >User Reviews</h2>


<?php
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
        $eve=$row1[0];
        $query1=mysqli_query($connect,"Select Review_Title,Review_Description,UserId,Review_Id,Timestamp from review where event_id=$eve") or die("Error: " . mysqli_error($connect));
        $count=1;
        echo '<p style="text-align:left">';
        while($row1=mysqli_fetch_array($query1))
        {
          //echo $count;
          $query2=mysqli_query($connect,"Select Display_Name,Picture from user where UserId='$row1[2]'") or die("Error: " . mysqli_error($connect));
          $ust=mysqli_fetch_array($query2)
  ?>
         <div class="card mb-3" style="max-width: 1500px;">
            <div class="row g-0">
                <div class="col-md-1">
                <img src="../<?php echo $ust[1]; ?>" id="responsive-image1" alt="../Profiles/default.jpeg">

                </div>
                <div class="col-md-9">
                <div class="card-body">
                
                <h5 class="card-text"><?php echo $row1[0]; ?></h5>
                <p class="card-text"><?php echo $row1[1]; ?></p>
                <?php
                if($row1[2]==$_SESSION["id"])
                {
                ?>
                <form action="register.php" method="post">
                <input hidden type="text"   value="<?php echo $row1[3];?>" name="Delr"/>
                <input type="submit" name="Delrew" id="bt3" class="btn btn-danger" value=Delete />
                </form>
                <?php
                }
                ?>
                <!-- <p class = "card-title">Posted by </p> -->
                <p class="card-text"><small class="text-muted"><?php echo 'Posted By '.$ust[0].' at '.$row1[4]; ?></small></p>
                </div>
              </div>
            </div>
          </div>
            <?php           
        }
        echo '</p>';
        echo "<br>";
    }
    $connect->close();
?>  
</body>
</html>