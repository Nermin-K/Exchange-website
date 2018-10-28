<?php
require_once("assets/functions.php");
require_once("assets/classes/user.php");
require_once("assets/db_connection.php");
require_once("assets/session.php");
if (!isset($_SESSION["id"]))
{
    redirect_to("login.php");

}else{
    $u = new user($connection);
    $res  =$u->deleteUser($_SESSION["id"]);
    if ($res==1) {
        $_SESSION["id"]=NULL;
        redirect_to("index.php");

        }

    else {
        $_SESSION['message']="There was an error in deleting your account";
        redirect_to("account.php?user={$_SESSION['id']}");
    }
}