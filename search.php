<?php	 
	require_once 'business.php';
	check_session_status();
	$full_size_folder = 'watermarks/';
	$folder = 'miniatures/';
	

	$q = $_REQUEST["q"];
	$hint = "";

	$db = get_db();
	$collection = $db->photos;
	$file = $q;
	$photos_found = $collection->find();
	foreach ($photos_found as $photo) {	
		$title=$photo['title'];
		if(strpos($title,$file)!==false){
			$file_path = $photo['file_name'];
			if($photo['prywatnosc'] === 'public') {
				?><a href="<?php echo $full_size_folder . $file_path; ?>" target="_blank"><img src="<?php echo $folder . $file_path; ?>"/></a></br><?php
				echo "Title: " . $photo['title'];?></br><?php
				echo "Author: " . $photo['author'];?></br></p><?php
			}
			if($photo['prywatnosc'] === 'private' && isset($_SESSION['user_id'])) {
				if($photo['author'] === $_SESSION['user_id']) {
					?><a href="<?php echo $full_size_folder . $file_path; ?>" target="_blank"><img src="<?php echo $folder . $file_path; ?>"/></a></br>
					<p><?php
					echo "Zdjecie prywatne zalogowanego uzytkownika!"?></br><?php
					echo "Title: " . $photo['title'];?></br><?php
					echo "Author: " . $photo['author'];?></br></p><?php
				}
			}
		}
	}
?>
