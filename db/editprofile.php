<?php require_once("assets/layouts/header.php")?>
<?php
function __autoload ($class_name)
{
    require_once("assets/classes/".$class_name.".php");
}
?>
<?php require_once("assets/db_connection.php") ?>
<?php require_once ("assets/session.php") ?>
<?php require_once("assets/functions.php")?>

<?php
    $myUSer ;
    if (isset($_GET["user"]))
    {
        $myUser=  $_GET["user"];
    }
    else
    {
        redirect_to("index.php"); //if someone tries to access the page without the id redirect them;
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
      
      <div class="account-content">
         <div class="container">
            <?php echo sessionErrors();?>
            <div class="row">
               <div class="col-md-3">
                  <div class="sidey">
                     <ul class="nav">
                         <li><a href="account.php?user=<?php echo urlencode ($myUser); ?>">My Account</a></li>
                         <li><a href="addItem2.php">Add Item</a></li>
                         <li><a href="wishlist.php">Wish List</a></li>
                         <li><a href="notifications.php">Notifications</a></li>
                         <li><a href="editprofile.php?user=<?php echo urlencode ($myUser); ?>">Edit Profile</a></li>
                         <li><a href="deleteAccount.php">Delete Account</a></li>

                     </ul>
                  </div>
               </div>
               <div class="col-md-9">
                  <h3><i class="icon-user color"></i> &nbsp;Edit Profile</h3>
                  <!-- Your details -->
                   <div class="register_account">
                       <?php $u= new user($connection);
                         $result= $u->getUserById($myUser);

                       ?>

                           <form action="edituser.php?id=<?php echo $myUser;?>" method="post" enctype="multipart/form-data">
                               <div class="col_1_of_2 span_1_of_2">
                                   <div> <label for="F_name">First Name</label><input type="text" name="F_name" value="<?php echo  $result["F_name"]; ?>" ></div>
                                   <div> <label for="L_name">Last Name</label><input type="text" name="L_name" value="<?php echo $result["L_name"]; ?>" ></div>
                                   <div> <label for="E-mail">E-mail</label><input type="text" name="E-mail" value="<?php echo $result["Email"]; ?>"  ></div>
                                   <div> <label for="phone_number">Phone Number</label><input type="text" name="phone_number" value="<?php echo $result["Phone_no"]; ?>"  ></div>
                                   <div> <label for="password">Password</label><input type="text" name="password" value="<?php echo $result["Password"]; ?>"></div>
                                   <div> <label for="Facebook-Account">Facebook Account</label> <input type="text" name="Facebook-Account" value="<?php echo $result["FB_account"]; ?>"></div>
                                   <div><input type="file" name="image" class="btn btn-default" value="image" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'image';}"></div>
                                   <br/>
                                   <input type="text" style="display: none;" name="i" value="<?php echo htmlentities($result['Picture']); ?>">

                                   <input type="submit" name="submit" class="btn btn-danger" value="Submit"/>
                               </div>
                               <div class="clear"></div>
                           </form>

                   </div>

               </div>
            </div>
            
            <div class="sep-bor"></div>
         </div>
      </div>
<?php require_once("assets/layouts/footer.php")?>