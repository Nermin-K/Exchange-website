<?php
require_once("assets/validation_functions.php");
require_once("assets/functions.php");
require_once("assets/session.php");
require_once("assets/classes/user.php");
require_once("assets/db_connection.php");


if ($_POST["submit"] && isset($_GET['id']))
{
    $u=$_GET["id"];
    $errors=array();
    $requiredFields= array ("F_name" , "L_name" , "E-mail", "password", "Facebook-Account");
    $errors=validatePresence($requiredFields , $errors);


   $length= array ("F_name"=>50 , "L_name"=>50 , "password"=>100 , "phone_number"=>15);
    foreach ($length as $field=>$maximum)
    {
        if (!isMax($_POST[$field] , $maximum))
            $errors[]=$field . " is too long";
    }


    if (!validateEmail($_POST["E-mail"]))
        $errors[]= "Invalid E-mail format";

    if (!validateFB($_POST["Facebook-Account"]))
        $errors[]= "Incorrect Facebook URL";

    $user=new user($connection);
    $found=$user->getUserByEmail($_POST["E-mail"]);

    if(!empty($found) && $found["Id"] != $_GET["id"])
     $errors[]="this email belongs to another user";

    //na2es elimage
    if (empty($errors))
    {
        $firstName= $_POST["F_name"];
        $lastName=$_POST["L_name"];
        $email=$_POST["E-mail"];
        $password=$_POST["password"];
        $facebookAccount=$_POST["Facebook-Account"];
        $image=updateImage($_POST["i"]);
        $phoneNumber=$_POST["phone_number"];

        if (($user->updateUser($u ,$firstName, $lastName , $password , $phoneNumber , $image ,$email , $facebookAccount))==1)
        {
            $_SESSION["message"]="Account updated successfully";

        }
        else
        {
            $_SESSION["message"]="Account Not Updated"; //parameters were correct but databas error
        }

        redirect_to("account.php?user={$u}");

    }
    else
    {
        $_SESSION["errors"]=$errors;
        redirect_to("editprofile.php?user={$u}");
    }

}