<?php
require_once("../_inc/config.php");
require_once("../_lib/assignments.php");


$INFO = addslashes(trim($_POST['ART_DETAILS']));
$TITLE = addslashes(trim($_POST['ART_TITLE']));
	
	
/*switch($_POST['ART_ED']){
	case '3':
		$ART_TYPE = 'Lifestyle';
		break;
	case '5':
		$ART_TYPE = 'Self-Love';
		break;
	default:
		$ART_TYPE = '';
		break;
}*/

$ART_TYPE = $_POST['ART_ED'];


$POSTDATE = $_POST['ART_POSTDATE'];
$UPDATE = strtotime("now");

if($_POST['ART_STAT'] == 'New') {
		$INSARTS = "INSERT INTO acms_articles_list SET
					alist_type			= '1',
					alist_title			= '$TITLE',
					alist_details		= '$INFO',
					alist_tags 			= '$_POST[ART_TAGS]',
					alist_postdate 		= '$POSTDATE',
					alist_update 		= 'Not Yet',
					alist_visible 		= '$_POST[ART_VISIBLE]'";
		//$_CON->query($INSARTS);
		
		if($_CON->query($INSARTS)){
			echo "<div id=\"success\">Changes have been saved!</div>";
		} else {
			echo "<div id=\"error\">Could not save changes!</div>";
		}
		
	} elseif($_POST['ART_STAT'] == 'Edit') {
		$INSARTS = "UPDATE acms_articles_list SET
					alist_type			= '$ART_TYPE',
					alist_title			= '$TITLE',
					alist_details		= '$INFO',
					alist_tags 			= '$_POST[ART_TAGS]',
					alist_update 		= '$UPDATE',
					alist_visible 		= '$_POST[ART_VISIBLE]'
					WHERE alist_postdate = '$POSTDATE'";
		//$_CON->query($INSARTS);
		
		if($_CON->query($INSARTS)){
			echo "<div id=\"success\">Changes have been saved!</div>";
		} else {
			echo "<div id=\"error\">Could not save changes!</div>";
		}
		
	}
/*
if($ART_TYPE == '3' || $ART_TYPE == '5' || $ART_TYPE == '4' || $ART_TYPE == '12'){

	$filename			= $_FILES['ART_PHOTO']['name'];
	@$temporary_name	= $_FILES['ART_PHOTO']['tmp_name'];
	@$mimetype			= $_FILES['ART_PHOTO']['type'];
	@$filesize			= $_FILES['ART_PHOTO']['size'];
	
	//if($filename != '' || !empty($filename)){
		if($filesize > 0){
			$RAND = rand('111', '999');
			$imgName = (strtotime('now')+$RAND) . '.jpg';
		} else {
			$imgName = $_POST['ART_PHOTO_EX'];
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
			$imgd_x = 800;
			$imgd_y = 800;
			
			$img_tiny_x = 150;
			$img_tiny_y = 150;
			
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
			
			
			//Is the thumbnail dimensions?
			if (imagesx($i) > $img_tiny_x or imagesy($i) > $img_tiny_y) {
				//Is the width of the original bigger than the height?
				if (imagesx($i) >= imagesy($i)) {
					$tiny_x = $img_tiny_x;
					$tiny_y = imagesy($i)*($img_tiny_x/imagesx($i));
					
				} else {
					$tiny_x = imagesx($i)*($img_tiny_y/imagesy($i));
					$tiny_y = $img_tiny_y;
				}
			} else {
				//Using the original dimensions for original
				$tiny_x = imagesx($i);
				$tiny_y = imagesy($i);
			}
			
		
			//Generate a new image at the size of the original
			$orig = imagecreatetruecolor($_x, $_y);
			
			//Generate a new image at the size of the original
			$tiny = imagecreatetruecolor($tiny_x, $tiny_y);
			
		
		
			//Copy the original image data to it using resampling
			imagecopyresampled($orig, $i , 0, 0, 0, 0, $_x, $_y, imagesx($i), imagesy($i));
			
			//Copy the original image data to it using resampling
			imagecopyresampled($tiny, $i , 0, 0, 0, 0, $tiny_x, $tiny_y, imagesx($i), imagesy($i));
			
			
			
			//Save a copy of the original
			imagejpeg($orig, "../../_photos/" . $imgName . "", 90);
			
			//Save a copy of the original
			imagejpeg($tiny, "../../_photos/tiny_" . $imgName . "", 90);
		}
	
	
	$PHOTOS 		= $imgName;
	$PHOTOS_FOLDER	= '_photos/';
	
	
	
}

elseif($ART_TYPE == '5'){
	if($_POST['ART_STAT'] == 'New') {
		$INSARTS = "INSERT INTO acms_articles_list SET
					alist_type			= '$ART_TYPE',
					alist_title			= '$TITLE',
					alist_details		= '$INFO',
					alist_ext_link		= '$_POST[ART_LINK]',
					alist_tags 			= '$_POST[ART_TAGS]',
					alist_postdate 		= '$POSTDATE',
					alist_update 		= 'Not Yet',
					alist_visible 		= '$_POST[ART_VISIBLE]'";
		//$_CON->query($INSARTS);
		
		if($_CON->query($INSARTS)){
			echo "<div id=\"success\">Changes have been saved!</div>";
		} else {
			echo "<div id=\"error\">Could not save changes!</div>";
		}
		
	} elseif($_POST['ART_STAT'] == 'Edit') {
		$INSARTS = "UPDATE acms_articles_list SET
					alist_type			= '$ART_TYPE',
					alist_title			= '$TITLE',
					alist_details		= '$INFO',
					alist_ext_link		= '$_POST[ART_LINK]',
					alist_tags 			= '$_POST[ART_TAGS]',
					alist_update 		= '$UPDATE',
					alist_visible 		= '$_POST[ART_VISIBLE]'
					WHERE alist_postdate = '$POSTDATE'";
		//$_CON->query($INSARTS);
		
		if($_CON->query($INSARTS)){
			echo "<div id=\"success\">Changes have been saved!</div>";
		} else {
			echo "<div id=\"error\">Could not save changes!</div>";
		}
		
	}
}

elseif($ART_TYPE == '6'){
	if($_POST['ART_STAT'] == 'New') {
		$INSARTS = "INSERT INTO acms_articles_list SET
					alist_type			= '$ART_TYPE',
					alist_title			= '$TITLE',
					alist_details		= '$INFO',
					alist_tags 			= '$_POST[ART_TAGS]',
					alist_postdate 		= '$POSTDATE',
					alist_update 		= 'Not Yet',
					alist_visible 		= '$_POST[ART_VISIBLE]'";
		//$_CON->query($INSARTS);
		
		if($_CON->query($INSARTS)){
			echo "<div id=\"success\">Changes have been saved!</div>";
		} else {
			echo "<div id=\"error\">Could not save changes!</div>";
		}
		
	} elseif($_POST['ART_STAT'] == 'Edit') {
		$INSARTS = "UPDATE acms_articles_list SET
					alist_type			= '$ART_TYPE',
					alist_title			= '$TITLE',
					alist_details		= '$INFO',
					alist_tags 			= '$_POST[ART_TAGS]',
					alist_update 		= '$UPDATE',
					alist_visible 		= '$_POST[ART_VISIBLE]'
					WHERE alist_postdate = '$POSTDATE'";
		//$_CON->query($INSARTS);
		
		if($_CON->query($INSARTS)){
			echo "<div id=\"success\">Changes have been saved!</div>";
		} else {
			echo "<div id=\"error\">Could not save changes!</div>";
		}
		
	}
}*/
?>