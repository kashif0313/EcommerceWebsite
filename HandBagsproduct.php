<?php
include_once("header.php");
include_once("connectdb.php");
if(isset($_SESSION['CurrentProduct'])) 
{
    unset($_SESSION['CurrentProduct']);
}
?>
<html>
<head>
<link rel="stylesheet" href="index.css">
<meta property="og:image" content="uploadLogo.png"/>
<link rel="icon" href="https://zernishwardrobe.epizy.com/uploadLogo.png">
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
<div class="container">
<form method="POST">
<div class="overlay" id="filter_container_overlay"></div>
<div class="content_container">
<div class="Image_main_container">
<img class="top_image" src="animation2.jpg"></div>
<p class="Title">Hand Bags</p>

<div class="all_product_display_container">
<?php
	include("filter.php");?>

	<button class="filter_open_btn" onclick="return open_filter()">filter</button>
	<?php

	 if(isset($_POST['Clear_Filter_BTN']))
{header("Location:allproducts.php");
exit();}
if(isset($_POST['Filter_BTN']))
{
	if(isset($_POST['Price_sort']))
	{	$Price = $_POST['Price_sort'];
		if($Price=="500-1000")
		{
			$priceMin=500;
			$priceMax=1000;
			
		}
		if($Price=="100-500")
		{
			$priceMin=100;
			$priceMax=500;
			
		}
		if($Price=="1000-1500")
		{
			$priceMin=1000;
			$priceMax=1500;
		}if($Price=="1500-2000")
		{
			$priceMin=1500;
			$priceMax=2000;
		}
			
			$sql="SELECT * FROM  products WHERE price>='$priceMin' AND price<='$priceMax'AND category='0'";
}}
else if(isset($_POST['priceL_H']))
{
	$sql="SELECT * FROM  products WHERE category='0' ORDER BY price";
}
else if(isset($_POST['priceH_L']))
{
	$sql="SELECT * FROM  products WHERE category='0' ORDER BY price DESC";
}
else if(isset($_POST['nameL_H']))
{
	$sql="SELECT * FROM  products  WHERE category='0' ORDER BY product";
}
else if(isset($_POST['nameH_L']))
{
	$sql="SELECT * FROM  products WHERE category='0' ORDER BY product DESC";
}
else if(isset($_POST['discountL_H']))
{
	$sql="SELECT * FROM  products WHERE category='0' ORDER BY Disc DESC ";
}
else
{
		$sql = "SELECT * FROM  products WHERE category='0'";
}		
		$result = mysqli_query($connectdb,$sql);
		if (mysqli_num_rows($result)!=0)
		{
				while($row = mysqli_fetch_assoc($result))
		{			
				$Pname= $row['product'];
				$Bname= $row['brand'];
				$Price= $row['price'];
				$imag1= $row['img1'];
				$imag2= $row['img2'];
				$imag3= $row['img3'];
				$Discount = $row['disc'];
				$SSize = $row['sizesmall'];
				$MSize = $row['sizemedium'];
				$LSize = $row['sizelarge'];
				?>
			<div class="product_display">
		<?php if ($SSize == 0 && $MSize == 0 && $LSize == 0) 
		{echo "<div class='noStock'> Out of Stock</div>";}
	?>
	
		
	<div <?php if ($Discount == 0 || $SSize == 0 && $MSize == 0 && $LSize == 0) {echo " style='display: none';";}
if ($Discount > 1) {echo " style='display: block';";}	?> class="discount_tag"><?php echo"$Discount% ";?>Discount</div>
			
			<?php echo"<div class='product_img'>
<img class='imgProduct'  id='img1' src='$imag1'  ></div>
			<div class='product_display_image_text_container'>
			
			 <span class='product_display_image_text'>$Pname</span>
			 <span class='product_display_image_text'>$Price</span>
			</div>";
			if ($SSize == 0 && $MSize == 0 && $LSize == 0) 
			{echo"
			<div class='Open_hover' style='display: none';>
			<a href='productdisplay.php?value=$Pname' class='Show_button'>View</a>
			</div>";}
			else
				{echo"
			<div class='Open_hover'>
			<a href='productdisplay.php?value=$Pname' class='Show_button'>View</a>
			</div>";}
			echo"
		</div>";
		
	
//echo"$Pname<br>";				
}}
		if (mysqli_num_rows($result)==0)
			echo"no results found";
		?>
	</div>
	</form>
</div></div>
<script type="text/javascript" src="index.js"></script>
</body>
</html>
<?php 
include_once("footer.php");
?>
