<?php
	require_once __DIR__ . '/vendor/autoload.php';

	use Snipe\BanBuilder\CensorWords;
	$censor = new CensorWords;
	$censor->setReplaceChar("*");
	if(!empty($_GET["input"]))
		$input = $_GET["input"];
	else
		$input="This is a fucking bitch a$$ sh1t.";
	$string = $censor->censorString($input);
	echo "Original: " . $string["orig"] . "<br><br><br>";
	echo "Clean: " . $string["clean"] . "<br><br><br><br>";
	echo '<form action="index.php"> <input type="text" name="input"> <input type="submit"> </form>';
?>