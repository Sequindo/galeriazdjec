<?php
	require_once 'business.php';
	if_no_chosen();
	$if_chosen = $_POST['if_chosen'];
	

	$duzy_folder = 'watermarks/';
	$folder = 'miniatures/';
	$pliki = scandir($folder);
	$ilosc_plikow = count($pliki)-2;
	$lp = 0;
	if(count($if_chosen) > 0)
	{
	?><form action="show_chosen_view.php" method="post"><?php
	 for($i=0;$i<$ilosc_plikow;$i++)
	 {
				if(isset($if_chosen[$i])) 
				{
					?><a href="<?php echo $duzy_folder . $if_chosen[$i]; ?>" target="_blank"><img src="<?php echo $folder . $if_chosen[$i]; ?>"/></a>
					<?php
					$db = get_db();
					$query = [
						'file_name' => $if_chosen[$i]
					];
					$photo = $db->photos->findOne($query);
					?>
					<p><?php
					echo "Title: " . $photo['title'];?></br><?php
					echo "Author: " . $photo['author'];?></br></p>
					<input type="checkbox" name="if_chosen[<?php echo $lp ?>]" value="<?php echo $photo['file_name']?>" checked>Zaznacz zdjęcie<br>
					<?php
					$lp = $lp + 1;	
				}
	  }
	  ?><input type="submit" value="Usuń ODZNACZONE z zapamiętanych" name="choose_photos"/>
	  <a href="index.php">Powrót do galerii ogólnej...</a>
	 </form><?php
	}
?>

