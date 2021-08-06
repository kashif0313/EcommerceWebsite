<?php
include_once("header.php");
include_once("connectdb.php");
if(isset($_SESSION['CurrentProduct'])) 
{
    unset($_SESSION['CurrentProduct']);
}
?>
<html>
<head>
<link rel="stylesheet" href="cart.css">
</head>
<body>
<div class="cart_full_container">
<div class="cart_container">
<form method="POST">
<div class="Remove_container">
<button class="EmptyCart" name="RemoveCart">Remove all</button></div>
<div class="Cart_product_container">

<?php 
$User = "";
$Username = "";
$DiliveryUserID="";
$Distotal=0;
		$dilivery=0;
		$Gtotal=0;
		$discounted =0;
		$disCoupon=0;
	if(isset($_SESSION['loginname']))
	{
		$User=$_SESSION['loginname'];
		$Username=$_SESSION['loginname'];
$DiliveryUserID = $_SESSION['loginID'];		
	}
	else if(isset($_SESSION['loginname1']))
	{
		$User=$_SESSION['loginname1'];
		$Username=$_SESSION['loginname1'];	
		
	}
	
		
		$sql = "SELECT * FROM  cart WHERE name='$Username'";
		$result = mysqli_query($connectdb,$sql);
	if (mysqli_num_rows($result)==0)
	{
		echo"nothin in cart..";
	}	
		if (mysqli_num_rows($result)!=0)
		{echo" results found";
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
				
				?>
				
			<?php
echo"
<div class='orderListContainer'>					
<div class='Product_container'>
	<div class='product_img'>
		<img class='imgProduct' src='$imag1' >
	</div>
	<div class='Product_inform'>
		<input class='Product_input'value='$Proname'readonly>
		<input class='Product_input'value='Price : Rs.$Price'readonly><br>
		<input class='Product_input'value='Discount : $Discount%'readonly>
		<input class='Product_input'value='Dilivery charges :Rs.$COD'readonly>
		<input class='Product_input_total'value='Total : Rs.$discounted'readonly>
		<input class='Product_input_total'value='Size : $size 'readonly>
	</div>
	<div class='Product_inform_values'>
	<span class='Product_input_quantity' Quantity</span><br>
	
	<a class='edit_product' href='cart.php?add_product_quantity=$pro_id'>+</a>
	<input class='Product_input_quantity'value='$custQuantity' readonly>
	<a class='edit_product' href='cart.php?sub_product_quantity=$pro_id'>-</a><br>
	
	</div></div>
	<a class='Remove_product' href='cart.php?edit_product=$pro_id'>Remove</a>
</div>
					";
					
	
$Distotal = $Distotal + $discounted;
$dilivery = $dilivery + $COD;
$Gtotal =  $Distotal + $dilivery;

if(isset($_POST['OrderBtn1']))
{
	$sql11="UPDATE guestlogin SET TotalPay='$Gtotal' WHERE name='$User'";
	mysqli_query($connectdb,$sql11);
 include("Guestcart.php");
}
if(isset($_POST['Dilivery_Info_btn']))
{
	header("location:profile.php");
	exit();
}
if(isset($_POST['OrderBtn']))
	{
		$DiliveryEmail = $_SESSION['loginemail1'];
		$DiliveryAddress=$_SESSION['address'];
	if(isset($_SESSION['loginname']))
	{
		$Diliveryname=$_SESSION['loginname'];
		$DiliveryUserID = $_SESSION['loginID'] ;		
	}
	else if(isset($_SESSION['loginname1']))
	{
		$Diliveryname=$_SESSION['loginname1'];
		$DiliveryUserID = $_SESSION['loginID1'] ;
	}
		


$OrderDate = date('y-m-d h:i:s');
echo"$OrderDate";
		$sql="INSERT INTO dilivery(userID,name,email,address,product,quantity,size,payment,date) VALUES('$DiliveryUserID','$Diliveryname','$DiliveryEmail','$DiliveryAddress','$Pname','$custQuantity','$size','$Gtotal','$OrderDate')";
				mysqli_query($connectdb,$sql);
				
				
		header("location:cart.php?CustorderSend");
$SmallSize = "";
$MediumSize = "";
$LargeSize = "";
		if($size=='Small')
		{ $SmallSize =$SSize-$custQuantity; }
	else
	{$SmallSize=$SSize;}
	if($size=='Medium')
		{ $MediumSize =$MSize-$custQuantity; }
	else
	{ $MediumSize=$MSize;}
	if($size=='Large')
		{ $LargeSize =$LSize-$custQuantity; }
	else
	{ $LargeSize=$LSize;}
	$sql="UPDATE products SET sizesmall='$SmallSize',sizemedium='$MediumSize',sizelarge='$LargeSize' WHERE product='$Proname'";
	mysqli_query($connectdb,$sql);
		}
		
	

if(isset($_POST['CouponBtn']))
{
	$DicsountCode =$_POST['DisCode'];
		$sql1 = "SELECT * FROM  verification";
		$result1 = mysqli_query($connectdb,$sql1);
		if($row1 = mysqli_fetch_assoc($result1))
		{
			$code = $row1['Coupon'];
			$coDis = $row1['discount'];
		}
		if($DicsountCode==$code)
		{
			$sql="UPDATE weblogin set CouponDiscount='$coDis'";
			mysqli_query($connectdb,$sql);
			$temp1 = $Gtotal*$coDis;
			$temp2=$temp1/100;
			$Gtotal = $Gtotal -$temp2;
			echo"temp1 = $temp1";
			echo"<br>temp2 = $temp2 ";
			//header("location:cart.php?AddedCoupon");
		}
		else if($DicsountCode!=$code)
		{
			header("location:cart.php?WrongCoupon");
			exit();
		}
}


}
		
if(isset($_GET['edit_product']))
{
	$edit_id = $_GET['edit_product'];
	
	$sql = "DELETE  FROM  cart WHERE productID='$edit_id'";
	mysqli_query($connectdb,$sql);
	header("location:cart.php?productDeleted");
	exit();
}	
	
if(isset($_GET['add_product_quantity']))
{
	$edit_id = $_GET['add_product_quantity'];
	$custQuantity = $custQuantity+1;
	$sql11="UPDATE cart SET quantity='$custQuantity' WHERE productID='$edit_id'";
	mysqli_query($connectdb,$sql11);
	header("location:cart.php?added quantity");
	exit();
}
if(isset($_GET['sub_product_quantity']))
{
	$edit_id = $_GET['sub_product_quantity'];
	$custQuantity = $custQuantity-1;
	if($custQuantity<1)
	{
		$custQuantity=1;
	}
	$sql1="UPDATE cart SET quantity='$custQuantity' WHERE productID='$edit_id'";
	mysqli_query($connectdb,$sql1);
	header("location:cart.php?added quantity");
	exit();
}		
		}?>
		</div>	
		<?php
		}
		else
		{$dilivery=0;}
?>
<?php
echo"<div class='order_complete'>
<span class='total_title'>Order Summary</span><hr>
<p class='total_title'>Total Price<input class='total_input' value='Rs.$Distotal'readonly></p>
<p class='total_title'>COD charges<input class='total_input' value='Rs.$dilivery' readonly></p><hr>
<p class='total_title'>Grand Total <input class='total_input' value='Rs.$Gtotal'readonly></p><hr>
<input class='total_title'placeholder='Coupon' name='DisCode'><br><br>";
	echo"
	<button name='CouponBtn' class='OrderBtn'>Add Coupon</button>   <button name='OrderBtn1' class='OrderBtn'>Order Now</button></div>";
?>
<?php 

if(isset($_POST['RemoveCart']))
{
	$sql1 = "DELETE FROM  cart WHERE name='$User'";
	mysqli_query($connectdb,$sql1);
	header("location:cart.php?Removed");
	exit();
}
if(isset($_GET['orderSend']))
	{echo"<p class='errormsg'>Ordered successfully</p>";
$sql="UPDATE weblogin set CouponDiscount='0'";
			mysqli_query($connectdb,$sql);
$sql="UPDATE weblogin set TotalPay='0'";
			mysqli_query($connectdb,$sql);	}
if(isset($_GET['CustorderSend']))
	{
		include("email.php");	
	    include("adminrecipt.php");
$sql1 = "DELETE FROM  cart WHERE name='$User'";
	mysqli_query($connectdb,$sql1);
		header("location:cart.php?orderemailSend");
		exit();
	} ?>
	</form>
</div>
</div>
</body></html>