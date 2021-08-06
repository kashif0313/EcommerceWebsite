<?php
include_once("header.php");
include_once("connectdb.php");
?>
<html>
<head>
<link rel="stylesheet" href="cart.css">
</head>
<body>
<div class="cart_container">
<form method="POST">
<?php if(isset($_SESSION['Adminpage']))
	{
	
		$sql1 = "SELECT * FROM  products";
		$result1 = mysqli_query($connectdb,$sql1);
		while($row1 = mysqli_fetch_array($result1))
		{		
				$pro_id = $row1['id'];
				$Pname= $row1['product'];
				$Bname= $row1['brand'];
				$Price= $row1['price'];
				$imag1= $row1['img1'];
				$imag2= $row1['img2'];
				$imag3= $row1['img3'];
				$Discount = $row1['disc'];
				$Gender = $row1['gender'];
				$SSize = $row1['sizesmall'];
				$MSize = $row1['sizemedium'];
				$LSize = $row1['sizelarge'];
				$COD = $row1['cash'];

	$DiscountValue=$Discount;

if($Gender == 0)
{$Gendervalue='Male';}
if($Gender == 1)
{$Gendervalue='Female';}
if($Gender == 11)
{$Gendervalue='Kid';}
if($SSize == "no")
{
	$SmSize=0;
}
else
{$SmSize=$SSize;}
if($MSize =="no")
{
	$MeSize=0;
}
else
{$MeSize=$MSize;}
if($LSize == "no")
{
	$LaSize=0;
}
else
{$LaSize=$LSize;}

				echo"<div class='StockDivCont'><div class='StockDiv'>
					<img class='imageStock' src='$imag1'>
					<div class='stockDiscContainer'>
					<div class='StockDisc'>Name:$Pname</div>
					<div class='StockDisc'>Price:$Price</div>
					<div class='StockDisc'>S:$SSize||M:$MSize||L:$LSize </div>
					<div class='StockDisc'><a href='editproduct.php?product=$pro_id'>Edit</a></div>
					<div class='StockDisc'><a href='stock.php?remove_product=$pro_id&img1=$imag1&img2=$imag2&img3=$imag3'>Delete</a></div>
				</div></div></div>
				";
		}
		}
if(isset($_GET['remove_product']))
{	$edit_id = $_GET['remove_product'];
$img_id1 = $_GET['img1'];
$img_id2 = $_GET['img2'];
$img_id3 = $_GET['img3'];
unlink($img_id1);
unlink($img_id2);
unlink($img_id3);
	$sql1 = "DELETE FROM  products WHERE id='$edit_id'";
	mysqli_query($connectdb,$sql1);
	header("location:stock.php?productdeleted");
	exit();
}?>
</form>
</div>
</body>
</html>