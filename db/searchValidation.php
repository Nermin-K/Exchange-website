<?php require_once("assets/db_connection.php");?>
<?php
    function __autoload ($class_name)
	{
		require_once("assets/classes/".$class_name.".php");
	}
?>
<?php require_once("assets/session.php");?>
<?php
function redirect_to ($newLocation){
		header ("Location: ". $newLocation);
		exit;
	}

	function has_presence($value){
		return (isset($value) && $value !=="");
	}	
?>
<?php
	
	if($_POST["category"] == "category" || !has_presence(trim($_POST["itname"])))
		redirect_to("index.php");
	
	$page ="products.php?category=".urlencode($_POST["category"]). "&name=". urlencode($_POST["itname"]);
	redirect_to($page);
?>