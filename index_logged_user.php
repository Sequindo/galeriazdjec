<?php	 
	require_once 'business.php';
	check_session_status();
	$userid = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Galeria zdjęć</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>	
<h3>Witaj, <?php echo $userid; ?></h3>
<a href="logout.php">Wyloguj się...</a>
<a href="ajax.php">Link do wyszukiwarki Ajax</a>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <p>Choose a photo to upload: (only PNG or JPG extensions)</p>
    <input type="file" name="file_to_upload" id="file_to_upload"/></br>
	</br>
	<input type="text" value="Watermark" name="watermark"/>
	<input type="text" value="Image Title" name="title"/>
	<input type="text" value="<?php echo $userid ?>" name="name"/></br>
	<input type="radio" name="prywatnosc" value="public" checked>Zdjęcie publiczne</br>
	<input type="radio" name="prywatnosc" value="private">Zdjęcie prywatne</br>
    <input type="submit" value="Upload Image" name="submit"/>
</form>
</br>
<?php require('show.php');?>
</body>

</html>