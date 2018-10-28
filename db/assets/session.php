<?php
	session_start();

 //any functions that use session should be here

	function sessionErrors (){
		$output="";
		if(isset($_SESSION["errors"]))
		{
			$array=$_SESSION["errors"];
			$output.="<div class='errors'><ul>";
			foreach($array as $error)
			{
				$output.="<li>{$error}</li>";
			}
			$output.="</ul></div>";
			$_SESSION["errors"]=NULL;
		}

		return $output;
	}

	function sessionMessages(){
		$output="";
		if(isset($_SESSION["message"]))
		{
			$msg=$_SESSION["message"];
			$output.="<div class='errors'><ul>";

				$output.=$msg."</div>";

			$_SESSION["message"]=NULL;
		}

		return $output;

	}
?>