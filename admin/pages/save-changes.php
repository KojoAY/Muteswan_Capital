<?php 
ob_start();
require_once("../_inc/config.php");

$PAGE_INFO = addslashes($_POST['PAGE_INFO']);

$UPDATE_TIME = strtotime("now");
$UPDATE = "UPDATE acms_pages SET
		page_title			= '$_POST[PAGE_TITLE]',
		page_content		= '$PAGE_INFO',
		page_update			= '$UPDATE_TIME'
		WHERE page_menu_id	= '$_POST[PAGE_ID]'";
$_CON->query($UPDATE);

if($_CON){
	echo "<div id=\"success\">Changes have been saved!</div>";
} else {
	echo "<div id=\"error\">Could not save changes!</div>";
}
ob_flush();
?>