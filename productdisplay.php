<?php
include_once("header.php");
include_once("connectdb.php");
if(isset($_SESSION['CurrentProduct'])) 
{
    $Pname = $_SESSION['CurrentProduct'];
}if(isset($_GET['value'])) 
{
    $Pname = $_GET['value'];
}
$sql = "SELECT * FROM  products WHERE product='$Pname'";
		$result = mysqli_query($connectdb,$sql);
		if($row = mysqli_fetch_assoc($result))
		{				
	$pro_id = $row['id'];
				$Pname= $row['product'];
				$Bname= $row['brand'];
				$Price= $row['price'];
				$discription= $row['discript'];
				$imag1= $row['img1'];
				$imag2= $row['img2'];
				$imag3= $row['img3'];
				$proID = $row['id'];
				$Gender = $row['gender'];	
				$SSize = $row['sizesmall'];
				$MSize = $row['sizemedium'];
				$LSize = $row['sizelarge'];
				$COD = $row['cash'];
				}
?>
<html>
<head>
<link rel="stylesheet" href="index.css" media="print" onload="this.media='all'">
<link rel="stylesheet" href="productdisplay.css">
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
<div class="container"><?php 
$sizeprod="";
?>
<div class="display_container">
<div class="product_img_container">
<form method="POST">
<?php
if (isset($_POST['closePopupBtn']))
{
	header("Location: productdisplay.php?value=$Pname"); 
	exit();
}
if(isset($_GET['already']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button><br>
<div class='errormsg1'>Product Already Present in Cart</div>
</div>
<div class='overlay' id='OverlayID'></div>"	;	
	}
	
if(isset($_GET['NoSize']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button><br>
<div class='errormsg1'>Select Size First</div>
</div>
<div class='overlay' id='OverlayID'></div>"	;
	}
	if(isset($_GET['NoLogin']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button><br>
<div class='errormsg1'>Login to Order<br></div>
<a class='errorloginBtn' href='Login.php' >Log In</a><br>
<a class='errorloginBtn' href='register.php' >Sign UP</a><br>
</div>
<div class='overlay' id='OverlayID'></div>"	;
	}if(isset($_GET['productadded']))
	{
		echo"<div class='Popup'><button class='close_btn_popup' onclick='window.location.replace('allproducts.php');'>X</button><br>
<div class='errormsg1'>Added to Cart<br></div>
</div>
<div class='overlay' id='OverlayID'></div>"	;
	}
	
echo"<div class='product_img_main'><img class='imgProductMain' id='main_img' src='$imag1'></div>";
?>
<div class="product_image_container1">
<?php
echo"<div class='product_img1'>
		<img class='imgProduct' id='img1' src='$imag1' onclick='changeImg(this)' loading='lazy'>
	</div>
	<div class='product_img1'>
		<img class='imgProduct' id='img1' src='$imag2' onclick='changeImg(this)' loading='lazy'>
	</div>

	<div class='product_img1'>
		<img class='imgProduct' id='img1' src='$imag3' onclick='changeImg(this)' loading='lazy'>
		</div>";
if(isset($_POST['cartBtn']))
{
	if(!isset($_POST['SizeBtn']))
	{
		header("location:productdisplay.php?NoSize&value=$Pname"); 
		exit();
	}
}
?>
</div>
</div>
<div class="product_discription">
<span  class="brand_dics">BrandName:
<?php echo"<input class='brand_dics_input' value='$Bname' readonly>";?></span>
<span  class="brand_dics">Price:
<?php echo"<input class='brand_dics_input' value='Rs.$Price'readonly>";?></span>
<span  class="brand_dics">Product Name:
<?php echo"<input class='brand_dics_input' value='$Pname'readonly>";?></span>
<span  class="brand_dics">Quantity:
<input class="brand_quantity" value="1" name="quantity_product"id="quantitNum">
<button class="quantityBtn" onclick="incQuantity();return false">+</button>
<button class="quantityBtn" onclick="decQuantity();return false" >-</button></span><br>
<div class="Prod_Size">
<span  class="brand_dics">Sizes Avaliable<br>
<?php if($SSize=='no' || $SSize=='0')
{echo'<input class="Sizebutton"type="radio"name="SizeBtn"  value="Small"disabled style="display: none";>';}
else
{echo'<input class="Sizebutton"type="radio"name="SizeBtn"value="Small" >Small';}
if($MSize=='no'|| $MSize=='0')
{echo'<input class="Sizebutton"type="radio"name="SizeBtn" value="Medium"disabled style="display: none";>';}
else
	{echo'<input class="Sizebutton"type="radio"name="SizeBtn"value="Medium">Medium';}
if($LSize=='no' || $LSize=='0')
{echo'<input class="Sizebutton"type="radio"name="SizeBtn" value="Large"disabled style="display: none";>';}
else
	{echo"<input class='Sizebutton'type='radio'name=
'SizeBtn' value='Large' >Large";}
?> </span>
</div><br>

<span  class="brand_dics">Dilivery charges
<?php echo"<input class='brand_dics_input' value='Rs.$COD'readonly>";?></span>
<br><span  class="brand_dics">Discription :</span>
<text class="brand_dics_textarea"><?php echo"$discription"; ?></text>
<button class='cart_btn' name='cartBtn' >ADD TO CART </button>
</form>
</div>
<?php 


if(isset($_POST['cartBtn']))
{
		if(!isset($_SESSION['loginname']))
		{		$_SESSION['CurrentProduct']=$Pname;
			?>
			<script>window.location.replace("productdisplay.php?NoLogin")</script>
			<?php
		}
		if(isset($_SESSION['loginname']))
		{
			$name=$_SESSION['loginname'];
			$nameID=$_SESSION['loginID'];
			$sql1 = "SELECT * FROM  cart WHERE productID='$proID' AND name='$name'";
			$result1 = mysqli_query($connectdb,$sql1);	
			if (mysqli_num_rows($result1)!=0)
			{
				header("location:productdisplay.php?already&value=$Pname");
				exit();
			}
			else
			{			
			$sizeprod = $_POST['SizeBtn'];
			$Quantity = $_POST['quantity_product'];
			$sql="INSERT INTO cart(userID,name,product,quantity,size,productID) VALUES('$nameID','$name','$Pname','$Quantity','$sizeprod','$proID')";
					mysqli_query($connectdb,$sql);		
			}
			?>
			<script>window.location.replace("productdisplay.php?productadded");</script>
			<?php
		}
		 if(isset($_SESSION['loginname1']))
		{
			$name=$_SESSION['loginname1'];
			$nameID=$_SESSION['loginID1'];
			$sql1 = "SELECT * FROM  cart WHERE productID='$proID' AND name='$name'";
			$result1 = mysqli_query($connectdb,$sql1);	
			if (mysqli_num_rows($result1)!=0)
			{
				header("location:productdisplay.php?already&value=$Pname");
				exit();
			}
			else
			{			
			$sizeprod = $_POST['SizeBtn'];
			$Quantity = $_POST['quantity_product'];
			$sql="INSERT INTO cart(userID,name,product,quantity,size,productID) VALUES('$nameID','$name','$Pname','$Quantity','$sizeprod','$proID')";
					mysqli_query($connectdb,$sql);
					header("location:allproducts.php?productadded");
				exit();
			}
		}
				 
}
?>
</div>
<div class="Related_Products">
<span class="title">Related Products</span>
<hr>
<?php
		$sql2 = "SELECT * FROM  products WHERE gender='$Gender' LIMIT 5";
		$result2 = mysqli_query($connectdb,$sql2);
		
		while($row = mysqli_fetch_assoc($result2))
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
<img class='imgProduct'  id='img' src='$imag1'loading='lazy'></div>
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
		}
		?>

</div>
</div></div>
<script type="text/javascript" src="productdisplay.js"></script>
</body>
</html>
<?php 
include("footer.php");
?>