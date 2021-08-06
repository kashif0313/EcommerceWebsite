<?php 
include_once("connectdb.php");

?>

<?php
$Username=$_SESSION['OrderUser'];
$Date = date("Y-m-d");
$Name=$Username;
$Email=$_SESSION['loginemail1'];
require 'email/PHPMailerAutoload.php';
$mail= new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';

$mail->Username='exampleSender@gmail.com';//sender Email here
$mail->Password='password';//password here

$Distotal=0;
		$dilivery=0;
		$Gtotal=0;
		$discounted = 0;
		
$mail->setFrom('website');
$mail->addAddress($Email);
$mail->addReplyTo('noreply@gmail.com');

$mail->isHTML(true);
$mail->Subject=('Order Recipt');
$Message = '<html><body>';
$Message .= "Hi $Username<br><h3>Thank You For Shopping</h3><br>
<table >
<h4>Here is what you have ordered</h4>
Bill to : $Username <br>
Order Date : $Date<br>
<tr>
<td style='border-bottom:1px solid black' width='20%' >Products </td>
<td style='border-bottom:1px solid black' width='20%' >Quantity</td>
<td style='border-bottom:1px solid black' width='20%' >Size</td>
<td style='border-bottom:1px solid black' width='20%' >Price</td>
<td style='border-bottom:1px solid black' width='15%' >Discounted Price</td>
</tr><tr>";
if(isset($_SESSION['loginname1']))
{
	$Username1=$_SESSION['loginname1'];
}
else
{
	$Username1="Guest";
}

$items = array();
$totalPrice = 0;
$sql = "SELECT * FROM  cart WHERE name='$Username1'";
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
$Message.="<tr><td>Grand Total </td><td></td><td></td><td></td><td style='border-bottom:1px solid black' width='15%' >Rs. $Gtotal   </td></tr>";
$Message.= "</tr></table></body></html>";

$mail->Body=$Message;

if(!$mail->send())
{
	echo"<p class='errormsg'>Send Success</p>";	
	
}
else
{
	echo"<p class='errormsg'>Send success</p>";	
}

?>

