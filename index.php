<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
.stil
{
		background-color:pink;
		width:300px;
		height:auto;
		margin-top:50px;
		margin-left:auto; 
		margin-right:auto;
}
} </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profanity Filter</title>
<script>
var i = 0;
function change()
{
	if(i==0)
	{
		i=1;
		document.getElementById("php").style.display="block";
		document.getElementById("java").style.display="none";
		
	}
	else
	{
		i=0;
		document.getElementById("php").style.display="none";
		document.getElementById("java").style.display="block";
	}
}
function visa()
{
	document.getElementById("fel").innerHTML="här ska det hända något som fixar detta: "+ document.getElementById('textruta').value;
}
</script>
</head>

<body>
<div id="java" class="stil">
	<p>Fulfilter med java</p>
	<textarea rows="4" cols="35"id="textruta"></textarea><br/>
    <button onclick="visa()">Fulfilter</button><br/>
    <button onclick="change()">php</button>
    <p id="fel"></p>
</div>

<div id="php" class="stil">
	<p>Fulfilter med php</p>
		<form id="form1" name="form1" method="post" action="gymnasiearbete/index.php">
		<textarea rows="4" cols="35"name="test"></textarea>
		<br/>
		<input name="Filtrera" type="submit" />
	</form>
<button onclick="change()">Java</button>
</div>
<script>
document.getElementById("php").style.display="none";
</script>
</body>
</html>