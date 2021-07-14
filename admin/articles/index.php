<?php require_once("../_themes/default.php");

switch (@$_GET['ftk']){
	case "":
	case "List":
		include("list.php");
		break;
	case "Edit":
		include("edit.php");
		break;
	case "Add New":
		include("add-new.php");
		break;
	case "Delete":
		include("delete.php");
		break;
	case "Search":
		include("search.php");
		break;
}
?>




</body>
</html>