<?php
include_once("header.php");
include_once("connectdb.php");
?>
<html>
<head>
<link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
<form  method="POST">
<div class="register_box">
<p class="titleLogin">Register</p>
<div class="inputfields">
<input class="Rinputarea" name="username" type="name"placeholder="Name"><input class="Rinputarea" name="lastname" type="name"placeholder="Last Name">
<input class="Rinputarea" name="UserEmail" type="email"  placeholder="Email" >
<input class="Rinputarea" name="AGE" type="number"  placeholder="Age" >
<input class="Rinputarea" name="Passkey" type="password" placeholder="Password">
<input class="Rinputarea" name="Rpassword" type="password" placeholder="Retype Password">

<div class="Radioarea">
Gender
<input class="Radiobtn"type="radio"name="gender" value="Male">Male
<input class="Radiobtn"type="radio"name="gender"value="Female">Female
</div>
<input class="Rinputarea" placeholder="Address" name="Homeadress"></div>
<div class="Rbuttonscontainer">
<button class="login_signup" name="Loginbtn"  onclick="login()">LogIn</button>
<button class="login_signup" name="Registerbtn" >SignUP</button></div>
</form>
<?php 
	if(isset($_GET['emptyfields']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>Field / Fields empty</div>
</div>
<div class='overlay' id='OverlayID'></div> ";	
	}if(isset($_GET['EmailExist']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>Email aleready registered</div>
</div>
<div class='overlay' id='OverlayID'></div> ";	
	}if(isset($_GET['passwordmismatch']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>Password not Matched</div>
</div>
<div class='overlay' id='OverlayID'></div> ";	
	}
	if(isset($_GET['UsernameExist']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>Username already Exist</div>
</div>
<div class='overlay' id='OverlayID'></div> ";	
	}
	if(isset($_GET['success']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>Sucessfully registered</div>
</div>
<div class='overlay' id='OverlayID'></div> ";	
	}
?>
</div>

</div>

<script  src="signuplogin.js"></script>
</body>
</html>
<?php
if (isset($_POST['closePopupBtn']))
{
	header("location:register.php");
}
if(isset($_POST['Registerbtn']))
{
$Name = $_POST['username'];
$LName = $_POST['lastname'];
$Email = $_POST['UserEmail'];
$Address = $_POST['Homeadress'];
$Password = $_POST['Passkey'];
$RepeatPassword = $_POST['Rpassword'];
$Gender = $_POST['gender'];
$Age = $_POST['AGE'];

  /*--check for any empty fields inside register form before submitting to database*/
  
if(empty($Name) || empty($Email) || empty($Address) || empty($Password)|| empty($RepeatPassword)|| empty($Gender))
{
	header("location:register.php?emptyfields&username=");
		exit();
}

/*--check that password and retypassword matches  before submitting to database*/

if($Password !== $RepeatPassword)
{
	header("location:register.php?passwordmismatch&username=");
		exit();
}

else
	
{			/*--check that username entered already exists inside  database*/

		$useravalibility = "SELECT name FROM weblogin WHERE name='$Name';";
			 $result = mysqli_query($connectdb,$useravalibility);
			if($row = mysqli_fetch_assoc($result))
		{
				header("location:register.php?UsernameExist");
			exit();
		}
		
		
		/*--check that email entered already exists inside  database*/
		
		$useravalibility = "SELECT email FROM weblogin WHERE email='$Email';";
			 $result = mysqli_query($connectdb,$useravalibility);
			if($row = mysqli_fetch_assoc($result))
		{
				header("location:register.php?EmailExist");
				exit();
		}
		else
		{
			/*--passing data to database*/
			
			//$Password = md5($Password);
			$sql="INSERT INTO weblogin(name,lastname,gender,email,age,password,address) VALUES('$Name','$LName','$Gender','$Email','$Age','$Password','$Address')";
			mysqli_query($connectdb,$sql);
			?>
<script>window.location.replace("register.php?success");</script>;
<?php
		
}
}
/*check for login button press*/

if(isset($_POST['Loginbtn']))
{header("location:Login.php");
			exit();}
include_once("footer.php");
?>