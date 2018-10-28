<!-- VERSION #1.0 , lAST EDITED BY MAYAR -->
<?php
require_once("assets/layouts/header.php");
require_once("assets/functions.php");
require_once("assets/db_connection.php");
require_once("assets/classes/user.php");
require_once("assets/session.php");
function __autoload ($class_name)
{
    require_once("assets/classes/".$class_name.".php");
}
$user_id;
$objects=array();
if(isLoggedIn())
{


    $user_id=$_SESSION["id"];
    $user=new user($connection);
    $objects[]=new accessory($connection);
    $objects[]=new book($connection);
    $objects[]=new electronicComponent($connection);
    $objects[]=new hardwareComponent($connection);
    $objects[]=new musicalInstrument($connection);
    $objects[]=new other($connection);
    $objects[]=new sportEquipment($connection);
    $objects[]=new sheet($connection);
    $objects[]=new ticket($connection);
    $objects[]=new tool($connection);


}
else
{
    redirect_to("login.php");
}
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="icon-desktop color"></i> My Account</h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<!-- Page content -->
<!-- url should have user id ,call get wished books, tickets.... -->
<div class="account-content">
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <div class="sidey">

                    <?php
                        $profile=$user->getUserById($user_id);
                    ?>
                    <img class=" img-thumbnail"src=<?php echo htmlentities($profile['Picture']); ?> />
                    <ul class="nav">
                        <li><a href="account.php?user=<?php echo $user_id; ?>">My Account</a></li>
                        <li><a href="addItem2.php">Add Item</a></li>
                        <li><a href="wishlist.php">Wish List</a></li>

                        <li><a href="editprofile.php?user=<?php echo $user_id; ?>">Edit Profile</a></li>
                        <li><a href="deleteAccount.php">Delete Account</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Your details -->


                <table class="table table-striped tcart">
                    <tbody>
                    <!--<thead>-->
                    <?php
                    foreach($objects as $obj)
                    {

                        $object=$obj->getNotifications($user_id);
                        if (mysqli_num_rows($object)==0)
                        {
                            continue;
                        }
                        else
                        {

                   // echo "<tr>"."<th></th>"."<th></th>"."</tr>";

                    ?>
                   <!-- </thead>-->

                    <?php
                    while ($result=mysqli_fetch_assoc($object)){
                    ?>
                    <tr>


                        <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                <?php $wisher=new user($connection);


                                $res =  $wisher->getUserById($result['User_id']);
                                echo $res["F_name"]. " ".$res["L_name"];

                                ?></a> <?php echo "requested ".$result["Name"]; ?></td>

                        <td><?php echo $result["Date_time"]; ?></td>
                        <!--<td><a href="product-details.php?category=books&id=<?php //echo $result['Id']; ?>" target="_blank"><?php //echo $result["Name"]; ?></a></td>-->
                        </tr>
                        <?php } } }?>


                    </tbody>
                </table>
                <br>
            </div>






        </div>

        <div class="sep-bor"></div>
    </div>
</div>
<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>

<?php require_once("assets/layouts/footer.php")?>