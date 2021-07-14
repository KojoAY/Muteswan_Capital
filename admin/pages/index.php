<?php 
ob_start();
require_once("../_themes/default.php");

switch (@$_GET['ftk']){
	case "":
	case "List":
		include("list.php");
		break;
	case "Edit":
		include("edit.php");
		break;
	case "Delete":
		include("delete.php");
		break;
}
ob_flush();
?>

</body>
</html>