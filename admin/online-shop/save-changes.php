<?php
require_once("../_inc/config.php");
require_once("../_lib/assignments.php");


	@$filename			= $_FILES['BOOK_PHOTO']['name'];
	@$temporary_name	= $_FILES['BOOK_PHOTO']['tmp_name'];
	@$mimetype			= $_FILES['BOOK_PHOTO']['type'];
	@$filesize			= $_FILES['BOOK_PHOTO']['size'];
	
	//if($filename != '' || !empty($filename)){
		if($filesize > 0){
			$RAND = rand('111', '999');
			$imgName = (strtotime('now')+$RAND) . '.jpg';
		} else {
			$imgName = $_POST['BOOK_PHOTO_EX'];
		}
		
		
		if($filename != ''){
			//Open the image using the imagecreatefrom..() command based on the MIME type.
			switch($mimetype) {
				case "image/jpg":
				case "image/jpeg":
					$i = imagecreatefromjpeg($temporary_name);
					break;
				case "image/gif":
					$i = imagecreatefromgif($temporary_name);
					break;
				case "image/png":
					$i = imagecreatefrompng($temporary_name);
					break;
			}
		
			//Delete the uploaded file
			@unlink($temporary_name);
		
			//Specify the size of the original photo
			$imgd_x = 240;
			$imgd_y = 300;
			
			//Is the original bigger than the thumbnail dimensions?
			if (imagesx($i) > $imgd_x or imagesy($i) > $imgd_y) {
				//Is the width of the original bigger than the height?
				if (imagesx($i) >= imagesy($i)) {
					$_x = $imgd_x;
					$_y = imagesy($i)*($imgd_x/imagesx($i));
					
				} else {
					$_x = imagesx($i)*($imgd_y/imagesy($i));
					$_y = $imgd_y;
				}
			} else {
				//Using the original dimensions for original
				$_x = imagesx($i);
				$_y = imagesy($i);
			}
			
		
			//Generate a new image at the size of the original
			$orig = imagecreatetruecolor($_x, $_y);
			
		
			//Copy the original image data to it using resampling
			imagecopyresampled($orig, $i , 0, 0, 0, 0, $_x, $_y, imagesx($i), imagesy($i));
			
			
			//Save a copy of the original
			imagejpeg($orig, "../../_photos/" . $imgName . "", 90);
		}
	
	
	switch($_POST['BOOK_CURR']){
		case "$":
			$CURR = '2';
			break;
		case "&pound;":
		case "£":
			$CURR = '3';
			break;
	}
	
	$PHOTOS 		= $imgName;
	$PHOTOS_FOLDER	= '_photos/';
	
	$BOOK_TITLE = addslashes($_POST['BOOK_TITLE']);
	$BOOK_DETAILS = addslashes($_POST['BOOK_EDITOR']);
	
	if($_POST['BOOK_STAT'] == 'New') {
		$INSBOOKS = "INSERT INTO acms_online_shop_list SET
					ols_ref_id			= '$_POST[BOOK_REF_ID]',
					ols_title			= '$BOOK_TITLE',
					ols_description		= '$BOOK_DETAILS',
					ols_curr			= '$CURR',
					ols_price			= '$_POST[BOOK_PRICE]',
					ols_photos			= '$PHOTOS',
					ols_photos_folder	= '$PHOTOS_FOLDER'";
		mysql_query($INSBOOKS, _CON);
		
		if(mysql_affected_rows(_CON) >= 1){
			echo "<div id=\"success\">Changes have been saved!</div>";
		} else {
			echo "<div id=\"error\">Could not save changes!</div>";
		}
		
	} elseif($_POST['BOOK_STAT'] == 'Edit') {
		$UPDBOOK = "UPDATE acms_online_shop_list SET
					ols_title			= '$BOOK_TITLE',
					ols_description		= '$BOOK_DETAILS',
					ols_curr			= '$CURR',
					ols_price			= '$_POST[BOOK_PRICE]',
					ols_photos			= '$PHOTOS',
					ols_photos_folder	= '$PHOTOS_FOLDER'
					WHERE ols_ref_id	= '$_POST[BOOK_REF_ID]'";
		mysql_query($UPDBOOK, _CON);
		
		if(mysql_affected_rows(_CON) >= 1){
			echo "<div id=\"success\">Changes have been saved!</div>";
		} else {
			echo "<div id=\"error\">Could not save changes!</div>";
		}
	}
//}
?>