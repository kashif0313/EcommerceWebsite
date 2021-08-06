<?php
include_once("header.php");
include_once("connectdb.php");
?>

<html>
<head>
<link rel="stylesheet" href="index.css">
<script type="text/javascript" src="index.js"></script>
</head>
<body>
<div class="container">
<form method="POST">
<div class="coupon_code_container">
<p class="CouponCode">Previous Code</p>
<?php
$code="";
$coDis="";
$sql1 = "SELECT * FROM  verification";
		$result1 = mysqli_query($connectdb,$sql1);
		while($row1 = mysqli_fetch_array($result1))
		{
			$code = $row1['Coupon'];
			$coDis = $row1['discount'];
		}
		if($coDis=="" && $code=="")
		{
			echo"<p class='CouponCode'>no Previous Code</p>";
		}
		else{
			echo"<input class='discount1' name='DisCode' value='$code'>";
			echo"<input class='discount1' name='DisCode' value='$coDis'>";
		}
?><br>
<p class="CouponCode">Enter New / Change Code</p>
<input class="discount1" name="DisCode" placeholder="Coupon">
<input class="discount1" name="Dis" placeholder="Discount">
<button name="addDis"> add coupon Discount </button>
</form>
</div></div>
</body>
</html>
<?php 
if(isset($_POST['addDis']))
{
$DiscountCode = $_POST['DisCode'];
$Discount = $_POST['Dis'];
$sql="Update  verification set Coupon='$DiscountCode' , discount='$Discount'";
			mysqli_query($connectdb,$sql);
			header("location:Coupon.php?success");
			exit();
}
?>
</div>
</div>
</body>
</html>