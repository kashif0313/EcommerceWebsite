<?php
session_start(); 
include_once("connectdb.php");
$Email=$_SESSION["emailuser"];
$FinalCode=$_SESSION["emailuserCode"];
?>
<html>
<head>
<link rel="stylesheet" href="activator.css">
</head>
<body>
<div class="container">
<form method="POST">
<div class="activator_container">
<span class="title"> Account Activation</span>
<p class="title">Enter Code below </p>
<input class="code_input" placeholder="Enter Code" name="inputcode"/><br>
<button class="ActivateBtn" name="ActivateBtn">Activate</button>
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
	if($code==$FinalCode)
	{
	$sql2="UPDATE weblogin SET loginYorN='1' WHERE email='$Email'";
			mysqli_query($connectdb,$sql2);
			$sql = "SELECT * FROM  weblogin WHERE email='$Email'";
		$result = mysqli_query($connectdb,$sql);
		if($row = mysqli_fetch_assoc($result))
		{
			$LogedIn = $row['loginYorN'];
		}
		if($LogedIn==1)
		{echo"email verified!! and activated";
			header("location:Login.php");
			}
		elseif($LogedIn==0){echo"email verified!! and not activated";}
	}
	else
	{
		echo"email not verified!!";
	}
}
?>