<div class="filter_container_container" id="filter_container_id"><div class="filter_container" >
<span class="titles">Categories</span>
<hr>
<button  class="dropdown" onclick="window.open('HandBagsproduct.php')">Hand Bags
</button>
<button  class="dropdown"onclick="window.open('Jewleryproduct.php')">Jewlery
</button>
<br>
<span class="titles">Sorting</span><br><hr>
<button class="dropdown" name="priceL_H" >Sort by price low to high</button>
<button class="dropdown" name="priceH_L" >Sort by price high to low</button>

<button class="dropdown" name="nameL_H" >Sort by Name Acending A-Z</button>
<button class="dropdown" name="nameH_L" >Sort by Name Decending Z-A</button>

<button class="dropdown" name="discountL_H" >Sort by Discount Acending 0%-100%</button>

<br><br>
<span class="titles">Price</span><br><hr>
<?php
$Price='';
if(isset($_POST['Filter_BTN']))
{
$Price = $_POST['Price_sort'];}
if($Price=="100-500")
		{
			echo'<input type="checkbox" name="Price_sort" value="100-500" checked>100-500<br>';
		}
		else
		{
			echo'<input type="radio" name="Price_sort" value="100-500" >100-500<br>';
		}
		if($Price=="500-1000")
		{
			echo'<input type="radio" name="Price_sort" value="500-1000"checked>500-1000<br>';
		}
		else
		{
			echo'<input type="radio" name="Price_sort" value="500-1000">500-1000<br>';
		}if($Price=="1000-1500")
		{
			echo'<input type="radio" name="Price_sort" value="1000-1500"checked>1000-1500<br>';
		}
		else
		{
			echo'<input type="radio" name="Price_sort" value="1000-1500">1000-1500<br>';
		}
		if($Price=="1500-2000")
		{
			echo'<input type="radio" name="Price_sort" value="1500-2000"checked>1500-2000<br>';
		}
		else
		{
			echo'<input type="radio" name="Price_sort" value="1500-2000">1500-2000<br>';
		}
echo'<button class="Filter_buttons" name="Filter_BTN">Filter</button>
<button class="Filter_buttons" name="Clear_Filter_BTN"> Clear Filter</button>
<hr></div></div>';
?>