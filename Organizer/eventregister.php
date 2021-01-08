<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css"> -->
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
  <a class= "active" href="eventregister.php">Add New Event</a>
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
        <h3 style="color:green; ">Add a New Event </h3>
        <form enctype="multipart/form-data" action="eventregister.php" method="post">
            <tr>
                <td>
                    Event Name : 
                    <input type= "text" id = "name_" name = "name_" placeholder="Name of the Event" maxlength="128" size="60" required/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Date : 
                    <input type= "date" id = "date_" name = "date_" size="20" required/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Start Time : 
                    <input type= "time" id = "start_time_" name = "start_time_" size="20"/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event End Time : 
                    <input type= "time" id = "end_time_" name = "end_time_" size="20"/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Description : 
                    <textarea type= "text" id = "desc_" name = "desc_" placeholder="Describe your event" maxlength="4096" cols="100" rows="5" required></textarea>
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Contact(Ph. no) : 
                    <input type= "text" id = "limit_" name = "conp_" placeholder="Phone no." maxlength="4096" size="10" required/>
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Contact(Name) : 
                    <input type= "text" id = "limit_" name = "cone_" placeholder="Name" maxlength="4096" size="60" required/>
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Limit (5000 is default Value for No Limit) : 
                    <input type= "number" id = "limit_" name = "limit_" placeholder="Max People Allowed" value=5000 maxlength="4096" size="60"/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Event Location :
                </td>
                <td>
                    <select name ="location_id" id = "location_id" required > 
                    <option disabled selected value> -- select an option -- </option>
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
                    <select name ="type_id" id = "type_id" required > 
                    <option disabled selected value> -- select an option -- </option>
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
                    Event Status :
                </td>
                <td>
                    <select name ="status_id" id = "status_id" required > 
                    <option disabled selected value> -- select an option -- </option>
                    <?php 
                        $conn=mysqli_connect('localhost','root','','event_management_nitc'); 
                        $result=mysqli_query($conn,'SELECT `Status_Id`,`Status` FROM event_status ORDER BY Status'); 
                        while($row=mysqli_fetch_assoc($result)) {
                            echo "<option value='$row[Status_Id]'>$row[Status]</option>"; 
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
                    <select name ="fee"  required > 
                    <option disabled selected value> -- select an option -- </option>
                    <option value=0>No, There is no fee payment</option> 
                    <option value=1>Yes, There is fee payment</option> 
                    </select>
                </td>
            </tr> <br><br>
            <tr>
                <td>
                    Picture (less than 2048 KB)
                    <input type= "file" id = "dp" name = "dp" />   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                    Standard Message to Notify all Users : 
                    <textarea type= "text" id = "msg__" name = "msg__" placeholder="Sample Message" maxlength="1024" cols="100" rows="5" ></textarea>
                </td>   
            </tr> <br> <br>
            <input type="submit" value="Submit"/>
            <input type="reset" value="Reset"/>
            <br><br>    

        </form>
        <h4><a href="org_dashboard.php"> Go Back to Dashboard</a></h4>
        <?php
if(isset($_POST['name_']))
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
        $name = $_POST['name_'];
        $date = $_POST['date_'];
        $start = $_POST['start_time_'];
        $end = $_POST['end_time_'];
        $desc = $_POST['desc_'];
        $limit = $_POST['limit_'];
        $cone=$_POST['cone_'];
        $conp=$_POST['conp_'];
        if(!empty($limit)){
            $limit = $_POST['limit_'];  
        }
        else{
            $limit = "NULL";
        }
        $loc =  $_POST["location_id"];
        $type =  $_POST["type_id"];
        $status =  $_POST["status_id"];
        $fee=$_POST["fee"];
      
        // $image = $_FILES['image']['tmp_name'];
        // $image = addslashes(file_get_contents($image))
        
        $sql = "INSERT INTO `event_management_nitc`.`events` (`Event_Name`,`Event_Date`,`Event_Start_Time`,`Description`,`Event_End_Time`,`Event_Limit`,`Event_Type_Id`,`Location_Id`,`Status_Id`,`fee`)
         VALUES ('$name','$date','$start','$desc','$end',$limit,'$type','$loc','$status',$fee)";
        if($connect->query($sql) == true){
            print "Successfully inserted". "<br>";
            $query3=mysqli_query($connect,"select Event_Id,Event_Name from events
             where  Event_Name='$name'")or die("Error: " . mysqli_error($connect));
            $row3=mysqli_fetch_array($query3);
            print "Your Event Id for ".$row3[1]. " is ".$row3[0]. " Save it for Future Reference."."<br>";
            $eve=$row3[0];
            $sql1="INSERT INTO `event_contact` (`event_id`, `contact_no`, `Name`) VALUES ('$eve', '$conp', '$cone')";
            $query3=mysqli_query($connect,$sql1)or die("Error: " . mysqli_error($connect));
            $dfg=$_SESSION['id'];
            $sql2="INSERT INTO `event_org_list` (`Event_Id`, `Organizer_id`) VALUES ('$eve', '$dfg')";
            $query3=mysqli_query($connect,$sql2)or die("Error: " . mysqli_error($connect));
            // Flag for successful insertion
            $mess = $_POST["msg__"];
            if(!empty($mess))
            {
                $sqlx = mysqli_query($connect,"INSERT INTO `messages`(`Event_Id`,`UserId`,`message`) VALUES ($eve,'ALL','$mess')") 
                or die("Error No Notification: " . mysqli_error($connect));;
            }
            

            $msg = ""; 
  
    
            $output_dir = "../upload/";
            $filename = $_FILES["dp"]["name"]; 
            $tempname = $_FILES["dp"]["tmp_name"];     
            if (!file_exists($output_dir))
            {
                @mkdir($output_dir, 0777);
            }   
            
            if($filename == ""){
                $folder ="NULL";
                $folder1 = "NULL";
            }
            else{
                $folder = "../upload/".$row3[1]."-".$filename;
                // echo $folder."<br>";
                
                $folder1 = "upload/".$row3[1]."-".$filename; 
                // echo $folder1."<br>";
            }
           
            // echo "Hello";
            // echo $folder;
            // $connect = mysqli_connect("localhost", "root", "", "photos"); 
        
                // Get all the submitted data from the form 
                $sql = "UPDATE `events` SET `Picture` = '$folder1' WHERE `Event_Id` = $row3[0]"; 
        
                // Execute query 
                mysqli_query($connect, $sql); 
                
                
                if (move_uploaded_file($tempname, $folder))  { 
                    $msg = "Image uploaded successfully"; 
                }else{ 
                    $msg = "Failed to upload image"; 
            } 
             

            $insert = true;
            $result='<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Form</strong> Sucessfully submitted.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }
        else{        
            echo "ERROR: $sql <br> $connect->error";
        }
        // Close the database connection
        $connect->close();
    }
}
?>

        </div>
    </body>
</html>
