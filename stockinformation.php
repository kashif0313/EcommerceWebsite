<?php 
include_once("connectdb.php");
?>

<?php
$Username=$_SESSION['OrderUser'];
$Date = date("Y-m-d");
$Name=$Username;
$Email=$_SESSION['loginemail'];

$mail= new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';

$mail->Username='exampleSender@gmail.com';//sender Email here
$mail->Password='Kashif)#13';//password here

$mail->setFrom('website');
$mail->addAddress('example@gmail.com');//Emailhere
$mail->addReplyTo('noreply@gmail.com');

$mail->isHTML(true);
$mail->Subject=('Order Recipt');
$Message = '<html><body>';
$Message .= "Hi admin<br>
<table >
<h4>following are the stock getting low </h4>
<tr>
<td style='border-bottom:1px solid black' width='20%' >Products </td>
<td style='border-bottom:1px solid black' width='20%' >Sm Quantity </td>
<td style='border-bottom:1px solid black' width='20%' >Me Quantity </td>
<td style='border-bottom:1px solid black' width='20%' >La Quantity </td>
</tr><tr>";
if(isset($_SESSION['loginname']))
{
	$Username1=$_SESSION['loginname'];
}
else
{
	$Username1="Guest";
}

$items = array();
$totalPrice = 0;
$sql = "SELECT * FROM  products WHERE sizelarge<10 AND sizemedium<10 AND sizesmall<10";
		$result1 = mysqli_query($connectdb,$sql);
		while($row1 = mysqli_fetch_array($result1))
		{		
				
				$Pname= $row1['product'];
				$SSize = $row1['sizesmall'];
				$MSize = $row1['sizemedium'];
				$LSize = $row1['sizelarge'];
				$Message.="<tr><td style='border-bottom:1px solid black' width='15%' >$Pname</td>";
				$Message.="<td style='border-bottom:1px solid black' width='15%' >$SSize</td>";
				$Message.="<td style='border-bottom:1px solid black' width='15%' >$MSize</td>";
				$Message.="<td style='border-bottom:1px solid black' width='15%' >$LSize</td></tr>";
				}

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

