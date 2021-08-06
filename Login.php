<?php
include_once("header.php");
include_once("connectdb.php");
if(isset($_GET['error']))
{
	$ErrorPage=$_GET['error'];
}
?>
<html>
<head>
<link rel="stylesheet" href="login.css">
<script src="signuplogin.js"></script>
</head>
<body>
<div class="container">
<form  method="POST">
<div class="login_box">
<p class="titleLogin">Login</p>
<div class="inputfields">

<input class="inputarea" type="email" name="email"placeholder="Email/Username">
<input class="inputarea" type="password" name="password" placeholder="Password"></div>
<div class="buttonscontainer">

<button class="login_signup" name="Loginbtn"  >LogIn</button>
<button class="login_signup" name="Registerbtn" >SignUP</button>
<button class="forgotpassword" name="forgotpasskey">Forgot password???</button>

</div>
<?php 
if(isset($_GET['error']))
{
	if($ErrorPage=='emptyfields')
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>Field / Fields empty</div>
</div>
<div class='overlay' id='OverlayID'></div> ";	
	}
	if($ErrorPage=='wrongpassword')
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>Wrong Password </div>
</div>
<div class='overlay' id='OverlayID'></div>";	
	}
	if($ErrorPage=='NoActivated')
	{
		echo"
		<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button><p class='errormsg2'>Account not Activated</p>
<div class='errormsg1'>Click on <a class='' href='emailActivation.php'>link</a>  to Activate your account</div>
</div>
<div class='overlay' id='OverlayID'></div>";	
	}
	if($ErrorPage=='nouser')
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>No User Exist</div>
</div>
<div class='overlay' id='OverlayID'></div>"	;
	}
}
?>
</div>
</form>
</div>
</body>
</html>
<?php
if (isset($_POST['closePopupBtn']))
{
	header("location:Login.php");
}
if (isset($_POST['Loginbtn']))
{
	$UserName = $_POST['email'];
	$Password = $_POST['password'];
	if($UserName=="admin@gmail.com" && $Password=="admin123")
	{
		
		$_SESSION['Adminpage'] = "Admin";
		header("location:index.php?loginAdmin");
		session_start();
		exit();	
	}
	if(empty($UserName) || empty($Password))
	{
		header("location:Login.php?emptyfields");
		exit();
	}
	else
	{
		//$Password = md5($Password); for encrypting password

		$sql = "SELECT * FROM  weblogin WHERE email='$UserName'";
		$result = mysqli_query($connectdb,$sql);
		if($row = mysqli_fetch_assoc($result))
		{
			$dbpassword = $row['password'];
			$LogedIn = $row['loginYorN'];
			if($LogedIn==1)
			{
				if($Password==$dbpassword)
				{
					header("location:index.php");
					session_start();
					$_SESSION['loginemail1']= $row['email'];
					$_SESSION['loginname']= $row['name'];
					$_SESSION['address']= $row['address'];
					$_SESSION['loginID']= $row['id'];
					exit();	
				}
				else
				{
					header("Location: Login.php?error=wrongpassword");
					exit();
				}
			}
			else
			{
				header("Location: Login.php?error=NoActivated");   
				exit();
			}
		}
		else
		{
			header("Location: Login.php?error=nouser");
			exit();
		}		
	}
	
}
if (isset($_POST['forgotpasskey']))
{
	header("location:forgotPassword.php");   /*--passing error to URL*/
			exit();
}if (isset($_POST['Registerbtn']))
{
	header("location:register.php");   /*--passing error to URL*/
			exit();
}
include_once("footer.php");
?>