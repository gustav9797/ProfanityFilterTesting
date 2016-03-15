<html>
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
	</head>

<body>
	<div id="php" class="stil">
		<p>Fulfilter</p>
		<form id="form1" name="form1" method="post" action="index.php" enctype="multipart/form-data">
			<textarea rows="6" cols="35"name="HelaTexten" draggable="false" ><?php  if(isset($_POST["HelaTexten"]))echo $_POST["HelaTexten"]; ?></textarea>
			<br/>
			<input name="Filtrera" type="submit" />
		</form>
	</div>
	
	<?php
		//include("CensorWords.php");
		include("censor.php");
		//$censor = new CensorWords;
		//$censor->setReplaceChar("*");
		$censor = new Censor();
		$censor->initialize();
		if(!empty($_POST["HelaTexten"]))
		{
			echo "<div class='text'>";
			$input = $_POST["HelaTexten"];
			$string = $censor->run($input);
			//$string = $censor->censorString($input);
			//echo "Original: " . $string["orig"] . "<br><br><br>";
			//echo "Clean: " . $string["clean"] . "<br><br><br><br>";
			echo "Clean: " . $string . "<br><br><br><br>";
			echo "</div>";
			unset($_POST);
		}
	?>
</body>
</html>