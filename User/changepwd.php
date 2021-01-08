<?php
    session_start();
// echo $_SESSION["name"];
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
height: 370px;
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
<?php 
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    $ax = $_SESSION["id"];
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        if(isset($_POST['oldpwd']) && isset($_POST['npassword']) && isset($_POST['cpassword']) )
        {
            if($_POST["npassword"] == $_POST["cpassword"])
            {
                $query1 = mysqli_query($connect,"SELECT ua.Password                                          
                from user_authentication as ua
                where ua.UserId='$ax'") or die("Error: " . mysqli_error($connect));
                $row1=mysqli_fetch_array($query1);
                $hash = hash('sha256', (get_magic_quotes_gpc() ? stripslashes($_POST['oldpwd']) : $_POST['oldpwd']));
                if($hash == $row1[0])
                {
                    $newpwd = $_POST['npassword'];
                    $hash1 = hash('sha256', (get_magic_quotes_gpc() ? stripslashes($newpwd) : $newpwd));
                    $q1 = mysqli_query($connect, "UPDATE `user_authentication`
                        SET `Password` = '$hash1' WHERE `UserId` = '$ax'")

                        or die("Error: " . mysqli_error($connect));
                    
                    echo "<h3 style='color:white;'><center>"."Successfully Updated Password. "."</center></h3>"."<center><h3 style='color:white;'>"."Redirecting to Profile Page.....".'</center></h3>';
                    echo "<script>setTimeout(\"location.href = 'profile.php';\",1500);</script>";
                }
                else{
                    echo "Incorrect Old Password Provided."."<br>";
                }
            }
            else{
                echo "Confirm New Password is not same as New Password. Check Again."."<br>";
            }
        }
    } 
    $connect->close();
?>


<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Change Password</h3>
				
			</div>
			<div class="card-body">
				<form name="frmUser" action = "changepwd.php" method="post">
                <div class="message"><?php //if($message!="") { echo $message; } ?></div> 
					<div class="input-group form-group">
						<div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="oldpwd" class="form-control" minlength="8" placeholder="Old Password">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password"  name="npassword" class="form-control" minlength="8" placeholder="New Password">
					</div>

                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password"  name="cpassword" class="form-control" minlength="8" placeholder="Confirm New Password">
					</div>
				
					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right login_btn">
					</div>
                </form>
                
			</div>
			<div class="card-footer">
            <a href = "profile.php">Go Back To Profile Page </a>			
			</div>
		</div>
    </div>
    
</div>











</body>
</html>