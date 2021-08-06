<?php
include_once("connectdb.php");
if(isset($_SESSION['CurrentProduct'])) 
{
    unset($_SESSION['CurrentProduct']);
}
?>
<html>
<head>
<link rel="stylesheet" href="index.css" media="print" onload="this.media='all'">
<script>window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
	const Main = document.querySelector(".container");
    loader.className += " hidden"; // class "loader hidden"
	Main.style.display="block";
	Main.className += " hidden";
});</script>

</head>
<body>

	<div class="loader">
    <img src="200.gif" alt="Loading..." />
</div>
<?php 
include("home.php");?>
</body>
<script type="text/javascript" src="index.js"></script>
</html>
