<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["eventname"]);
unset($_SESSION["eventid"]);
unset($_SESSION["organizer_id"]);
unset($_SESSION["queryid"]);

// echo "Successfully logged out<br>";
echo "<h3><center>"."Successfully Logged Out. "."</center></h3>".'<center><h3>'."Redirecting to HomePage.....".'</center></h3>';
echo "<script>setTimeout(\"location.href = '../Homepage/home.php';\",1500);</script>";
// $hello = ['I', 'love', 'ProcessWire', 'the end'];
// ob_implicit_flush(true);
// ob_end_flush();
// for($i = 0; $i < count($hello); $i++) {
//     echo $hello[$i].'<br>';
//     sleep(1);
// }
// sleep(1);
// echo "Redirecting<br>";

// header("Location:http://localhost/DBMS/Homepage/home.php");
//header("Location:login.php");
?>