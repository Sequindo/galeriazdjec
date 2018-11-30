<?php	
	require_once 'business.php';
?>

<!DOCTYPE html>
<html>
<head>
	<script>
		function showHint(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "search.php?q=" + str, true);
				xmlhttp.send();
			}
		}
	</script>
	<meta charset="UTF-8">
	<title>Galeria zdjęć</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h3>Wyszukiwarka zdjęć</h3>
<a href="index.php">Powrót do galerii zdjęć</a>
<p><b>Wpisz tytuł poszukiwanego zdjęcia...</b></p>
<form> 
	<input type="text" onkeyup="showHint(this.value)">
</form>
<p><span id="txtHint"></span></p>
</body>
</html>

