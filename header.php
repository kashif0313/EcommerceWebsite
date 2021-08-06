<?php
session_start();
include_once("connectdb.php");
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="header.css" media="print" onload="this.media='all'">

</head>
<body>
<div class="header_container" >
<form method="POST">
<img class="Header_img" src="Logo.png">
</form>

<div class="Header" >
<a href="index.php" class="weblinks">Home</a>	
<a href="allproducts.php"class="weblinks">Products</a>
<a href="cart.php"class="cart">Cart</a>
</div>
<?php
if(isset($_SESSION['Adminpage']))
		{
			echo'<br><a href="addproduct.php"class="weblinks">Add Product</a>';
			echo'<a href="stock.php"class="weblinks">Stock</a>';echo'<a href="Coupon.php"class="weblinks">Add Coupon Discount</a>';
			echo'<a href="Dilivery.php"class="weblinks">Dilivery</a>';		
		}
if(isset($_SESSION['Adminpage']))
{
					//echo("you are logged inn!!!");
					echo'
	<button class="Profile_container" onclick="viewProfile()">
		A<div class="Profile" id="openProfile">
		
			<a class="profile_content" href="logout.php" id="logoutButton">Log Out</a>
		</div>
	</button>
	';
}
else if(isset($_SESSION['loginname']))
	{
		$name=$_SESSION['loginname'];
		$chare = substr($name,0,1);
		$char=strtoupper($chare);
		//echo("you are logged inn!!!");
					echo"
	
	<button class='Profile_container' onclick='viewProfile()'>$char
		<div class='Profile' id='openProfile'>
		<input class='Welcomename'value='Welcome $name' readonly>
		<a href='profile.php'class='profile_content'>Profile</a>
		<a href='Myorders.php'class='profile_content'> My Orders</a>
			<a class='profile_content' href='logout.php' id='logoutButton'>Log Out</a>
		</div>
	</button>
	";
	}
	 else
	{
					//echo("you are not logged inn!!!");
	echo'
	<div class="loginregistercontainer">
	<button class="loginBtn"onclick="login()" id="loginBtn">Login</button></div>';
	}
?>
<div class="Header_mob" >
<a href="index.php" class="weblinks">Home</a>	
<a href="allproducts.php"class="weblinks">Products</a>
<a href="cart.php"class="cart">Cart</a>
<button class="headerBtnopen" id="open_btn" onclick="open_header()">|||</button>
<div class="header_mob_container" id="mob_header">
<?php
if(isset($_SESSION['Adminpage']))
		{
			echo'<br><a href="addproduct.php"class="weblinks weblinks1">Add Product</a>';
			echo'<a href="stock.php"class="weblinks weblinks1">Stock</a>';echo'<a href="Coupon.php"class="weblinks weblinks1">Add Coupon Discount</a>';
			echo'<a href="Dilivery.php"class="weblinks weblinks1">Dilivery</a>';		
		}
		else if(isset($_SESSION['loginname']))
	{}
else
	{
					//echo("you are not logged inn!!!");background:rgba(100,100,100,0.1);
	echo'
	<div class="loginregistercontainer1">
	<button class="loginBtn"onclick="login()" id="loginBtn">Login</button></div><br><br>';
	}
if(isset($_SESSION['Adminpage']))
{
					//echo("you are logged inn!!!");
					echo'
	<br><button class="Profile_container_mob" onclick="viewProfile()">
		A<div class="Profile" id="openProfile">
		</div>
	</button><br>
	<a class="loginBtn" href="logout.php" id="logoutButton">Log Out</a>
	';
}
else if(isset($_SESSION['loginname']))
	{
		$name=$_SESSION['loginname'];
		$chare = substr($name,0,1);
		$char=strtoupper($chare);
		//echo("you are logged inn!!!");
					echo"
	<form method='POST'>
	<button class='Profile_container_mob' >$char </button><input class='Welcomename'value='Welcome $name' readonly><hr>
	
		
		</form><a href='profile.php'class='profile_content'> My Profile</a><a href='Myorders.php'class='profile_content'> My Orders</a>
		<a class='profile_content' href='logout.php' id='logoutButton'>Log Out</a>	
	";
	}
	 else
	{
					//echo("you are not logged inn!!!");
	echo'
	<div class="loginregistercontainer">
	<button class="loginBtn"onclick="login()" id="loginBtn">Login</button></div>';
	}	
?>
<button class="loginBtn"  onclick="close_header()">Close</button><br>
<img class="Header_img_mob" src="Logo.png">
</div>
</div>
</div>
<script type="text/javascript" src="loginregister.js"></script>
</body>
</html> 	