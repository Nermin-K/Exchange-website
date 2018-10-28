<!-- VERSION #2.0 , lAST EDITED BY MAI -->
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

   $cat;
    $obj;
    $result;
    if(isset($_GET["category"]) && isset($_GET["id"]))
    {
        $cat=$_GET["category"];
        $itemId = $_GET["id"];
        $obj=getCategory($cat, $connection);
        if(!isset($obj)) {
            redirect_to("index.php");
        } else {
            $result = $obj->getItemById($itemId);
        }
    }else {
        redirect_to("index.php");
    }


?>
<section>
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row margin-top">


        <div class="col-sm-9 padding-right">
            <?php echo sessionMessages(); ?>
            <div class="product-details"><!--GET PRODUCT -->
                <div class="col-sm-5">
                    <div class="view-product">
                       <!-- <img src="img/product.jpg" alt="" />-->
                       <img src= "<?php echo $result["image"] ?>" alt="item image" />
                    </div>
                    <a href="#">
                        <img src="img/flogo.png">

                    </a>
                    &nbsp;
                    <a href="#">
                        <img src="img/tlogo.png">

                    </a>

                </div>
                <div class="col-sm-7">
                    <div class="product-information"><!--/product-information-->
                        <h2><?php echo $result["Name"];?> </h2>
                       <p><i class="fa fa-user"></i> <?php
                           $u=new user($connection);
                           $user =$u->getUserById($result["User_id"]);?>
                           <a href="account.php?user=<?php echo urlencode($user['Id']); ?>" > <?php echo $user["F_name"]." ".$user["L_name"];
                           ?> </a>
                            &nbsp; <i class="fa fa-clock-o"></i> Time:
                           &nbsp; <?php echo $result["Date_time"];?> </p>

                                <span>
                                    <span> <?php echo $result["Price"] . "L.E.";?> </span>
                                   <!-- <button type="button" class="btn btn-fefault cart" onClick="<?php //echo'location.href = addWish.php?
                                    //category='. $result['Category_name'] . '& itemId=' .  $result['Id'] ?>">-->
                                    <?php
                                     $buttonOne;
                                    $buttonTwo;
                                    $page;
                                    $page2;
                                    if (isset($_SESSION['id']) && ($_SESSION['id'] == $result['User_id']))
                                    {
                                        $page = 'updateItem.php?category='. $cat . '& item=' .  $result['Id'];
                                        $page2 = 'deleteItem.php?category='. $cat . '& item=' .  $result['Id'];
                                        $buttonOne="Update";
                                        $buttonTwo="Delete";
                                    }
                                    else
                                    {


                                        $page = 'addWish.php?category='. $cat . '& item=' .  $result['Id'];
                                        $page2 = 'deleteWish.php?category='. $cat . '& item=' .  $result['Id'];
                                        $buttonOne="Add To wishlist";
                                        $buttonTwo="Cancel Wish";
                                    }


                                    ?> 

                                    <button type="button" class="btn btn-fefault cart" id = "Add">
                                        <i class="fa fa-heart"></i>
                                        <?php echo $buttonOne; ?>
                                    </button>

                                    <script>
                                    var btn = document.getElementById('Add');
                                    btn.addEventListener('click', function() {
                                      document.location.href = '<?php echo $page; ?>';
                                    });
                                  </script>

                                  <button type="button" class="btn btn-fefault cart" id = "Delete">
                                        <i class="fa fa-heart"></i>
                                      <?php echo $buttonTwo; ?>
                                    </button>

                                    <script>
                                    var btn = document.getElementById('Delete');
                                    btn.addEventListener('click', function() {
                                      document.location.href = '<?php echo $page2; ?>';
                                    });
                                  </script>

                                </span>
                        <p><?php if (isset($result["Availability"])) 
                        {echo "<b>Availability:</b>"; 
                        $out = $result["Availability"] ? "Available" : "Not Available"; 
                        echo $out;
                        }?></p>
                        <!--for book,tool & ticket-->
                        <P><?php if(isset($result["Category_name"])) echo "<p>Category: </p>" . $result["Category_name"];?>
                        </P>
                        <P><?php if(isset($result["Subcategory_name"])) echo "<p>Subcategory: </p>" . $result["Subcategory_name"];?>
                        </P>
                        <!--For sheet-->
                        <P><?php if(isset($result["Dept_name"])) echo "<p>Department: </p>" . $result["Dept_name"];?>
                        </P>
                        <P><?php if(isset($result["Subject_name"])) echo "<p>Subject: </p>" . $result["Subject_name"];?>
                        </P>
                        <P><?php if(isset($result["Subject_year"])) echo "<p>Year: </p>" . $result["Subject_year"];?>
                        </P>
                        <P><?php if(isset($result["Subject_semester"])) echo "<p>Semester: </p>" . $result["Subject_semester"];?>
                        </P>
                        <P><?php if(isset($result["Description"])) echo "<p>Product Description:</p>" . $result["Description"];?>
                        </P>


                    </div><!--/product-information-->
                </div>
            </div><!--/product-details-->

        </div>
        </div>
    </div>
    </section>
<?php
require_once("assets/layouts/footer.php");
?>
