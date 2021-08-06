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
		$no =1;
		$i=0;
		$Status=0;
	echo"<table class='stockTable'>
	<tr><th>Sr.</th><th>Name</th><th colspan=2>Email</th><th>Payment</th><th>Order</th><th>New Order</th><th>Status</th><th>Address</th></tr>";
		$sql1 = "SELECT * FROM  dilivery GROUP BY name ";
		$result1 = mysqli_query($connectdb,$sql1);
		while($row1 = mysqli_fetch_array($result1))
		{		
				
				$Name = $row1['name'];
				$Email= $row1['email'];
				$Address= $row1['address'];
				$Products= $row1['product'];
				$Size= $row1['size'];
				$Quantity = $row1['quantity'];
				$Payment = $row1['payment'];	
				$Status = $row1['diliverstatus'];			
if($Status=='0')
{
	$stats = "Not Dilivered ";
}	
if($Status=='1')
{
	$stats = "Dilivered";
	
}
$sql2 = "SELECT * FROM  dilivery WHERE name='$Name' AND diliverstatus='0' ";
		$result2 = mysqli_query($connectdb,$sql2);
		$rowsnum = mysqli_num_rows($result2);
		
			echo"<tr><td>$no</td>
			<td >$Name</td>
			<td colspan=2>$Email</td><td>$Payment</td><td><a href='Dilivery.php?value=$Name&no=$no'>order</a></td><td>$rowsnum</td><td>$stats</td><td>$Address</td></tr>";
			$no++;		
		}
		?>
		
		</table>
		<?php
		}
		if(isset($_GET['value']))
		{
			$OrderName = $_GET['value'];
			$no = $_GET['no'];
			echo"<table class='stockTable'>
	<tr><th colspan='3'>OrderNO $no <hr>Name:$OrderName<hr></th></tr><tr><th>Products</th><th>OrderDate</th><th>Size</th><th>Quantity</th></tr>";

	$sql1 = "SELECT * FROM  dilivery WHERE name='$OrderName' ";

		$result1 = mysqli_query($connectdb,$sql1);
		while($row1 = mysqli_fetch_array($result1))
		{		
				$Date = $row1['date'];
				$Name = $row1['name'];
				$Email= $row1['email'];
				$Address= $row1['address'];
				$Products= $row1['product'];
				$Size= $row1['size'];
				$Quantity = $row1['quantity'];
				$Payment = $row1['payment'];	
$Status = $row1['diliverstatus'];					
if($Status=='0')
{
	echo"<tr><td>$Products</td><td>$Date</td><td>$Size</td><td>$Quantity</td>
			<td><a href='Dilivery.php?productName=$Products&Name=$Name&size=$Size'>Diliver</a></td></tr>";
}	
if($Status=='1')
{
	echo"<tr><td>$Products</td><td>$Date</td><td>$Size</td><td>$Quantity</td>
			<td>Dilivered</td></tr>";
	
}
					
		}

}
?>

</table>
</form>
</div>
</body>
</html>
<?php 
if(isset($_GET['productName']))
{
	$ProdSize=$_GET['size'];
	$ProdId=$_GET['productName'];
	$NamePerson=$_GET['Name'];
	$sql1 = "UPDATE dilivery set diliverstatus='1' WHERE name='$NamePerson' AND product='$ProdId' AND size='$ProdSize'";
	mysqli_query($connectdb,$sql1);
	echo"dilivered";
	header("location:Dilivery.php?OrderDilivered");
	exit();
}
?>