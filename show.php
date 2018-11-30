<?php
	require_once('business.php');	
	check_session_status();
	$db = get_db();
	$folder_path = 'miniatures/'; 
	$fullsizepath = 'watermarks/';
	$num_files = glob($folder_path . "*.{jpg,png}", GLOB_BRACE);
	$folder = opendir($folder_path);
	$lp = 0;
	
	if($num_files > 0)
	{
		?><form action="show_chosen_view.php" method="post"><?php
		while(false !== ($actual_read_file_name = readdir($folder))) 
		{
			$query = [
				'file_name' => $actual_read_file_name
			];
			$photo = $db->photos->findOne($query);
			$file_path = $folder_path.$actual_read_file_name;
			$full_file_path = $fullsizepath.$actual_read_file_name;
			$extension = strtolower(pathinfo($actual_read_file_name ,PATHINFO_EXTENSION));
			if($extension=='jpg' || $extension =='png') 
			{
						
				if($photo['prywatnosc'] === 'public') {
					?>
					<a href="<?php echo $full_file_path; ?>" target="_blank"><img src="<?php echo $file_path; ?>"/></a>
					<p><?php
					
					echo "Title: " . $photo['title'];?></br><?php
					echo "Author: " . $photo['author'];?></br></p>
					<input type="checkbox" name="if_chosen[<?php echo $lp ?>]" value="<?php echo $photo['file_name']?>" checked>Zaznacz zdjęcie<br>
					<?php
					$lp = $lp + 1;
				}
				if($photo['prywatnosc'] === 'private' && isset($_SESSION['user_id'])) {
					if($photo['author'] === $_SESSION['user_id']) {
						?>
						<a href="<?php echo $full_file_path; ?>" target="_blank"><img src="<?php echo $file_path; ?>"/></a>
						<p><?php
						echo "Zdjecie prywatne zalogowanego uzytkownika!"?></br><?php
						echo "Title: " . $photo['title'];?></br><?php
						echo "Author: " . $photo['author'];?></br></p>
						<input type="checkbox" name="if_chosen[<?php echo $lp ?>]" value="<?php echo $photo['file_name']?>" checked>Zaznacz zdjęcie<br>
						<?php
						$lp = $lp + 1;
					}
				}	
			}
		}
		?><input type="submit" value="Wyświetl wybrane zdjęcia w osobnej galerii" name="choose_photos"/>
		</form><?php
	}
	else
	{
		echo "the folder was empty !";
	}
	closedir($folder);
?>