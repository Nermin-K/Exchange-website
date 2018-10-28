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
if(isLoggedIn())
{


    $user_id=$_SESSION["id"];
    $user=new user($connection);
    $accessory=new accessory($connection);
    $book=new book($connection);
    $electronicComponent=new electronicComponent($connection);
    $hardwareComponent=new hardwareComponent($connection);
    $musicalInstrument=new musicalInstrument($connection);
    $other=new other($connection);
    $sportEquipment=new sportEquipment($connection);
    $sheet=new sheet($connection);
    $ticket=new ticket($connection);
    $tool=new tool($connection);

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
                         <li><a href="account.php?user=<?php echo $_SESSION["id"]; ?>">My Account</a></li>
                         <li><a href="addItem2.php">Add Item</a></li>
                         <li><a href="wishlist.php">Wish List</a></li>
                         <li><a href="notifications.php">Notifications</a></li>
                         <li><a href="editprofile.php?user=<?php echo $_SESSION["id"]; ?>">Edit Profile</a></li>
                         <li><a href="deleteAccount.php">Delete Account</a></li>

                     </ul>
                  </div>
               </div>

                <div class="col-md-9">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Books</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $books=$book->getWishes($user_id);
                        if (mysqli_num_rows($books)==0)
                        {
                            echo "<h2> No Wished Books</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($books)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=books&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=books&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

                        </tbody>
                    </table><br>
                </div>
                <div class="col-md-9">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Accessories</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $accessories=$accessory->getWishes($user_id);
                        if (mysqli_num_rows($accessories)==0)
                        {
                            echo "<h2> No Wished accessories</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($accessories)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=accessories&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=accessories&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                        </tr>
                            <?php } }?>


                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Electronic components</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $electronics=$electronicComponent->getWishes($user_id);
                        if (mysqli_num_rows($electronics)==0)
                        {
                            echo "<h2> No Wished electronic components</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($electronics)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode("electronic components");?>&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=<?php echo urlencode("electronic components");?>&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Hardware components</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $hardware=$hardwareComponent->getWishes($user_id);
                        if (mysqli_num_rows($hardware)==0)
                        {
                            echo "<h2> No Wished hardware components</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($hardware)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode("hardware components");?>&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=<?php echo urlencode("hardware components");?>&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Musical instruments</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $musical=$musicalInstrument->getWishes($user_id);
                        if (mysqli_num_rows($musical)==0)
                        {
                            echo "<h2> No Wished Musical instruments</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($musical)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode("musical instrument");?>&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=<?php echo urlencode("musical instrument");?>&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Sheets</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $sheets=$sheet->getWishes($user_id);
                        if (mysqli_num_rows($sheets)==0)
                        {
                            echo "<h2> No Wished Wished Sheets</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($sheets)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode("sheets");?>&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=<?php echo urlencode("sheets");?>&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Sports equipment</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $equipment=$sportEquipment->getWishes($user_id);
                        if (mysqli_num_rows($equipment)==0)
                        {
                            echo "<h2> No Wished Wished Sports equipment</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($equipment)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode("sports equipment");?>&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=<?php echo urlencode("sports equipment");?>&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Tickets</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $tickets=$ticket->getWishes($user_id);
                        if (mysqli_num_rows($tickets)==0)
                        {
                            echo "<h2> No Wished Wished Tickets</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($tickets)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode("tickets");?>&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=<?php echo urlencode("tickets");?>&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Tools</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $tools=$tool->getWishes($user_id);
                        if (mysqli_num_rows($tools)==0)
                        {
                            echo "<h2> No Wished Wished Tools</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($tools)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode("tools");?>&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=<?php echo urlencode("tools");?>&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Wished Others</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
                        <?php
                        $others=$other->getWishes($user_id);
                        if (mysqli_num_rows($others)==0)
                        {
                            echo "<h2> No Wished Others</h2>";
                        }
                        else
                        {

                        echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th>Owner</th>"."<th></th>"."</tr>";

                        ?>
                        </thead>
                        <tbody>
                        <?php
                        while ($result=mysqli_fetch_assoc($others)){
                        ?>
                        <tr>
                            <td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode("others");?>&id=<?php echo $result['Id']; ?>" target="_blank"><?php echo $result["Name"]; ?></a></td>
                            <td><?php echo $result["Price"];?></td>
                            <td><a href="account.php?user=<?php echo $result['User_id']; ?>" target="_blank">
                                    <?php $owner=new user($connection);


                                    $res =  $owner->getUserById($result['User_id']);
                                    echo $res["F_name"]. " ".$res["L_name"];

                                    ?></a></td>
                            <td>
                                <a href="deleteWish.php?category=<?php echo urlencode("others");?>&item=<?php echo $result['Id']; ?>" target="_blank" class="btn btn-danger">Cancel</a>

                            </td>
                            <?php } }?>
                        </tr>

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