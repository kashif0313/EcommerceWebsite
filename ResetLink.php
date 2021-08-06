<?php
session_start(); 
include_once("connectdb.php");
$Email=$_GET["emailuser"];
?>
<html>
<head>
<link rel="stylesheet" href="activator.css">
</head>
<body>
<div class="container">
<form method="POST">
<div class="activator_container">
<span class="title"> New Password</span>
<p class="title">Enter Code below </p>
<input class="code_input" placeholder="Enter Password" name="inputcode"/>
<input class="code_input" placeholder="Retype Password" name="inputcode1"/><br>
<button class="ActivateBtn" name="ActivateBtn">Reset</button>
<p class="note">Didn't get code click <a href="emailActivation.php" >here </a>to send code again</p> 
</div>
</div>
</form>
</body>
</html>
<?php 

if(isset($_POST['ActivateBtn']))
{
	$code =$_POST['inputcode']; 
	$code1 =$_POST['inputcode1'];
	if($code==$code1)
	{
	$sql2="UPDATE weblogin SET password='$code' WHERE email='$Email'";
			mysqli_query($connectdb,$sql2);
			header("location:login.php");
			exit();
	}
	else
	{
		echo"Password not matched..<br>Type Again.";
	}
}
?>