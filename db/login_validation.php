<?php
require_once("assets/validation_functions.php");
require_once("assets/functions.php");
require_once("assets/db_connection.php");
require_once("assets/classes/user.php");
require_once("assets/session.php");
if(isset($_POST["submit"]))
{
   $errors=array();
   $required_fields=array("email","password");
   $errors = validatePresence ($required_fields , $errors);
   if(!empty($errors))
   {
         $_SESSION["errors"]=$errors;
         redirect_to("login.php");

   }
   else
   {
   	    $obj= new user($connection);
   	    $result=$obj->getUserId($_POST["password"],$_POST["email"]);
   	    if($result==-1)
   	    {
			$_SESSION['message']="There was an error in connection";
   	    	redirect_to("login.php");


   	    }
   	    if($result==-2)
   	    {
   	    	$errors["found"]="E-mail and password don't match.";
   	    	$_SESSION["errors"]=$errors;
   	    	redirect_to("login.php");
   	    }
   	    else
   	    {    
            $_SESSION["id"]=$result;
            redirect_to("account.php?user=".$result);


   	    }

    



   }


}
else redirect_to("login.php");



?>