<?php	 
	require_once 'business.php';
	check_session_status();
	if(isset($_POST['prywatnosc'])) {
		if($_POST['prywatnosc'] === 'private') {
		$prywatnosc = 'private';
		}
		else { $prywatnosc = 'public'; }
	}
	else {
		$prywatnosc = 'public';
	}	
	$miniature_dir = '/var/www/prod/web/miniatures/';
	$upload_dir = '/var/www/prod/web/images/';
	$watermark_dir = '/var/www/prod/web/watermarks/';
	$file = $_FILES['file_to_upload'];
	$file_name = basename($file['name']);
	$title = $_POST['title'];
	$author_name = $_POST['name'];
	$target = $upload_dir . $file_name;
	$target_watermark = $watermark_dir . $file_name;
	$target_miniatures = $miniature_dir . $file_name;
	$tmp_path = $file['tmp_name']; 
	$if_send = 1;

	//sprawdzenie rozmiaru pliku
	$size = basename($file['size']);
	if($size>1000000) {
		ob_start();
		echo "Plik jest za duży do uploadingu! Poczekaj na powrót do galerii... ";
		header( "refresh:5; url=index.php" ); 
		ob_end_flush();
		$if_send = 0;
	}
	//sprawdzenie rozszerzenie pliku
	$finfo = finfo_open(FILEINFO_MIME_TYPE); 
	$file_tmp_name = $_FILES['file_to_upload']['tmp_name']; 
	$mime_type = finfo_file($finfo, $file_tmp_name);
	if (($mime_type === 'image/jpeg' || $mime_type === 'image/png') && $if_send === 1) { 
			if($mime_type === 'image/jpeg') {
				$extension='jpg';
			}
			if($mime_type === 'image/png') {
				$extension='png';
			}
	}
	else {
		ob_start();
		echo 'Format niepoprawny! Poczekaj na powrót do galerii...';
		header( "refresh:5; url=index.php" ); 
		ob_end_flush();
		$if_send = 0;
	}
	if ($if_send === 1) {
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		if(move_uploaded_file($tmp_path, $target)) { 
				
			if($extension==='jpg') {
				$image2 = imagecreatefromjpeg($target);
			}
			if($extension==='png') {
				$image2 = imagecreatefrompng($target);
			}		
			imagestring($image2, 25, 0, 0, $_POST['watermark'], imagecolorallocate($image2, 255, 255, 255));
			imagejpeg($image2, $target_watermark);		
			$imx = imageSX($image2);
			$imy = imageSY($image2);
			$new_image = imagecreatetruecolor(200, 125);
			imagecopyresized($new_image, $image2, 0, 0, 0, 0, 200, 125, $imx, $imy);
			imagejpeg($new_image, $target_miniatures);
			$db = get_db();
			$photo = [
				'file_name' => $file_name,
				'title' => $title,
				'author' => $author_name,
				'prywatnosc' => $prywatnosc,
			];
			$db->photos->insert($photo);	
			ob_start();
			echo 'Plik przesłano, poczekaj na powrót do galerii...';
			header( "refresh:5; url=index.php" ); 
			ob_flush();
			exit;
		}
		echo "Nie przeniesiono pliku - nieznany błąd.";
	}
?>
