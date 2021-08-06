function changeImg(id)
{
	var source = id.src;
	document.getElementById("main_img").src=source;
}
function setProduct()
{
 var storage1 = localStorage.getItem("productname");
  var storage2 = localStorage.getItem("productprice");
  document.getElementById("prodName").value=storage1;
  document.getElementById("prodPrice").value=storage2;
}
var quantityNumber=1;
function incQuantity()
{
	 quantityNumber = quantityNumber+1;
	document.getElementById("quantitNum").value=quantityNumber;
	//alert("increase");
}
function decQuantity()
{
	 quantityNumber = quantityNumber-1;
	 if(quantityNumber < 01)
	 {
		 quantityNumber=1;
		 document.getElementById("quantitNum").value=quantityNumber;
	 }
	 else
	 {
		 document.getElementById("quantitNum").value=quantityNumber;
	 }
	
}
var modal = document.getElementById("Popup");
	var overlay = document.getElementById("OverlayID");
	window.onclick = function(event) 
	{
		if (event.target == overlay)
		{
			modal.style.display = "none";
			overlay.style.display = "none";
		}
	}
