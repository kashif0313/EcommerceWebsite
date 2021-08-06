
function register()
{
	window.location.replace('register.php')
}
function login()
{
	window.location.assign('Login.php')
}
function viewProfile()
{
	document.getElementById("openProfile").style.display="block";document.getElementById("logoutButton").style.display="block";
	//alert("button clicked");
}function viewMOBProfile()
{
	document.getElementById("openMOBProfile").style.display="block";
	document.getElementById("logoutButton").style.display="block";
	//alert("button clicked");
}
function open_header()
{
	document.getElementById("mob_header").style.width="100%";
	document.getElementById("close_btn").style.display="inline-block";
}
function close_header()
{
	document.getElementById("mob_header").style.width="0%";
	document.getElementById("close_btn").style.display="none";
	document.getElementById("open_btn").style.display="inline-block";
}