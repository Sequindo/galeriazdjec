<?php 
require_once 'business.php';
check_if_logged();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Galeria zdjęć</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php include "formularz.php"; ?>
<h3>Witaj, Anonimowy Użytowniku</h3>
<a href="ajax.php">Link do wyszukiwarki Ajax</a>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <p>Choose a photo to upload: (only PNG or JPG extensions)</p>
    <input type="file" name="file_to_upload" id="file_to_upload"/></br>
	</br>
	<input type="text" value="Watermark" name="watermark"/>
	<input type="text" value="Image Title" name="title"/>
	<input type="text" value="Author Name" name="name"/>
    <input type="submit" value="Upload Image" name="submit"/>
</form>
</br>
<?php include('show.php');?>
</body>

</html>
