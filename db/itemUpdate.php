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
    $obj=getCategory($category,$connection);
    //redirect if object=null
    if(!isset($obj))
        redirect_to("index.php");
}
else
{

    redirect_to("login.php"); // or to index .php
}



if ($_POST["submit"])
{

    $errors=array();
    $requiredFields= array ("name" , "price");
    $errors=validatePresence($requiredFields , $errors);


    $length= array ("name"=>100 , "L_name"=>50 , "password"=>100 , "phone_number"=>15);
    foreach ($length as $field=>$maximum)
    {
        if (!isMax($_POST["name"] , 100))
            $errors[]="Name is too long";
    }



    //na2es elimage
    if (empty($errors))
    {
        $updated;

        $n= $_POST["name"];
        $p= (float)$_POST["price"];
        $d=$_POST["description"];

        if ($category != 'tickets')
        {
            $a=$_POST['available'];
            $updated=$obj->updateItem($itemID,$n ,$p,$d ,$a ,updateImage($_POST["i"]));
        }
        else
        {
            $updated=$obj->updateItem($itemID,$n ,$p,$d ,updateImage($_POST["i"]));
        }


        if ($updated==1)
        {
            $_SESSION["message"]="Item updated successfully";
            redirect_to("product-details.php?category={$category}&id={$itemID}");

        }
        else
        {
            $_SESSION["message"]="Item  Not Updated"; //parameters were correct but databas error
            redirect_to("account.php?user={$_SESSION['id']}");
        }



    }
    else
    {

        $_SESSION["errors"]=$errors;


        redirect_to("updateItem.php?category={$category}&item={$itemID}");
    }

}
