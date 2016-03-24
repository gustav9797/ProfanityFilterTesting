<?php

if($_POST['submit'])
{
	$name = $_FILES['upload']['name'];
	$temp = $_FILES['upload']['tmp_name'];
	$type = $_FILES['upload']['type'];
	$size = $_FILES['upload']['size'];
	$check= getimagesize($temp);

	if ($check==true)
	{	
		move_uploaded_file($temp, "bilder/".$name);
		echo "$name<br>$type<br>Storlek: $size<br>Bredd: $check[0]<br>Höjd: $check[1]";
	}
	else
	{
  	 	echo "inte bild";
   		die();
	}	
}
else
{
	header("Location: index.html");
}
?>
<html>
<br>
<img src="bilder/<?php echo $name;?>"/>
<br/>
</html>
<?php
$int = 1;

include __DIR__ . '/lib/Autoloader.php';

$quant = new Image_FleshSkinQuantifier(__DIR__ . '/bilder/'.$name);

if($quant->isPorn())
    echo 'This image contains a lot of skin colors, thus might contain some adult content';
else
    echo 'This image does not contain many skin colors, thus is not likely to contain adult content';
	echo '<br><br>';
	echo 'Porn percentage: ' . ($quant->getPornQuantity() * 100);
?>