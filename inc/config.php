<?php
// Connect database.
$_CON = new PDO("mysql:host=localhost;dbname=muteswan_db", "muteswan_dbuser", "9FAC!k]XRRn]");
//$_CON = new PDO("mysql:host=localhost;dbname=muteswandb", "root", "");


function GET_CONTENT($PAGE_ID, $_CON){	
	$SQLCONTENT = "SELECT * FROM acms_pages WHERE page_menu_id = '$PAGE_ID'";
	$RESCONTENT = $_CON->query($SQLCONTENT);
	while($ROWCONTENT = $RESCONTENT->fetch(PDO::FETCH_ASSOC)){
		echo stripslashes($ROWCONTENT['page_title']) . '</article>';
		echo '<h1>' . stripslashes($ROWCONTENT['page_title']) . '</h1>';
		echo '<p>' . stripslashes($ROWCONTENT['page_content']) . '</p>';
	}
}


