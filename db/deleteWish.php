<?php require_once("assets/db_connection.php");?>
<?php
require("assets/layouts/header.php");
?>
<?php
require_once("assets/functions.php");
require_once("assets/session.php");
?>

<?php
    function __autoload ($class_name)
    {
        require_once("assets/classes/".$class_name.".php");
    }
?>
<?php

?>

<?php
if (isset($_SESSION["id"]) &&isset($_GET["category"])&& isset($_GET["item"])) {
    $itemId = $_GET["item"];
    $cat = $_GET["category"];
    $obj = getCategory($cat, $connection);

   IF( isset($obj)) {

        if( !($obj->checkWished($itemId ,$_SESSION["id"] )))
        {
           if ( ($obj->deleteWish($itemId, $_SESSION["id"]) )==1)
           {
               $_SESSION['message']="removed wish list successfully";
               redirect_to("product-details.php?category=" . $cat . "&id=" . $itemId);

           }else
           {

               $_SESSION['message']="There was an error in remvoving this item";
               redirect_to("product-details.php?category=" . $cat . "&id=" . $itemId);
           }


        }
        else
        {
            $_SESSION['message']="Item wasn't in your wishlist";
            redirect_to("product-details.php?category=" . $cat . "&id=" . $itemId);
        }
    }
    else{
        redirect_to("index.php");
    }

}
else
{

    redirect_to("login.php");
}
?>