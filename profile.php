<?php
include_once("header.php");
include_once("connectdb.php");
if(isset($_SESSION['CurrentProduct'])) 
{
    unset($_SESSION['CurrentProduct']);
}
?>
<?php
if(isset($_SESSION['loginname']))
	{
		$User=$_SESSION['loginname'];
		$UserName=$_SESSION['loginname'];
$sql = "SELECT * FROM  weblogin WHERE name='$UserName'";		
	}
	else if(isset($_SESSION['loginname1']))
	{
		$User=$_SESSION['loginname1'];
		$UserName=$_SESSION['loginname1'];	
		$sql = "SELECT * FROM  guestlogin WHERE name='$UserName'";
		
	}
		$result = mysqli_query($connectdb,$sql);
		if($row = mysqli_fetch_assoc($result))
		{ 	$Name = $row['name'];
			$LName = $row['lastname'];
			$Email = $row['email'];
			$Address = $row['address'];
			$Gender = $row['gender'];
			$Age = $row['age'];
			$id = $row['id'];
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
<p class="titleLogin">My Profile</p>
<div class="inputfields">
<input class="Rinputarea" name="username" type="name"placeholder="Name" value="<?php echo"$Name";?>"><input class="Rinputarea" name="lastname" type="name"placeholder="Last Name" value="<?php echo"$LName";?>">
<input class="Rinputarea" name="UserEmail" type="email"  placeholder="Email"  value="<?php echo"$Email";?>">
<input class="Rinputarea" name="AGE" type="number"  placeholder="Age" value="<?php echo"$Age";?>" >
<div class="Radioarea">
Gender
<?php
if($Gender=='Male')
		{
			echo"<input class='Radiobtn'type='radio'name='gender' value='Male' checked='checked'>Male
<input class='Radiobtn'type='radio'name='gender'value='Female'>Female";
	}
	if($Gender=='Female')
		{echo"<input class='Radiobtn'type='radio'name='gender' value='Male'>Male
<input class='Radiobtn'type='radio'name='gender'value='Female' checked='checked'>Female";}
	?>
</div>
<input class="Rinputarea" placeholder="Address" name="Homeadress" value="<?php echo"$Address";?>"></div>
<div class="Rbuttonscontainer">
<button class="login_signup" name="UploadItem"  onclick="login()">Update</button>
</form>
</div>

</div>
</body>
</html>
<?php

if(isset($_POST['UploadItem']))
{
$Name = $_POST['username'];
$LName = $_POST['lastname'];
$Email = $_POST['UserEmail'];
$Address = $_POST['Homeadress'];
$Gender = $_POST['gender'];
$Age = $_POST['AGE'];
	if(isset($_SESSION['loginname']))
	{
		$_SESSION['loginname'] = $Name;
		$id = $_SESSION['loginID'];
		$sql1="UPDATE weblogin SET name='$Name',lastname='$LName',gender='$Gender',address='$Address',email='$Email',age='$Age' WHERE id='$id'";
	}
	else if(isset($_SESSION['loginname1']))
	{
		$_SESSION['loginname1'] = $Name;
		$id = $_SESSION['loginID1'];
		$sql1="UPDATE guestlogin SET name='$Name',lastname='$LName',gender='$Gender',address='$Address',email='$Email',age='$Age' WHERE id='$id'";
		
		
	}
	mysqli_query($connectdb,$sql1);	
	header("location:profile.php?Updated");
	
	
$sql = "UPDATE cart SET name='$Name' WHERE userID='$id'";	
mysqli_query($connectdb,$sql);	
	exit();
	$_SESSION['loginname1'] = $Name;
	
}
?>