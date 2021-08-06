<?php 
include_once("connectdb.php");
?>

<?php
if(isset($_SESSION['loginname']))
	{
		$User=$_SESSION['loginname'];
		$Username1=$_SESSION['loginname'];
		$Email1 = $_SESSION['loginemail1'] ;			
	}
	else if(isset($_SESSION['loginname1']))
	{
		$User=$_SESSION['loginname1'];
		$Username1=$_SESSION['loginname1'];
		$Email1 = $_SESSION['loginemail1'] ;
		 	
		
	}
$Date = date("Y-m-d");
$Name=$Username1;
$Email=$Email1;
require 'email/PHPMailerAutoload.php';
$mail= new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';

$mail->Username='exampleSender@gmail.com';//sender Email here
$mail->Password='password';//password here
$mail->setFrom('website');
$mail->addAddress($Email);
$mail->addReplyTo('noreply@gmail.com');
$mail->isHTML(true);
$mail->Subject=('Order Recipt');
$Message = '<html><body>';
$Message .= "Hi $Username1<br><h3>Thank You For Shopping</h3><br>
<table >
<h4>Here is what you have ordered</h4>
Bill to : $Username1 <br>
Order Date : $Date<br>
<tr>
<td style='border-bottom:1px solid black' width='20%' >Products </td>
<td style='border-bottom:1px solid black' width='20%' >Quantity</td>
<td style='border-bottom:1px solid black' width='20%' >Size</td>
<td style='border-bottom:1px solid black' width='20%' >Price</td>
<td style='border-bottom:1px solid black' width='15%' >Discounted Price</td>
</tr><tr>";

$Distotal=0;
		$dilivery=0;
		$Gtotal=0;
		$discounted = 0;
$totalPrice = 0;
	if(isset($_SESSION['loginname']))
	{
		$sql = "SELECT * FROM  weblogin WHERE name='$Username1'";
	}
	else if(isset($_SESSION['loginname1']))
	{
		$sql = "SELECT * FROM  guestlogin WHERE name='$Username1'";
		
	}

	$result = mysqli_query($connectdb,$sql);
	if($row = mysqli_fetch_assoc($result))
	{
		$Coupon = $row['CouponDiscount'];		
	}
$sql = "SELECT * FROM  cart WHERE name='$Username'";
		$result = mysqli_query($connectdb,$sql);
		 $Myrow = mysqli_num_rows($result); 
		while($row = mysqli_fetch_assoc($result))
			{
				$Proname= $row['product'];
				$custQuantity= $row['quantity'];
				$size = $row['size'];
		$sql1 = "SELECT * FROM  products WHERE product='$Proname'";
		$result1 = mysqli_query($connectdb,$sql1);
		while($row1 = mysqli_fetch_array($result1))
		{		
				
				$Pname= $row1['product'];
				$Price= $row1['price'];
				$COD = $row1['cash'];
				$Discount = $row1['disc'];
				$totalPrice = $totalPrice + $Price;
				$quantityPrice = $Price * $custQuantity ;
				$totalDiscount= (($Discount * $quantityPrice)/100);
				$discounted = $quantityPrice - $totalDiscount;
				$Message.="<tr><td style='border-bottom:1px solid black' width='15%' >$Pname</td>";
				$Message.="<td style='border-bottom:1px solid black' width='15%' > $custQuantity </td>";$Message.="<td style='border-bottom:1px solid black' width='15%' > $size </td>";
				$Message.="<td style='border-bottom:1px solid black' width='15%' >  $Price  </td>";
				$Message.="<td style='border-bottom:1px solid black' width='15%' >  $discounted  </td></tr>";
				
				
$Distotal = $Distotal + $discounted;
$dilivery = $dilivery + $COD;
$Gtotal =  $Distotal + $dilivery;}}

$Message.="<tr><td>Total Price</td><td></td><td></td><td></td><td style='border-bottom:1px solid black' width='15%' > Rs.  $Distotal  </td></tr>";
$Message.="<tr><td>Dilivery charges</td><td></td><td></td><td></td><td style='border-bottom:1px solid black' width='15%' >  Rs. $dilivery  </td></tr>";
$Message.="<tr><td>Grand Total </td><td></td><td></td><td></td><td style='border-bottom:1px solid black' width='15%' >Rs. $Gtotal </td></tr>";
if($Coupon > 1)
{
	$temp1 = $Gtotal*$Coupon;
			$temp2=$temp1/100;
			$CouponPay = $Gtotal -$temp2;
	$Message.="<tr><td>Coupon Discount </td><td></td><td></td><td></td><td style='border-bottom:1px solid black' width='15%' > $Coupon %   </td></tr>";
	$Message.="<tr><td>Total Payable </td><td></td><td></td><td></td><td style='border-bottom:1px solid black' width='15%' > Rs. $CouponPay </td></tr>";
}
$Message.= "</tr></table></body></html>";

$mail->Body=$Message;

if(!$mail->send())
{
	echo"<p class='errormsg'>Send unsuccess</p>";	
}
else
{
	echo"<p class='errormsg'>Send user success</p>";	
}

?>

