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
if (isset($_SESSION["id"]) &&isset($_GET["category"])&& isset($_GET["item"])) {
    $itemId = $_GET["item"];
    $cat = $_GET["category"];
    $obj = getCategory($cat, $connection);
    //call check wished before adding wish
    if ($obj)
    {
        $u =new user($connection);
        $i=$obj->getItemById($itemId);
        $owner = $u->getUserById($i["User_id"]);


        if($owner["Id"]==$_SESSION["id"]){
            $_SESSION['message']="You can't add your product to your wishlist";
            echo "adding your own product";
            redirect_to("product-details.php?category=" . $cat . "&id=" . $itemId);
        }
        if($obj->checkWished($itemId ,$_SESSION["id"] ))
        {
            if ($obj->addWish($itemId, $_SESSION["id"]) ==1 )

            $_SESSION['message']="added to wish list successfully";
            else{
                $_SESSION['message']="Item not added to wish list";
            }
            redirect_to("product-details.php?category=" . $cat . "&id=" . $itemId);
        }
        else
        {
            $_SESSION['message']="Item is already in your wishlist";
            redirect_to("product-details.php?category=" . $cat . "&id=" . $itemId);
        }
    }

}
else
{
    //unregistered user or invalid parameters
    redirect_to("login.php");
}
?>