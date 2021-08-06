<?php
include_once("header.php");
include_once("connectdb.php");
if(isset($_GET['product']))
{
	$DiscountValue='';
	$edit_id = $_GET['product'];
	$sql1 = "SELECT * FROM  products WHERE id='$edit_id'";
		$result1 = mysqli_query($connectdb,$sql1);
		if($row1 = mysqli_fetch_array($result1))
		{
				$Pname= $row1['product'];
				$Bname= $row1['brand'];
				$Price= $row1['price'];
				$imag1= $row1['img1'];
				$imag2= $row1['img2'];
				$imag3= $row1['img3'];
				$Gender = $row1['gender'];
				$ItemCat = $row1['category'];
				$COD = $row1['cash'];
				$Price = $row1['price'];
				$Disc = $row1['discript'];
				$Discount = $row1['disc'];
				$SSize = $row1['sizesmall'];
				$MSize = $row1['sizemedium'];
				$LSize = $row1['sizelarge'];
		}
}

$DiscountValue=$Discount;
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
<img class="preview" src="<?php echo"$imag1";?>" name="impreview11"id="impreview1" ></div>
<div class="PreviewImage">
<img class="preview" src="<?php echo"$imag2";?>" id="impreview2"></div>
<div class="PreviewImage">
<img class="preview" src="<?php echo"$imag3";?>"  id="impreview3"></div>
</div>
</div>
<div class="content_container">
 Product Name
<input class="inputarea" name="productName" type="name"placeholder="Product Name" value="<?php echo"$Pname";?>">
Brand Name
<input class="inputarea" name="brandName" type="name"placeholder="Brand Name"value="<?php echo"$Bname";?>">
<div class="Radioarea">
Discount
<?php 
if($DiscountValue== 0)
{
	echo'<input class="Radiobtn"type="radio"name="disc"id="trueid"onclick="checkedradio()" value="Yes">Yes
<input class="Radiobtn"type="radio"name="disc"id="falseid"onclick="uncheckedradio()" value="No" checked>NO';
}
else
{
	echo'<input class="Radiobtn"type="radio"name="disc"id="trueid"onclick="checkedradio()" value="Yes"checked>Yes
<input class="Radiobtn"type="radio"name="disc"id="falseid"onclick="uncheckedradio()" value="No" >NO';
}
?>

<input class="discount_input"placeholder="disc%" name="discountPrice"id="discountid "value="<?php echo"$DiscountValue";?>">
</div>
<div class="Radioarea">
Gender
<?php
if($Gender==0)
		{
			echo"<input class='Radiobtn'type='radio'name='gender' value='Male' checked='checked'>Male
<input class='Radiobtn'type='radio'name='gender'value='Female'>Female
<input class='Radiobtn'type='radio'name='gender'value='Kid'>Kid";
	}
	if($Gender==1)
		{echo"<input class='Radiobtn'type='radio'name='gender' value='Male'>Male
<input class='Radiobtn'type='radio'name='gender'value='Female' checked='checked'>Female<input class='Radiobtn'type='radio'name='gender'value='Kid'>Kid";}
if($Gender==11)
		{echo"<input class='Radiobtn'type='radio'name='gender' value='Male'>Male
<input class='Radiobtn'type='radio'name='gender'value='Female' >Female<input class='Radiobtn'type='radio'name='gender'value='Kid'checked='checked'>Kid";}
	?>

</div>
 Product Price
<input class="inputarea" name="productPrice" type="name"placeholder="Product Price" value="<?php echo"$Price";?>">
 Dilivery Charges
<input class="inputarea" name="Cash" type="name"placeholder="COD charges" value="<?php echo"$COD";?>">
<hr>
<div class="Radioarea">
Categroy
<?php
if($ItemCat==0)
		{
			echo"<input class='Radiobtn'type='radio'name='Categroy' value='HandBags' checked='checked'>HandBags
<input class='Radiobtn'type='radio'name='Categroy'value='Jewlery'>Jewlery
<input class='Radiobtn'type='radio'name='Categroy'value='Clothes'>Clothes";
	}
	if($ItemCat==11)
		{echo"<input class='Radiobtn'type='radio'name='Categroy' value='HandBags'>HandBags
<input class='Radiobtn'type='radio'name='Categroy'value='Jewlery' checked='checked'>Jewlery<input class='Radiobtn'type='radio'name='Categroy'value='Clothes'>Clothes";}
if($ItemCat==22)
		{echo"<input class='Radiobtn'type='radio'name='Categroy' value='HandBags'>HandBags
<input class='Radiobtn'type='radio'name='Categroy'value='Jewlery' >Jewlery<input class='Radiobtn'type='radio'name='Categroy'value='Clothes'checked='checked'>Clothes";}
	?>
</div><hr>
<div class="Radioarea1">
Size</br>Small
<input class="Radiobtn1"name="sizeSmall"type="number" placeholder="Small Quantity"  value="<?php echo"$SSize";?>">Medium
<input class="Radiobtn1"name="sizeMedium"type="number"placeholder="Medium Quantity" value="<?php echo"$MSize";?>">Large
<input class="Radiobtn1"name="sizeLarge"type="number"placeholder="Large Quantity" value="<?php echo"$LSize";?>">
</div>
<hr>
Discription
<br>
<textarea class="Product_disc" name="productDisc"placeholder="Discription of the product"><?php echo"$Disc";?></textarea><br>
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
$Gender=$_POST['gender'];
$Price=$_POST['productPrice'];
$COD=$_POST['Cash'];
$discription=$_POST['productDisc'];
$SSize=$_POST['sizeSmall'];
$MSize=$_POST['sizeMedium'];
$LSize=$_POST['sizeLarge'];
if($Gender == 'Male')
{
	$Gendervalue=0;
}
if($Gender == 'Female')
{
	$Gendervalue=1;
}
if($Gender == 'Kid')
{
	$Gendervalue=11;
}
if($SSize == 0 || $SSize == '')
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
{

	$cahshonDilivery=$_POST['Cash'];}
	/*for image 1*/
	$fileextract =explode('.',$imag1);
	$fileactualextract = strtolower(end($fileextract));
	$filenewname1 = $PName.$BName."1.".$fileactualextract;
	$fileDest1 = 'productImages/'.$filenewname1;
	rename("$imag1", "$fileDest1");
	move_uploaded_file($imag1 , $fileDest1);
	//echo"<p class='errormsg'>$filenewname1 </p>";
	/*for image 2*/

	$fileextract =explode('.',$imag2);
	$fileactualextract = strtolower(end($fileextract));
	$filenewname2 = $PName.$BName."2.".$fileactualextract;
	$fileDest2 = 'productImages/'.$filenewname2;
	rename("$imag2", "$fileDest2");
	move_uploaded_file($imag2 , $fileDest2);
	//echo"<p class='errormsg'>$filenewname2 </p>";
	/*for image 3*/

	$fileextract =explode('.',$imag3);
	$fileactualextract = strtolower(end($fileextract));
	$filenewname3 = $PName.$BName."3.".$fileactualextract;
	$fileDest3 = 'productImages/'.$filenewname3;
	rename("$imag3", "$fileDest3");
	move_uploaded_file($imag3 , $fileDest3);
/*unlink($imag1);
unlink($imag2);
unlink($imag3);*/
	$sql1="UPDATE products SET product='$PName',brand='$BName',disc='$discoValue',gender='$Gendervalue',price='$Price',cash='$cahshonDilivery',sizesmall='$SmSize',sizemedium='$MeSize',sizelarge='$LaSize',discript='$discription',img1='$fileDest1',img2='$fileDest2',img3='$fileDest3' WHERE id='$edit_id'";
 	mysqli_query($connectdb,$sql1);	
/*header("location:stock.php");
exit();} */}
?>