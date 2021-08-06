<div class="container">
<?php
include_once("header.php");
?>
<form method="POST">
	<div class="Image_main_container" >
	<div class="index_image">
	<img class="index_image1" src="animation_1.jpg">
	<img class="index_image1 index_image2" src="animation_2.jpg">
	<!--img class="index_image2" -->
	</div>
	</div>
		<div class="top_img_btns_container">
			<button class="top_img_btns"name="Products_diaplay_all">Products</button>
			<button class="top_img_btns"name="register_signup_btn">SignUp</button>
		</div>
	
	<span class="new_arrrivals_tag">New Arrivals</span>
	<div class="product_display_container">
	<?php
	if(isset($_POST['Products_diaplay_all']))
	{
		header("location:allproducts.php"); 
			exit();
	}
	if(isset($_POST['register_signup_btn']))
	{
		header("location:register.php"); 
			exit();
	}
	
		$sql = "SELECT * FROM  products ORDER BY id DESC LIMIT 5";
		$result = mysqli_query($connectdb,$sql);
		
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
		}
		?>
	</div>
	<button class="top_img_btns moreBtnn" ><a href="allproducts.php" class="moreProducts">More</a></button>

</form>
<?php
include_once("footer.php");
?>
</div>
<?php
if (isset($_POST['Registerbtn']))
{
	header("location:register.php");   /*--passing error to URL*/
			exit();
}
?>