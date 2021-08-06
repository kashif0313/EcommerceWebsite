<?php 
include_once("connectdb.php");
session_start();
?><html>
<head>
<link rel="stylesheet" href="cart.css">
</head>
<body>
<div class='conformOrder'>
<form method="POST">
<button  class='Dilivery_Info_btn '>X </button>
<div class='orderinfo'>
<span class='total_title'>Order</span><hr>
<div class='Product_container1'>
<?php 
if(isset($_SESSION['loginname']))
	{
		$User=$_SESSION['loginname'];
		$Username=$_SESSION['loginname'];	
	}
	else if(isset($_SESSION['loginname1']))
	{
		$User=$_SESSION['loginname1'];
		$Username=$_SESSION['loginname1'];	
		
	}
$itemNum = 1;
$sql = "SELECT * FROM  cart WHERE name='$Username'";
		$result = mysqli_query($connectdb,$sql);
		$productnum = mysqli_num_rows($result);
		while($row = mysqli_fetch_assoc($result))
			{
				$Proname= $row['product'];
				$custQuantity= $row['quantity'];
				$size = $row['size'];
				
		$sql1 = "SELECT * FROM  products WHERE product='$Proname'";
		$result1 = mysqli_query($connectdb,$sql1);
		while($row1 = mysqli_fetch_array($result1))
		{		
				$pro_id = $row1['id'];
				$Pname= $row1['product'];
				$Bname= $row1['brand'];
				$Price= $row1['price'];
				$imag1= $row1['img1'];
				$COD = $row1['cash'];
				$Discount = $row1['disc'];
				$SSize = $row1['sizesmall'];
				$MSize = $row1['sizemedium'];
				$LSize = $row1['sizelarge'];
				$quantityPrice = $Price * $custQuantity ;
				$totalDiscount= (($Discount * $quantityPrice)/100);
				$discounted = $quantityPrice - $totalDiscount;
				
				echo"<div class='product_info_container1'>
				
				<div class='productInfo'>
				<input class='Product_No'value='$itemNum#'readonly>
				<span class='Product_input1'>$Proname</span>
				<span class='Product_input1'>Price : $Price</span>
				<span class='Product_input1'>Size : $size</span>
				<span class='Product_input1'>Quantity :$custQuantity</span>
				
				</div></div>
				";
				$itemNum++;
			}}

?>
</div></div>
<div class="info_payment_dilivery">
<div class="diliveryInfo">
<span class='total_title'>Payment info</span><hr>
<?php
echo"
		<table>
		<tr><td>
		<span class='Dilivery_input'readonly>Total Price</span></td><td>
		<input class='dilivery_info' value='Rs.$Distotal'readonly></td>
		</tr>
		<tr><td>
		<span class='Dilivery_input'readonly>COD charges</span></td><td>
		<input class='dilivery_info' value='Rs.$dilivery'readonly></td>
		</tr>
		<tr><td>
		<span class='Dilivery_input'readonly>Grand Total</span></td><td>
		<input class='dilivery_info' value='Rs.$Gtotal'readonly></td>
		</tr></table>"
?>

</div>
<div class="diliveryInfo">
<span class='total_title'>Dilivery info</span><hr>
<?php
if(isset($_SESSION['loginname']))
	{
		$sql = "SELECT * FROM  weblogin WHERE name='$Username'";
	}
	else if(isset($_SESSION['loginname1']))
	{
		$sql = "SELECT * FROM  guestlogin WHERE name='$Username'";
		
	}

		$result = mysqli_query($connectdb,$sql);
		if($row = mysqli_fetch_array($result))
		{
			$Email = $row['email'];
			$Address = $row['address'];
		}
		echo"
		<table>
		<tr><td>
		<span class='Dilivery_input'>Name</span></td><td>
		<input class='dilivery_info' name='GuestName' value='$Username'readonly></td>
		<tr><td>
		<span class='Dilivery_input'>Email</span></td><td>
		<input class='dilivery_info'name='GuestEmail' value='$Email'readonly></td>
		<tr><td>
		<span class='Dilivery_input'>Payment Method</span></td><td>
		<input class='dilivery_info' value='COD'></td>
		<tr><td>
		<span class='Dilivery_input'>Address to dilver on</span>
		</td><td>
		<textarea class='dilivery_info1'name='GuestAdd' readonly>$Address</textarea></td>
		</tr>
		</table>
		<button name='Dilivery_Info_btn' class='OrderBtn'>Edit dilivery info</button>
		<button name='OrderBtn' class='OrderBtn'>Order Now</button>
		";
?>
</div>
</div>
</form></div>
<div class='overlay' id='OverlayID'></div>
</body></html>