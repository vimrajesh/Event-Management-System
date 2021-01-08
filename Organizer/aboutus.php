<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
<style>
  <?php include "styles.css" ?>
</style>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.abcd{
	margin-bottom: .5rem;
	font-size: 3.5rem;
	font-family: Verdana,sans-serif;
	font-weight:500;
	line-height:1.2;
	margin-top:0;	
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


.paddingTB60 {padding:60px 0px 60px 0px;}
.gray-bg {background: #F1F1F1 !important;}
.about-title {}
.about-title h1 {color: #535353; font-size:45px;font-weight:600;}
.about-title span {color: #AF0808; font-size:45px;font-weight:700;}
.about-title h3 {color: #535353; font-size:23px;margin-bottom:24px;}
.about-title p {color: #7a7a7a;line-height: 1.8;margin: 0 0 15px;}
.about-paddingB {padding-bottom: 12px; font-size:20px;}
.about-img {padding-left: 20px;}

/* Social Icons */
.about-icons {margin:48px 0px 48px 0px ;}
.about-icons i{margin-right: 10px;padding: 0px; font-size:35px;color:#323232;box-shadow: 0 0 3px rgba(0, 0, 0, .2);}
.about-icons li {margin:0px;padding:0;display:inline-block;}
#social-fb:hover {color: #3B5998;transition:all .001s;}
 #social-tw:hover {color: #4099FF;transition:all .001s;}
 #social-gp:hover {color: #d34836;transition:all .001s;}
 #social-em:hover {color: #f39c12;transition:all .001s;}


 h1
{
	color:#fff;
	margin:40px 0 60px 0;
	font-weight:300;
}


.our-team-main
{
	width:100%;
	height:auto;
	border-bottom:5px #323233 solid;
	background:#fff;
	text-align:center;
	border-radius:10px;
	overflow:hidden;
	position:relative;
	transition:0.5s;
	margin-bottom:28px;
}


.our-team-main img
{
	border-radius:50%;
	margin-bottom:20px;
	width: 90px;
}

.our-team-main h3
{
	font-size:20px;
	font-weight:700;
}

.our-team-main p
{
	margin-bottom:0;
}

.team-back
{
	width:100%;
	height:auto;
	position:absolute;
	top:0;
	left:0;
	padding:5px 15px 0 15px;
	text-align:left;
	background:#fff;
	
}

.team-front
{
	width:100%;
	height:auto;
	position:relative;
	z-index:10;
	background:#fff;
	padding:15px;
	bottom:0px;
	transition: all 0.5s ease;
}

.our-team-main:hover .team-front
{
	bottom:-200px;
	transition: all 0.5s ease;
}

.our-team-main:hover
{
	border-color:#777;
	transition:0.5s;
}

/our-team-main/



</style>
</head>

<body>
<script src =  "js/jquery.js"></script>
     <script src = "js/bootstrap.min.js"></script>
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>




<div class="topnahv">
    <h3 style="color:green; font-size:2rem; font-family: Verdana,sans-serif;" >Event Management System, NITC</h3>
    
  
    
    
</div>



<div class="topnav">
  <a href="org_dashboard.php">Dashboard</a>
  <a href="profile.php">Organizer Profile</a>
  <a href="eventregister.php">Add New Event</a>
  <a href="kyc.php">Know Your Club</a>
  <a href="schedule.php">Schedule</a>
  <a href="filterdate.php">Filter Events by Date</a>
  <a class="active" href="aboutus.php">About The Team</a>
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

<div class="about-section paddingTB60 gray-bg">
                <div class="container">
                    <div class="row">
						<div class="col-md-11 col-sm-6">
							<div class="about-title clearfix">
								<h1>About <span>Event Management System (EMS)</span></h1>
								<h3>Made For NITC as part of DBMS Course Project</h3>
								<p class="about-paddingB">
								Our college has a plethora of technical and cultural events, informative webinars etc.,
								 going on week in week out. Sometimes, students miss out on interesting events due to lack of awareness
								  on what’s happening in the Campus.
								 This project mainly consolidates all the events at one place, 
								 for the students to view, plan and register for events accordingly.
								<br><br>
								The EMS is a web application intended to convey the student fraternity of the campus regarding all
								the scheduled events. This application is mainly intended for the student community all well as the
								Event Organising groups of the National Institute of Technology Calicut (NITC).<br>
								● This project enables all the Department Associations like CSEA, MEA, Technical & Cultural
								Clubs, and Social Initiatives like NSS to post all their events on a unified platform for
								students to view.<br>
								● The organizing teams of the respective events are the biggest benefactors, as the word of
								their event reaches out to the entire student community.<br>
								● This enables the organizing team to schedule the event accordingly, in order to avoid
								clashes between two events.<br>
								● Students can easily view and register for the event of their choice.
								</p>
						<div class="about-icons"> 
                                  
               
               
	           
	           
	        
	        </div>
							</div>
						</div>
						<div class="col-md-5 col-sm-6">
						<div class="about-img">
								<img src="https://devitems.com/preview/appmom/img/mobile/2.png" width="100"   alt="">
							</div>
						</div>	
                    </div>
                </div>
            </div>





            
<!------ Include the above in your HEAD tag ---------->


    <h1 class="text-center">Team Members</h1>

	
	<div class="container">
	<div class="row">
	
	<!--team-1-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="../team/vimal.jfif" class="img-fluid" />
	<h3>Vimal Rajesh <br> (B180336CS)</h3>
	</div>
	
	<div class="team-back">
	<span>
		Thrilled to finish working on the EMS project as I learned a lot of intricacies involved with building
		a full stack Event Management System. Thank you Sir, for providing this opportunity to work on this project.
	</span>
	</div>
	
	</div>
	</div>
	<!--team-1-->
	
	<!--team-2-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="../team/kunal.jfif" class="img-fluid" />
	<h3>Kunal Ravikumar Jagtap<br> (B180921CS)</h3>
	</div>
	
	<div class="team-back">
	<span>
	Very Excited to finish working on the EMS project as I learned a lot of intricacies involved with building
	a full stack Event Management System. Thank you Sir, for providing this opportunity to work on this project.
	</span>
	</div>
	
	</div>
	</div>
	<!--team-2-->
	
	<!--team-3-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="../team/alok.jfif" class="img-fluid" />
	<h3>Alok Raj<br> (B180411CS)</h3>
	</div>
	
	<div class="team-back">
	<span>
	Happy to finish working on the EMS project as I learned a lot of intricacies involved with building
	a full stack Event Management System. Thank you Sir, for providing this opportunity to work on this project.
	</span>
	</div>
	
	</div>
	</div>
	<!--team-3-->
	
	<!--team-4-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="../team/arjun.jpg" class="img-fluid" />
	<h3>P Arjun<br> (B180454CS)</h3>
	
	</div>
	
	<div class="team-back">
	<span>
	Glad to finish working on the EMS project as I learned a lot of intricacies involved with building
	a full stack Event Management System. Thank you Sir, for providing this opportunity to work on this project.
	</span>
	</div>
	
	</div>
	</div>
	<!--team-4-->
	
	<!--team-5-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="../team/dheeraj.jfif" class="img-fluid" />
	<h3>Puchakayala Dheeraj Reddy<br> (B180902CS)</h3>
	
	</div>
	
	<div class="team-back">
	<span>
	Delighted to finish working on the EMS project as I learned a lot of intricacies involved with building
	a full stack Event Management System. Thank you Sir, for providing this opportunity to work on this project.
	</span>
	</div>
	
	</div>
	</div>
	<!--team-5-->
	
	<!--team-6-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="../team/argah.jfif" class="img-fluid" />
	<h3>Argha Pratim Mandal<br> (B180331CS)</h3>
	</div>
	
	<div class="team-back">
	<span>
	Overjoyed to finish working on the EMS project as I learned a lot of intricacies involved with building
	a full stack Event Management System. Thank you Sir, for providing this opportunity to work on this project.
	</span>
	</div>
	
	</div>
	</div>
	<!--team-6-->
	
	
	
	</div>
	</div>
        
    
</body>
</html>