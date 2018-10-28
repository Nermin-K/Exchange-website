<!-- VERSION #1.0 , lAST EDITED BY MAYAR -->
<?php require_once("assets/layouts/header.php")?>
<?php
function __autoload ($class_name)
{
    require_once("assets/classes/".$class_name.".php");
}
?>
<?php require_once("assets/db_connection.php")?>
<?php require_once("assets/functions.php")?>
<?php require_once("assets/session.php")?>
<?php
// need category, item id and session "user_id"
$category;
$itemID;
$obj;
$item;
if (isset($_SESSION["id"]) &&isset($_GET["category"])&& isset($_GET["item"])) {

    $category = $_GET["category"];
    $itemID=$_GET["item"];
    $obj=getCategory($category , $connection);

    if(!isset($obj))
    {
        redirect_to("index.php");
    }


   $item= $obj->getItemById($itemID);

}
else
{

    redirect_to("login.php"); // or to index .php
}


?>


<div class="register_account">
    <div class="wrap">
        <h4 class="title">Update Item</h4>
        <?php echo sessionErrors(); ?>
        <form action = "itemUpdate.php?category=<?php echo urlencode($category); ?>&item=<?php echo urlencode($itemID); ?>" method = "post" enctype="multipart/form-data">
            <div class="col_1_of_2 span_1_of_2">


                <div><label for="name: ">Name </label><input type="text" name="name" value="<?php echo htmlentities($item['Name']); ?>"  ></div>
                <div><label for="price: ">Price </label><input type="text" name="price" value="<?php echo htmlentities($item['Price']); ?>"></div>
               <br /> <div><label for="image" >Image </label><input type="file" name="image" class="btn btn-default" value="image" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'image';}"></div>
               <br />
                <input type="text" style="display: none;" name="i" value="<?php echo htmlentities($item['image']); ?>">
                <?php
                    if ($category !='tickets')
                    {
                        echo displayAvailability($item);
                    }
                ?>




                <div>
                    <label for="description: ">Description </label>
                    <textarea name="description"  rows="5" cols="79" ><?php echo htmlentities($item['Description']); ?></textarea>
                </div>

                 <?php //need to decide if i'm gonna let the user edit categories ?>

                <input type="submit" name ="submit" class="grey" value="submit" />
            </div>
            <div class="clear"></div>
        </form>
    </div>
</div>

<?php require_once("assets/layouts/footer.php")?>