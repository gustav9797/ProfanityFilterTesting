<?php

if($_POST['submit'])
{
	$name = $_FILES['upload']['name'];
	$temp = $_FILES['upload']['tmp_name'];
	$type = $_FILES['upload']['type'];
	$size = $_FILES['upload']['size'];
	$check= getimagesize($temp);
    /*
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
    */
}
else
{
	header("Location: index.html");
}
?>
<html>
<br>
<!--<img src="bilder/<?php echo $temp;?>"/>-->
<br/>
</html>
<?php
$int = 1;

include __DIR__ . '/lib/Autoloader.php';

$quant = new Image_FleshSkinQuantifier($temp);
$percentage = $quant->getPornQuantity() * 100;

if($percentage > 20)
    {
        echo 'This image is most likely porn.';
    }
else
    {
        echo 'This image is most likely not porn.';
        // fixa detta
    $conn=new PDO("mysql:host=127.0.0.1;dbname=gymnasiearbete;charset=UTF8","root","");
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	$sql = "insert into bilder(Bild, Bildtyp) values(:bild, :bildtyp)";
	
	if(isset($_FILES["upload"]) && $_FILES["upload"]["size"]>0)
	{
		$check = getimagesize($_FILES["upload"]["tmp_name"]);
    	if($check == true) 
    	{
    		//Det är en bild
			$bildtyp = $_FILES['upload']['type'];
        	$bild = addslashes($_FILES['upload']['tmp_name']);
        	$bild = file_get_contents($bild);
        	$bild = base64_encode($bild);
        	
    	}
    	else 
    	{
    		//Det är ingen bild
    		echo "Det där är ingen bild";
    		die();
    	}
	}
	else
	{
		$bild = null;
		$bildtyp = null;
	}
		
	//echo "Du laddade upp" .$_FILES["bild"]["name"];
	
	$params = array(':bild'=>$bild, ':bildtyp'=>$bildtyp);
	
	//skicka fråga till databasservern
	$stmt=$conn->prepare($sql);
	
	//Kör frågan på databasen
	$stmt->execute($params);
    }
	
echo '<br><br>';
echo 'Porn percentage: ' . $percentage;
?>