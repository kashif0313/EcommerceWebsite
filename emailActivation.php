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
<span class="title"> Account Activation</span>
<p class="title1">Enter Email for Activation  below </p>
<input class="code_input" placeholder="Enter Email" name="emailUser"/><br>
<button class="ActivateBtn" name="ActivateBtn">Activate</button>
<p class="note">Didn't get code click <a href="emailActivation.php" >here </a>to send code again</p> 
</div>
</div>
</form>
</body>
</html>
<?php 
include_once("connectdb.php");
require 'email/PHPMailerAutoload.php';
?>
<?php
if(isset($_POST['ActivateBtn']))
{		
$Email=$_POST['emailUser'];
$Name=$Email;

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
$Code = "ABCDEFGHIJLMNOPQRSTUVWXYZ0123456789";
$FinalCode = substr(str_shuffle($Code),0,8);

$Message.="<br>enter this code in the following link to activate your account <br>$FinalCode<br></body></html>";

$mail->Body=$Message;

if(!$mail->send())
{
	echo"<p class='errormsg'>Send Success</p>";	
}
else
{
	echo"<p class='errormsg'>Send success</p>";	
}
$_SESSION["emailuser"]=$Email;
$_SESSION["emailuserCode"]=$FinalCode;
header("location:activation.php");
exit();
}			
?>