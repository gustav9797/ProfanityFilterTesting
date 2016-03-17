<!DOCTYPE html>
<html>
<head>
<link href="stil.css" rel="stylesheet" type="text/css">
<script>
var i = 0;
function inlagg()
{
	if(i==0)
	{
		document.getElementById("skriva").style.display ="block";
		i=1;
	}
	else
	{
		document.getElementById("skriva").style.display ="none";
		i=0;
	}
}
</script>
</head>

<body>
<div class="stora">
	<div class="top">
	</div>
	<div class="sidan">
	<div class="knapp">
    </div>   
    </div>
    <div class="mitten">
    <?php
	$conn=new PDO("mysql:host=127.0.0.1;dbname=gymnasiearbete;charset=UTF8","root","");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql="select * from Inlagg where Fulhet=0";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$row=$stmt->fetch();
	if (!$row) 
	{
		exit();
	}
	echo "<table>";
	while($row != null)
  	{
		$text=$row['Text'];
  		echo "<div class='text'>$text</div>";
		$row=$stmt->fetch();
	}
	echo "</table>";

	?>
    </div>
    <div class="nere">
	</div>
</div>
</body>
</html>