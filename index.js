function open_filter()
{
	document.getElementById('filter_container_id').style.height="50%";
	document.getElementById('filter_container_overlay').style.display="block";
	


	var modal = document.getElementById("filter_container_id");
	var overlay = document.getElementById("filter_container_overlay");
	window.onclick = function(event) 
	{
		if (event.target == overlay) {
		modal.style.height = "0%";
		overlay.style.display = "none";}
	}
	return false;
	}
