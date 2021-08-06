<?php
include_once("header.php");
include_once("connectdb.php");
?>
<html>
<head>
<link rel="stylesheet" href="addproduct.css">
<script type="text/javascript" src="addproduct.js"></script>
</head>
<body>
<form method="POST"enctype="multipart/form-data">
<div class="container">
<div class="upload_container">
<div class="imagespreview">
<div class="PreviewImage">
<span class="title"> Upload Image 1</span>
 <input type="file" class="upload_file" name="image1" accept="image/*" onchange="showPreview(event);">
<img class="preview" src="" id="impreview1" ></div>
<div class="PreviewImage"><span class="title"> Upload Image 2</span>
   <input type="file" class="upload_file" name="image2" accept="image/*" onchange="showPreview1(event);">
<img class="preview" src="" id="impreview2"></div>
<div class="PreviewImage"><span class="title"> Upload Image 3</span>
   <input type="file" class="upload_file" name="image3" accept="image/*" onchange="showPreview2(event);">
<img class="preview" src="" id="impreview3"></div>
</div>
<?php 
if(isset($_GET['productAdded']))
	{
		echo"<div class='Popup' id='Popup'><button class='close_popup' name='closePopupBtn'>X</button>
		
<div class='errormsg1'>Product added sucessfully</div>
</div>
<div class='overlay' id='OverlayID'></div> ";	
	}
	if (isset($_POST['closePopupBtn']))
{
	header("location:stock.php");
	exit();
} 
?>
</div>
<div class="content_container">
 Product Name
<input class="inputarea" name="productName" type="name"placeholder="Product Name">
Brand Name
<input class="inputarea" name="brandName" type="name"placeholder="Brand Name">
<div class="Radioarea">
Discount
<input class="Radiobtn"type="radio"name="disc"id="trueid"onclick="checkedradio()" value="Yes">Yes
<input class="Radiobtn"type="radio"name="disc"id="falseid"onclick="uncheckedradio()" value="No" >NO
<input class="discount_input"placeholder="discount%" name="discountPrice"id="discountid"disabled>
</div>
<div class="Radioarea">
Gender
<input class="Radiobtn"type="radio"name="gender" value="Male">Male
<input class="Radiobtn"type="radio"name="gender"value="Female">Female<input class="Radiobtn"type="radio"name="gender"value="Kid">Kid
</div><br>
 Product Price
<input class="inputarea" name="productPrice" type="name"placeholder="Product Price">
 Dilivery Charges
<input class="inputarea" name="Cash" type="name"placeholder="COD charges">
<hr>
<div class="Radioarea">
Categroy
<input class="Radiobtn"type="radio"name="Categroy" value="HandBags">HandBags
<input class="Radiobtn"type="radio"name="Categroy"value="Jewlery">Jewlery
<input class="Radiobtn"type="radio"name="Categroy"value="Clothes">Clothes
</div><hr>
<div class="Radioarea1">
Size</br>Small
<input class="Radiobtn1"name="sizeSmall"type="number" placeholder="Small Quantity">Medium
<input class="Radiobtn1"name="sizeMedium"type="number"placeholder="Medium Quantity">Large
<input class="Radiobtn1"name="sizeLarge"type="number"placeholder="Large Quantity">
</div>
<hr>
Discription
<br>
<textarea class="Product_disc" name="productDisc"placeholder="Discription of the product"></textarea><br>
<button class="UploadBtn" name="UploadItem">Upload Item</button>
</div></div>
</form>
</body>
</html> 	
<?Php
if(isset($_POST['UploadItem']))
{
$PName=$_POST['productName'];
$BName=$_POST['brandName'];

$disco = $_POST['disc'];

if($disco == 'No')
{
	 $discoValue=0;
	
}if($disco == 'Yes')
{
	$discoValue=$_POST['discountPrice'];
}
$ItemCategroy=$_POST['Categroy'];
$Gender=$_POST['gender'];
$Price=$_POST['productPrice'];
$COD=$_POST['Cash'];
$SSize=$_POST['sizeSmall'];
$MSize=$_POST['sizeMedium'];
$LSize=$_POST['sizeLarge'];
$discription=$_POST['productDisc'];
if($ItemCategroy == 'HandBags')
{
	$CatValue=0;
}
if($ItemCategroy == 'Jewlery')
{
	$CatValue=11;
}if($ItemCategroy == 'Clothes')
{
	$CatValue=22;
}if($Gender == 'Male')
{
	$Gendervalue=0;
}
if($Gender == 'Kid')
{
	$Gendervalue=11;
}if($Gender == 'Female')
{
	$Gendervalue=1;
}if($SSize == 0 || $SSize == '')
{
	$SmSize='no';
}
else
{$SmSize=$_POST['sizeSmall'];}
if($MSize == 0 || $MSize == '')
{
	$MeSize='no';
}
else
{$MeSize=$_POST['sizeMedium'];}
if($LSize == 0 || $LSize == '')
{
	$LaSize='no';
}
else
{$LaSize=$_POST['sizeLarge'];}
if($COD == 0 || $COD == "")
{
	$cahshonDilivery="no";
}
else
{$cahshonDilivery=$_POST['Cash'];}
	if(empty($PName))
		{
		header("Location:addproduct.php?PName");
		exit();
	}
	if(empty($BName))
		{
		header("Location:addproduct.php?BName");
		exit();
	}
	if(empty($disco))
		{
		header("Location:addproduct.php?Discount");
		exit();
	}
	if(empty($Gender))
		{
		header("Location:addproduct.php?Gender");
		exit();
	}
	if(empty($Price))
		{
		header("Location:addproduct.php?Price");
		exit();
	}
	if(empty($discription))
		{
		header("Location:addproduct.php?discription");
		exit();
	}if(empty($cahshonDilivery))
		{
		header("Location:addproduct.php?cod");
		exit();
	}if(empty($SmSize))
		{
		header("Location:addproduct.php?Ssize");
		exit();
	}if(empty($MeSize))
		{
		header("Location:addproduct.php?Msize");
		exit();
	}if(empty($LaSize))
		{
		header("Location:addproduct.php?Lsize");
		exit();
	}
	
	/*for image 1*/
	
	$files = $_FILES['image1'];
	$filename = $_FILES['image1']['name'];
	$fileextract =explode('.',$filename);
	$fileactualextract = strtolower(end($fileextract));
	$filetempname = $_FILES['image1']['tmp_name'];
	$filenewname1 = $PName.$BName."1.".$fileactualextract;
	$fileDest1 = 'productImages/'.$filenewname1;
	move_uploaded_file($filetempname , $fileDest1);
	//echo"<p class='errormsg'>$filenewname1 </p>";
	/*for image 2*/
	$files = $_FILES['image2'];
	$filename = $_FILES['image2']['name'];
	$fileextract =explode('.',$filename);
	$fileactualextract = strtolower(end($fileextract));
	$filetempname = $_FILES['image2']['tmp_name'];
	$filenewname2 = $PName.$BName."2.".$fileactualextract;
	$fileDest2 = 'productImages/'.$filenewname2;
	move_uploaded_file($filetempname , $fileDest2);
	//echo"<p class='errormsg'>$filenewname2 </p>";
	/*for image 3*/
	$files = $_FILES['image3'];
	$filename = $_FILES['image3']['name'];
	$fileextract =explode('.',$filename);
	$fileactualextract = strtolower(end($fileextract));
	$filetempname = $_FILES['image3']['tmp_name'];
	$filenewname3 = $PName.$BName."3.".$fileactualextract;
	$fileDest3 = 'productImages/'.$filenewname3;
	move_uploaded_file($filetempname , $fileDest3);
	//echo"<p class='errormsg'>$filenewname3 </p>";
	$sql="INSERT INTO products(product,brand,disc,gender,category,price,cash,sizesmall,sizemedium,sizelarge,discript,img1,img2,img3) VALUES('$PName','$BName','$discoValue','$Gendervalue','$CatValue','$Price','$cahshonDilivery','$SmSize','$MeSize','$LaSize','$discription','$fileDest1','$fileDest2','$fileDest3')";
	$conn = mysqli_query($connectdb,$sql);
?>
<script>window.location.replace("addproduct.php?productAdded");</script>";
<?php
}	
?>