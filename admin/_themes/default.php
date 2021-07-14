<?php 
require_once("../_inc/config.php");
require_once("../_lib/assignments.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Anipa CMS</title>
<link type="text/css" rel="stylesheet" href="../_css/anipacms_styles.css">
<link type="text/css" rel="stylesheet" href="../_css/anipacms_forms_styles.css">
<link type="text/css" rel="stylesheet" href="../_css/font-awesome.css">
<link type="text/css" rel="stylesheet" href="feature-style.css">

<script type="text/javascript" src="../_js/jquery.min.js"></script>
<script type="text/javascript" src="feature-script.js"></script>
<script type="text/javascript" src="../_js/anipa-gen-script.js"></script>
<script type="text/javascript" src="../_js/jquery-ui.js"></script>

<script>
$(function() {
	$( "#datepicker" ).datepicker();
});
</script>

<script type="text/javascript" src="../_dist/wysiwyg.min.js"></script>
<script type="text/javascript" src="../_dist/wysiwyg-editor.min.js"></script>
<script type="text/javascript" src="../_js/wysiwyg-script.js"></script>

<link rel="stylesheet" type="text/css" href="../_src/wysiwyg-editor.css" />

</head>

<body>

<section class="top-bar">
	<a href="#" id="menu-bars"><i class="fa fa-bars"></i><i id="angle" class="fa fa-angle-down"></i></a>
	<img src="../_images/logo.gif" id="anipa">
	<ul>
        <li id="msg"><a href="#"><i class="fa fa-comments"></i> <sub>0</sub></a></li>
        <li>
        	<div><i class="fa fa-user" id="uicon"></i> <a href="#">Admin <i class="fa fa-angle-down"></i></a></div>
        </li>
    </ul>
</section>
<nav class="anipa-features">
	<?php 
	$CNT_REC = 0;
	echo '<ul>
			<li class="sor">';
	$SQLFEATURES = "SELECT * FROM acms_features WHERE feat_group = '1' AND feat_visible = '1' ORDER by feat_id";
	$RESFEATURES = $_CON->query($SQLFEATURES);
	while($ROWFEATURES = $RESFEATURES->fetch(PDO::FETCH_ASSOC)){
		if($ROWFEATURES["feat_id"] == '3' || $ROWFEATURES["feat_id"] == '4'){
			echo (@$_GET['tk'] == md5($ROWFEATURES["feat_id"]))
					? '<a href="../'. $ROWFEATURES["feat_folder"] . '/?tk='. md5($ROWFEATURES["feat_id"]) . '" id="act"><sup>0</sup><i class="fa fa-'. $ROWFEATURES["feat_icon"] . '"></i>'. $ROWFEATURES["feat_name"] . '</a>'
					: '<a href="../'. $ROWFEATURES["feat_folder"] . '/?tk='. md5($ROWFEATURES["feat_id"]) . '"><sup>0</sup><i class="fa fa-'. $ROWFEATURES["feat_icon"] . '"></i>'. $ROWFEATURES["feat_name"] . '</a>';
		} else {
			echo (@$_GET['tk'] == md5($ROWFEATURES["feat_id"]))
					? '<a href="../'. $ROWFEATURES["feat_folder"] . '/?tk='. md5($ROWFEATURES["feat_id"]) . '" id="act"><i class="fa fa-'. $ROWFEATURES["feat_icon"] . '"></i>'. $ROWFEATURES["feat_name"] . '</a>'
					: '<a href="../'. $ROWFEATURES["feat_folder"] . '/?tk='. md5($ROWFEATURES["feat_id"]) . '"><i class="fa fa-'. $ROWFEATURES["feat_icon"] . '"></i>'. $ROWFEATURES["feat_name"] . '</a>';
		}
		
		$CNT_REC = 1;
	}
	echo '</li>';
	/*if(mysql_affected_rows(_CON)){
		$SQLFEATURES = "SELECT * FROM acms_features WHERE feat_group = '2' AND feat_visible = '1' ORDER by feat_id";
		$RESFEATURES = mysql_query($SQLFEATURES, _CON);
		while($ROWFEATURES = mysql_fetch_array($RESFEATURES, MYSQL_ASSOC)){
				if(@$_GET['tk'] == md5($ROWFEATURES["feat_id"])){
					echo '<li><a href="../'. $ROWFEATURES["feat_folder"] . '/?tk='. md5($ROWFEATURES["feat_id"]) . '" id="act"><i class="fa fa-'. $ROWFEATURES["feat_icon"] . '"></i>'. $ROWFEATURES["feat_name"] . '<span class="fa fa-chevron-down"></span></a>
					<aside>';
					SUB_FEATURE($ROWFEATURES["feat_id"], $ROWFEATURES["feat_folder"]);
					echo 
					'</aside></li>';
				}
				else{
					echo '<li><a href="../'. $ROWFEATURES["feat_folder"] . '/?tk='. md5($ROWFEATURES["feat_id"]) . '"><i class="fa fa-'. $ROWFEATURES["feat_icon"] . '"></i>'. $ROWFEATURES["feat_name"] . '<span class="fa fa-chevron-right"></span></a>
					<nav>';
					SUB_FEATURE($ROWFEATURES["feat_id"], $ROWFEATURES["feat_folder"]);
					echo 
					'</nav></li>';
				}
		}
	echo '</ul>';
	}*/
	
	if($CNT_REC > 0){
		$SQLFEATURES = "SELECT * FROM acms_features WHERE feat_group = '2' AND feat_visible = '1' ORDER by feat_id";
		$RESFEATURES = $_CON->query($SQLFEATURES);
		while($ROWFEATURES = $RESFEATURES->fetch(PDO::FETCH_ASSOC)){
				if(@$_GET['tk'] == md5($ROWFEATURES["feat_id"])){
					echo '<li><a id="act"><i class="fa fa-'. $ROWFEATURES["feat_icon"] . '"></i>'. $ROWFEATURES["feat_name"] . '<span class="fa fa-chevron-down"></span></a>
					<aside>';
					SUB_FEATURE($ROWFEATURES["feat_id"], $ROWFEATURES["feat_folder"], $_CON);
					echo 
					'</aside></li>';
				}
				else{
					echo '<li><a><i class="fa fa-'. $ROWFEATURES["feat_icon"] . '"></i>'. $ROWFEATURES["feat_name"] . '<span class="fa fa-chevron-right"></span></a>
					<nav>';
					SUB_FEATURE($ROWFEATURES["feat_id"], $ROWFEATURES["feat_folder"], $_CON);
					echo 
					'</nav></li>';
				}
		}
	echo '</ul>';
	}
	
	
	function SUB_FEATURE($MAIN_FEAT_ID, $MAIN_FEAT_FOLDER, $_CON){
		
		$SQLSUB_FEAT = "SELECT * FROM acms_main_menu WHERE mmenu_feature = '$MAIN_FEAT_ID' AND mmenu_visible = '1'";
		$RESSUB_FEAT = $_CON->query($SQLSUB_FEAT);
		while($ROWSUB_FEAT = $RESSUB_FEAT->fetch(PDO::FETCH_ASSOC)){
			if($ROWSUB_FEAT['mmenu_id'] == @$_GET['ed']){
				if ($_GET['ed'] == '9' || $ROWSUB_FEAT['mmenu_id'] == '9'){
					echo '<a href="../' . $MAIN_FEAT_FOLDER . '/?tk=' . md5($MAIN_FEAT_ID) . '&ftk=List&ed=' . $ROWSUB_FEAT['mmenu_id'] . '" id="act">' . $ROWSUB_FEAT['mmenu_name'] . '</a>';
				} else {
					echo '<a href="../' . $MAIN_FEAT_FOLDER . '/?tk=' . md5($MAIN_FEAT_ID) . '&ftk=Edit&ed=' . $ROWSUB_FEAT['mmenu_id'] . '" id="act">' . $ROWSUB_FEAT['mmenu_name'] . '</a>';
				}
			}
			else{
				if ($_GET['ed'] == '9'){
					echo '<a href="../' . $MAIN_FEAT_FOLDER . '/?tk=' . md5($MAIN_FEAT_ID) . '&ftk=List&ed=' . $ROWSUB_FEAT['mmenu_id'] . '">' . $ROWSUB_FEAT['mmenu_name'] . '</a>';
				} else {
					echo '<a href="../' . $MAIN_FEAT_FOLDER . '/?tk=' . md5($MAIN_FEAT_ID) . '&ftk=Edit&ed=' . $ROWSUB_FEAT['mmenu_id'] . '">' . $ROWSUB_FEAT['mmenu_name'] . '</a>';
				}
				//echo '<a href="../' . $MAIN_FEAT_FOLDER . '/?tk=' . md5($MAIN_FEAT_ID) . '&ftk=Edit&ed=' . $ROWSUB_FEAT['mmenu_id'] . '">' . $ROWSUB_FEAT['mmenu_name'] . '</a>';
			}
		}
		
	}
	?>
	
    	
</nav>

<div id="stat"></div>
<footer>&copy;2016 Anipa CMS v4.0</footer>