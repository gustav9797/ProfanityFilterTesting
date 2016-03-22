<html>
	<head>
		<style type="text/css">
		body
		{
			background-color:black;
			background:url(dark_background_line_surface_65896_1920x1080.jpg);
		}
		.stil
		{
			background-color:black;
			color:white;
			width:278px;
			height:auto;
			margin-top:50px;
			margin-left:auto; 
			margin-right:auto;
			border-radius:10px;
			box-shadow:0px 0px 25px #666;
		}
		.text
		{
			text-align:center;
			background-color:black;
			color:white;
			width:auto;
			height:auto;
			margin-top:50px;
			margin-left:100px; 
			margin-right:100px;
			border-radius:10px;
			box-shadow:0px 0px 25px #666;
		}
		textarea 
		{	
			resize: none;
			margin-left:5px;
			border-radius:10px;
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
			echo "<br>";
			
			$string = $censor->run($input, true);
			echo "Clean: " . $string . "<br>";
			
			$output = $censor->run($input, false);
			$highest = 0;
			foreach($output as $wordarray) {
				foreach($wordarray as $badness) {
					if($badness > $highest)
						$highest = $badness;
				}
			}
			echo "Badness: " . $highest;
			
			echo "<br><br>";
			echo "</div>";
			unset($_POST);
            try {
				$conn=new PDO("mysql:host=127.0.0.1;dbname=gymnasiearbete;charset=UTF8","root","");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="INSERT INTO `inlagg`(`Text`, `Fulhet`,`Filtrerad`) VALUES ('$input','$highest','$string')";
				$conn->exec($sql);
            }
			catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
		}
	?>
</body>
</html>
