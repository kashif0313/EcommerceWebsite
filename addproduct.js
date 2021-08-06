function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("impreview1");
    preview.src = src;
	preview.style.display = "inline-block";
  }
}
function showPreview1(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("impreview2");
    preview.src = src;
	preview.style.display = "inline-block";
  }
}
function showPreview2(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("impreview3");
    preview.src = src;
	preview.style.display = "inline-block";
  }
}
function checkedradio()
{
	 var radioCheck = document.getElementById("trueid").checked = true;
	 if(radioCheck == true)
	 {
		 document.getElementById("discountid").disabled = false;
	 }
}
function uncheckedradio()
{
	 var radioCheck = document.getElementById("falseid").checked = true;
	 if(radioCheck == true)
	 {
		 document.getElementById("discountid").disabled = true;
	 }
}
function LoginOpen()
{
	window.open('Login.php');
}
