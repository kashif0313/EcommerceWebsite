<?php 
session_start();
?>
<html>
<head>
<link rel="stylesheet" href="activator.css">
</head>
<body>
<div class="container">
<div class="activator_container">
<form method="post">
<span class="title"> Password Reset</span>
<p class="title1">Enter Email for Reset Password below </p>
<input class="code_input" placeholder="Enter Email" name="emailUser"/><br>
<button class="ActivateBtn" name="ActivateBtn">Reset</button>
<p class="note">Didn't get Reset Mail click <a href="emailActivation.php" >here </a>to send code again</p> 
</div>
</div>
</form>
</body>
</html>
<?php 
include_once("connectdb.php");
?>

<?php
if(isset($_POST['ActivateBtn']))
{		
$Date = date("Y-m-d");
$Email=$_POST['emailUser'];
$Username=$Email;
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
$Message .= "Hi<br><h3>Following is the code to activate your account </h3><br>
";
$Email=md5($Email);
$FinalCode = "http://localhost/php%20codings/ecommerce/resetlink.php?emailuser=$Email";//change to online link before uploading to hosting

$Message.="<br>Click this below link to change password of your account <br><a href='$FinalCode'>Link to resetPassword</a><br></body></html>";

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
<?php 
$_SESSION["emailuser"]=$Email;
$_SESSION["emailuserCode"]=$FinalCode;
header("location:login.php");
			exit();
}			
?>
