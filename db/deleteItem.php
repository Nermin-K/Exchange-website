<?php

function __autoload ($class_name)
{
    require_once("assets/classes/".$class_name.".php");
}
?>
<?php require_once("assets/db_connection.php")?>
<?php require_once("assets/functions.php")?>
<?php require_once("assets/validation_functions.php")?>
<?php require_once("assets/session.php")?>
<?php
// need category, item id and session "user_id"
$category;
$itemID;
$obj;

if (isset($_SESSION["id"]) &&isset($_GET["category"])&& isset($_GET["item"])) {

    $category = $_GET["category"];
    $itemID=$_GET["item"];
    $obj=getCategory($category , $connection);
    if(!isset($obj))
        redirect_to("index.php");
}
else
{

    redirect_to("login.php"); // or to index .php
}


$deleted=$obj->deleteItem($itemID);


        if ($deleted==1)
        {
            $_SESSION["message"]="Item deleted successfully";
            redirect_to("account.php?user={$_SESSION['id']}");

        }
        else
        {
            $_SESSION["message"]="Item Not Deleted"; //parameters were correct but database error
            redirect_to("product-details.php?category={$category}&id={$itemID}");
        }




