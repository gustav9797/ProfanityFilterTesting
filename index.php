<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
.stil
{
		background-color:pink;
		width:278px;
		height:auto;
		margin-top:50px;
		margin-left:auto; 
		margin-right:auto;
}
.text
{
		background-color:pink;
		width:auto;
		height:auto;
		margin-top:50px;
		margin-left:100px; 
		margin-right:100px;
}
textarea 
{
    resize: none;
	margin-left:5px;
}
p
{
	margin-left:110px;
	margin-right:auto;
}
input
{
	margin-left:110px;
	margin-right:auto;	
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profanity Filter</title>
<script>
</script>
</head>

<body>
<div id="php" class="stil">
	<p>Fulfilter</p>
	<form id="form1" name="form1" method="post" action="index.php" enctype="multipart/form-data">
		<textarea rows="6" cols="35"name="HelaTexten" draggable="false" ></textarea>
		<br/>
		<input name="Filtrera" type="submit" />
	</form>
</div>
</body>
</html>
<?php
	require_once __DIR__ . '/vendor/autoload.php';

	use Snipe\BanBuilder\CensorWords;
	$censor = new CensorWords;
	$censor->setReplaceChar("*");
	if(!empty($_POST["HelaTexten"]))
	{
		echo "<div class='text'>";
		$input = $_POST["HelaTexten"];
		$string = $censor->censorString($input);
		echo "Original: " . $string["orig"] . "<br><br><br>";
		echo "Clean: " . $string["clean"] . "<br><br><br><br>";
		echo "</div>";
		header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
		header( 'Cache-Control: post-check=0, pre-check=0', false ); 
		header( 'Pragma: no-cache' );
		unset($_POST);
	}
?>