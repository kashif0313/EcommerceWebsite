<?php 
include_once("connectdb.php");
session_start();
if(isset($_GET['value'])) 
{
    $Pname = $_GET['value'];
}
?>
<html>
<head>
<link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
<form  method="POST">
<div class="register_box">
<p class="titleLogin">Dilivery Information</p>
<div class="inputfields">
<input class="Rinputarea" name="username1" type="name"placeholder="Name"><input class="Rinputarea" name="lastname" type="name"placeholder="Last Name">
<input class="Rinputarea" name="UserEmail" type="email"  placeholder="Email" >
<input class="Rinputarea" name="AGE" type="number"  placeholder="Age" >
<div class="Radioarea">
Gender
<input class="Radiobtn"type="radio"name="gender" value="Male">Male
<input class="Radiobtn"type="radio"name="gender"value="Female">Female
</div>
<input class="Rinputarea" placeholder="Address" name="Homeadress"></div>
<div class="Rbuttonscontainer">
<button class="login_signup" name="OrderBtn1" >Confirm Information</button>
</form>

<script  src="signuplogin.js"></script>
</body>
</html>
<?php  
if (isset($_POST['closePopupBtn']))
{
	header("location:checkout.php?value=$Pname"); 
	exit();
}
if(isset($_GET['emptyfields']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button><br>
		
<div class='errormsg1'>Fields Empty</div>
</div>
<div class='overlay' id='OverlayID'></div>"	;
	}

if(isset($_POST['OrderBtn1']))
	{
$Name = $_POST['username1'];
$LName = $_POST['lastname'];
$Email = $_POST['UserEmail'];
$Address = $_POST['Homeadress'];
$Gender = $_POST['gender'];
$Age = $_POST['AGE'];

  /*--check for any empty fields inside register form before submitting to database*/
 
if(empty($Name) ||empty($LName) || empty($Email) || empty($Address) || empty($Gender)|| empty($Age))
{
	header("location:checkout.php?emptyfields&value=$Pname");
		exit();
}
else
{
		$_SESSION['loginemail1']= $Email ;
		$_SESSION['loginname1']= $Name;
		$_SESSION['address'] = $Address;	
		
		$sql="INSERT INTO guestlogin(name,lastname,gender,email,age,address) VALUES('$Name','$LName','$Gender','$Email','$Age','$Address')";
			mysqli_query($connectdb,$sql);
			header("Location: productdisplay.php?value=$Pname");
			exit();
			$sql1 ="SELECT * from guestlogin Where email='$Email'"; 
			$result = mysqli_query($connectdb,$sql1);
			if($row=mysqli_fetch_array($result))
			{
				$UserID = $row['id'];
			}
			$_SESSION['loginID1']= $UserID ;
			}	
}
?>