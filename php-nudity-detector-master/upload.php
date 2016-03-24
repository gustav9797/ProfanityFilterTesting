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
		echo "$name<br>$temp<br>$type<br>Storlek: $size<br>Bredd: $check[0]<br>Höjd: $check[1]";
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
</html>