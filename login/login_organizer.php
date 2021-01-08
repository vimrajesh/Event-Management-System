<?php
session_start();
$message="";
if(count($_POST)>0) {
 $con = mysqli_connect('localhost','root','','event_management_nitc') or die('Unable To connect');
$username = $_POST["user_name"];
$username = mysqli_real_escape_string($con, $username);
$pwd = $_POST["password"];
$pwd = mysqli_real_escape_string($con, $pwd);
 if($_POST["user_name"]=="root")
 {
     if($_POST["password"]=="nitc@2020")
     {
        $_SESSION["name"]="root";
        $_SESSION["id"]="root";
        header("Location:../root/home.php");  
     }
 }
 $hash = hash('sha256', (get_magic_quotes_gpc() ? stripslashes($pwd) : $pwd));
 $sql="SELECT * FROM organizer_authentication 
  WHERE username='$username' AND Password ='$hash'";
 //echo $sql;
$result = mysqli_query($con,$sql);
$row  = mysqli_fetch_array($result);
if(is_array($row)) {
	
	$_SESSION["name"] = $row['username'];
	
    $_SESSION["id"]=$row['Organizer_Id'];
//$isme = mysqli_query($con,"SELECT Display_Name FROM user WHERE UserId='" . $row['UserId'] ."'");
//$ans  = mysqli_fetch_array($isme);
//$_SESSION["name"] = $ans['Display_Name'];
} else {
$message = "Invalid Username or Password!";
}
}
if(isset($_SESSION["id"]) && $_SESSION["id"]!="root") {
header("Location:../Organizer/org_dashboard.php");
echo $_POST["password"];
}
?>
<html>
<head>
	<title>Login Page</title>
   
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">

    
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<style>

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 340px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
</style>

</head>







<!------ Include the above in your HEAD tag ---------->



<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Organizer Sign In</h3>
				
			</div>
			<div class="card-body">
				<form name="frmUser" method="post">
                <div class="message"  style = "color : white"><?php if($message!="") { echo $message; } ?></div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="user_name" class="form-control" placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password"  name="password" class="form-control" placeholder="password">
					</div>
				
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
			<a href="../Homepage/home.php">Go back to homepage</a>
			</div>
		</div>
	</div>
</div>











</body>
</html>