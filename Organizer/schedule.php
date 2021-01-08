<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link href='https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css'>
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

body {
    background-color: #f9f9fa
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
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
  <a class="active" href="schedule.php">Schedule</a>
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

<hr style="height:2px; color:black; background-color:black">
<!-- <button type="button" class="collapsible" >All Active Events</button>
<div class="card mb-3" style="width:400px"  id = "content"> -->
<!-- <h4>Active Events: </h4> -->
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date, 
        L.Location_Name, S.Status, ec.contact_no,e.Event_Id 
        from events as e 
        join event_location as L
        join event_status as S 
        join event_contact as ec
        where e.Location_Id=L.Location_Id 
        and e.Status_Id=S.Status_Id 
        and ec.Event_Id = e.Event_Id and e.Event_Date >=CURDATE()
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));
          

        
        echo "<table border='2'>
        <tr>
        </tr>"."<h4>Active Events</h4>"."<tr>
        <th width='200px'>Event Name</th>
        <th>Event Date</th>
        <th>Location Name</th>
        <th>Status</th>
        <th width='200px'>Organizing Clubs</th>
        <th>Contacts</th>
        </tr>";
        // Execute the query
        
        while($row1=mysqli_fetch_array($query1))
        {
            echo "<tr>";
            echo "<td>" . $row1[0] . "</td>";
            echo "<td>" . $row1[1] . "</td>";
            echo "<td>" . $row1[2] . "</td>";
            echo "<td>" . $row1[3] . "</td>";
            $query2 = mysqli_query($connect,"select eo.Organizer_Name
            from events as e 
            join event_organizer as eo
            join event_org_list as eol
            on e.Event_Id = eol.Event_Id
            and eol.Organizer_id= eo.Organizer_Id 
            WHERE eol.Event_id =  $row1[5] and e.Event_Date >=CURDATE() 
            order by e.Event_Date") or die("Error: " . mysqli_error($connect));?>
            <td> <?php 
                $zz = mysqli_query($connect,"select COUNT(*)
                from events as e 
                join event_organizer as eo
                join event_org_list as eol
                on e.Event_Id = eol.Event_Id
                and eol.Organizer_id= eo.Organizer_Id 
                WHERE eol.Event_id =  $row1[5] and e.Event_Date >=CURDATE() 
                order by e.Event_Date") or die("Error: " . mysqli_error($connect));   
                $z1 = mysqli_fetch_array($zz);
                while($row2=mysqli_fetch_array($query2)) 
                {
                    if($z1[0] ==1){
                        echo $row2[0];
                    }
                    else{
                        echo $row2[0]." and ";
                    }
                    $z1[0] = $z1[0]-1;
                }
                
            ?></td>

            <?php
            echo "<td>" . $row1[4] . "</td>";
            echo "</tr>"; 


            
        }
    }
    echo "<br>";
    $connect->close(); 
?>
<!-- </div> -->
<!-- <h4>Inactive Events: </h4> -->
<?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        
        $query1=mysqli_query($connect,"select e.Event_Name,e.Event_Date, 
        L.Location_Name, S.Status, ec.contact_no,e.Event_Id 
        from events as e 
        join event_location as L
        join event_status as S 
        join event_contact as ec
        on e.Location_Id=L.Location_Id 
        and e.Status_Id=S.Status_Id 
        and ec.event_id = e.Event_Id 
        where e.Event_Date < CURDATE()
        order by e.Event_Date") or die("Error: " . mysqli_error($connect));
        // echo "<br>";
        echo "<table border='2'>
        <tr>
        </tr>"."<hr><h4>Inactive Events</h4>"."<tr>
        <th width='200px'>Event Name</th>
        <th>Event Date</th>
        <th>Location Name</th>
        <th>Status</th>
        <th width='200px'>Organizing Clubs</th>
        <th>Contacts</th>
        </tr>";
        // Execute the query
        while($row1=mysqli_fetch_array($query1))
        {
            echo "<tr>";
            echo "<td>" . $row1[0] . "</td>";
            echo "<td>" . $row1[1] . "</td>";
            echo "<td>" . $row1[2] . "</td>";
            echo "<td>" . $row1[3] . "</td>";
            $query2 = mysqli_query($connect,"select eo.Organizer_Name
            from events as e 
            join event_organizer as eo
            join event_org_list as eol
            on e.Event_Id = eol.Event_Id
            and eol.Organizer_id= eo.Organizer_Id 
            WHERE eol.Event_id =  $row1[5]  
            order by e.Event_Date") or die("Error: " . mysqli_error($connect));?>
            <td> <?php 
                $zz = mysqli_query($connect,"select COUNT(*)
                from events as e 
                join event_organizer as eo
                join event_org_list as eol
                on e.Event_Id = eol.Event_Id
                and eol.Organizer_id= eo.Organizer_Id 
                WHERE eol.Event_id =  $row1[5] and e.Event_Date >=CURDATE() 
                order by e.Event_Date") or die("Error: " . mysqli_error($connect));   
                $z1 = mysqli_fetch_array($zz);
                while($row2=mysqli_fetch_array($query2)) 
                {
                    if($z1[0] ==1){
                        echo $row2[0];
                    }
                    else{
                        echo $row2[0]." and ";
                    }
                    $z1[0] = $z1[0]-1;
                }
                
            ?></td>

            <?php
            echo "<td>" . $row1[4] . "</td>";
            echo "</tr>"; 


            
        }
    }
    $connect->close(); 
?>

    
</body>
</html>