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
<div class="cart_container">
<form method="POST">
<?php 
if(isset($_SESSION['loginname']))
	{
		$User=$_SESSION['loginname'];
		$UserName=$_SESSION['loginname'];
		$UserMail = $_SESSION['loginemail1'];
		$no =1;
		$i=0;
	echo"<table class='stockTable'>
	<tr><th>Sr.</th><th>Order Date</th><th>Status</th><th>Order</th></tr>";
		$sql1 = "SELECT * FROM  dilivery WHERE name='$UserName' AND email='$UserMail' GROUP BY date";
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
				$Status = $row1['diliverstatus'];
				$proId = $row1['id'];
if($Status=='0')
{
	$stats = "Not Dilivered ";
}	
if($Status=='1')
{
	$stats = "Dilivered";
	
}
$sql2 = "SELECT * FROM  dilivery WHERE name='$Name'";
		$result2 = mysqli_query($connectdb,$sql2);
		$rowsnum = mysqli_num_rows($result2);
		
			echo"<tr><td>$no</td><td>$Date</td>
			<td>$stats</td><td><a href='Myorders.php?Ordername=$Name'>order</a></td></tr>";
			$no++;		
	
	}}
		?>
		</table>
		<?php
		if(isset($_GET['Ordername']))
		{
	
			$OrderName = $_GET['Ordername'];
			
			echo"<table class='stockTable'>
	<tr><th>Products</th><th>Size</th><th>Quantity</th><th>Payment</th><th>Status</th></tr>";
			$sql1 = "SELECT * FROM  dilivery WHERE name='$OrderName'";
		$result1 = mysqli_query($connectdb,$sql1);
		while($row1 = mysqli_fetch_array($result1))
		{		
				
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
					
			echo"<tr><td>$Products</td><td>$Size</td><td>$Quantity</td><td>Rs.$Payment</td><td>$stats</td>
			</tr>";
			
					
		}}
		?>
		
		
</table>
</form>
</div>
</body>
</html>
<?php 
include_once("footer.php")?>