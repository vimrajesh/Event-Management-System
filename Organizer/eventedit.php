<?php
session_start();
?>
<?php
if(isset($_POST['submit']))
{
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    $insert=false;
    //check connection
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else{
    //echo 'Connected Successfully!!';
        $eve=$_SESSION["eventid"];
        //$name = $_POST['name_'];
        if(isset($_POST['date_']))
        {
            $date = $_POST['date_'];  
        }
        if(isset($_POST['start_time_']))
        {
            $start = $_POST['start_time_'];  
        }
        if(isset($_POST['end_time_']))
        {
            $end = $_POST['end_time_'];  
        }
        if(isset($_POST['desc_']))
        {
            $desc = $_POST['desc_'];  
        }
        if(isset($_POST['limit_']))
        {
            $limit = $_POST['limit_'];  
        }
        if(isset($_POST['cone_']))
        {
            $cone = $_POST['cone_'];  
        }
        if(isset($_POST['conp_']))
        {
            $conp = $_POST['conp_'];  
        }
        if(isset($_POST['type_id']))
        {
            $type = $_POST['type_id'];  
        }
        if(isset($_POST['location_id']))
        {
            $loc = $_POST['location_id'];  
        }
        if(isset($_POST["fee"]))
        {
            $fee = $_POST["fee"];  
        }


        if(!empty($name)){ 
            mysqli_query($connect,"UPDATE events SET Event_Name = $name WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($date)){ 
            mysqli_query($connect,"UPDATE events SET Event_Date = '$date' WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($start)){ 
            mysqli_query($connect,"UPDATE events SET Event_Start_Time = '$start' WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($end)){ 
            mysqli_query($connect,"UPDATE events SET Event_End_Time = '$end' WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($desc)){ 
            mysqli_query($connect,"UPDATE events SET Description = '$desc' WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($limit)){ 
            mysqli_query($connect,"UPDATE events SET Event_Limit = $limit WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($loc)){ 
            mysqli_query($connect,"UPDATE events SET Location_Id = $loc WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($type)){ 
            mysqli_query($connect,"UPDATE events SET Event_Type_Id = $type WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(($fee == 0) || ($fee ==1)){ 
            mysqli_query($connect,"UPDATE events SET fee = $fee WHERE Event_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }


      
        // $image = $_FILES['image']['tmp_name'];
        // $image = addslashes(file_get_contents($image))
        
    }
}
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
  
  <?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $eve=$_SESSION["eventid"];
        //echo $eve;
        $query1=mysqli_query($connect,"SELECT * from events where Event_Id='$eve'") or die("Error1: " . mysqli_error($connect));
        $row1=mysqli_fetch_array($query1);
        //echo $row1[1];
        $l=$row1[8];
        $query2=mysqli_query($connect,"SELECT Location_Name from event_location where Location_Id='$l'") or die("Error2: " . mysqli_error($connect));
        $row8=mysqli_fetch_array($query2);
        $l_name=$row8[0];;
        $query4=mysqli_query($connect,"SELECT Event_Type_Name from event_type where event_type_id='$row1[7]'") or die("Error4: " . mysqli_error($connect));
        $row7=mysqli_fetch_array($query4);
        //$query5=mysqli_query($connect,"SELECT `Status` FROM event_status where Status_Id='$row1[9]'") or die("Error5: " . mysqli_error($connect));
        //$row6=mysqli_fetch_array($query5);
        //echo $row1[1];
    }
    
    ?>
</div>

    <body>
    <form enctype="multipart/form-data" action="eventedit.php" method="post">
            <tr>
                <td>
                    Event Name : 
</td>
<td>
                    <input type= "text" id = "name_" name = "name_" placeholder="<?php echo $row1[1]; ?>" maxlength="128" size="60" disabled required/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Date : 
                    </td>
<td>
                    <input type= "date" id = "date_" name = "date_" value="<?php echo $row1[2]; ?>" size="20" />   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Start Time : 
                    </td>
<td>
                    <input type= "time" id = "start_time_" name = "start_time_" value="<?php echo $row1[3]; ?>" size="20"/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event End Time : 
                    </td>
<td>
                    <input type= "time" id = "end_time_" name = "end_time_" value="<?php echo $row1[5]; ?>" size="20"/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Description : 
                    </td>
<td>
                    <textarea type= "text" id = "desc_" name = "desc_" placeholder="<?php echo $row1[4]; ?>" maxlength="4096" cols="100" rows="5"></textarea>
                </td>   
            </tr> <br> <br> 

            <tr>
                <td>
                    Event Limit : 
                    </td>
<td>
                    <input type= "number"  name = "limit_" placeholder="<?php echo $row1[6]; ?>" maxlength="4096" size="60"/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Location :
 
                </td>
                <td>
                    <select name ="location_id" id = "location_id" > 
                    <option selected value><?php echo $row8[0]; ?></option>
                    <?php 
                        $conn=mysqli_connect('localhost','root','','event_management_nitc'); 
                        $result=mysqli_query($conn,'SELECT Location_Id,Location_Name FROM event_location ORDER BY Location_Name'); 
                        while($row=mysqli_fetch_assoc($result)) {
                            echo "<option value='$row[Location_Id]'>$row[Location_Name]</option>"; 
                        } 
                    ?> 
                    </select>
                </td>
            </tr> <br><br>
            <tr>
                <td>
                    Event Type :
                </td>
                <td>
                    <select name ="type_id" id = "type_id" > 
                    <option selected value><?php echo $row7[0]; ?></option>
                    <?php 
                        $conn=mysqli_connect('localhost','root','','event_management_nitc'); 
                        $result=mysqli_query($conn,'SELECT Event_Type_Id,Event_Type_Name FROM event_type ORDER BY Event_Type_Name'); 
                        while($row=mysqli_fetch_assoc($result)) {
                            echo "<option value='$row[Event_Type_Id]'>$row[Event_Type_Name]</option>"; 
                        } 
                    ?> 
                    </select>
                </td>
            </tr> <br><br>
            <tr>
                <td>
                    Event Fee :
                </td>
                <td>
                    <select name ="fee" id = "fee"> 
                    <option selected value = "<?php echo $row1[11]?>"><?php 
                    if($row1[11])
                    {
                        echo "Yes, There is fee payment";
                        echo "</option>";
                        echo "<option value=0>No, There is no fee payment</option> ";
                    }
                    else
                    {
                        echo "No, There is no fee payment";
                        echo "</option>";
                        echo "<option value=1>Yes, There is fee payment</option> ";
                    }
                    ?>
                    <!-- </option>
                    <option value=0>No, There is no fee payment</option> 
                    <option value=1>Yes, There is fee payment</option>  -->
                    </select>
                </td>
            </tr> <br><br> 
            <input type="submit" name="submit" value="Submit"/>
            <input type="reset" value="Reset"/>
            <br><br>    

        </form>
        
    </body>
</html>

