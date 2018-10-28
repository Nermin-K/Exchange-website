<?php require_once("assets/classes/user.php") ?>
<?php require_once("assets/db_connection.php")?>
<?php require_once("assets/session.php")?>
<?php require_once("assets/layouts/header.php") ?>
<?php require_once("assets/functions.php") ?>
<?php
    function __autoload ($class_name)
    {
        require_once("assets/classes/".$class_name.".php");
    }
?>
<?php
$user_id;

if (!isset($_SESSION['id']))
{
    redirect_to("login.php");
}

if(isset($_GET["user"]) && !empty($_GET["user"]))
{
    $user_id=$_GET["user"];
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
    redirect_to("login.php");

?>

<?php $result=$user->getUserById($user_id); ?>

      <!-- Page title -->
      <div class="page-title">
         <div class="container">
            <h2><i class="fa fa-desktop color"></i> <?php echo htmlentities($result['F_name']." ". $result['L_name']); ?></h2>
            <hr />
         </div>
      </div>
      <!-- Page title -->
      
      <!-- Page content -->
      
      <div class="account-content">
         <div class="container">


            <?PHP echo sessionMessages(); ?>
            <div class="row">
               <div class="col-md-3">
                  <div class="sidey">

                          <img class=" img-thumbnail" src="<?php echo $result['Picture']; ?>" />

                      <?php
                        if($_SESSION["id"]==$user_id)
                        {
                            $output="<ul class=\"nav\">";
                            $output.=" <li><a href=\"account.php?user={$user_id}\">My Account</a></li>";
                            $output.=" <li><a href=\"addItem2.php\">Add Item</a></li>";
                            $output.=" <li><a href=\"notifications.php\">Notifications</a></li>";
                            $output.=" <li><a href=\"wishlist.php\">Wishlist</a></li>";
                            $output.=" <li><a href=\"editprofile.php?user={$user_id}\">Edit Profile</a></li>";
                            $output.=" <li><a href=\"deleteAccount.php\">Delete Account</a></li>";
                            $output.="</ul>";

                            echo $output;

                        }

                      ?>




                  </div>
                  </div>
               <div class="col-md-9">
                  <h3><i class="fa fa-user color"></i> &nbsp;My Account</h3>
                  <!-- Your details -->
                   <div class="address">
                     <address>
                       <!-- Your name -->

                       <strong><?php echo $result["F_name"]." ".$result["L_name"]; ?></strong><br>
                         <!-- Phone number -->
                       <abbr title="Phone"></abbr><?php echo $result["Phone_no"]; ?><br />
                       <a href="#" class="color"><?php echo $result["Email"]; ?></a><br/>
                         <a href="<?php echo $result["FB_account"]; ?>" class="color"><?php echo $result["FB_account"]; ?></a>
                     </address>
                   </div>

                   <hr />
                   
<br />
               </div>
		
                <div class="col-md-9 <?php if($_SESSION['id']!=$user_id) echo 'marginLeft'; ?>">
                    <h3><i class="icon-user color"></i> &nbsp; Added Books</h3>
                    <!-- Your details -->


                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $books=$book->getAddedBook($user_id);
								    if (mysqli_num_rows($books)==0)
								   {
									   echo "<h2> No Added Books</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
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
                            <td>
                                 <?php  echo toggleButtons($user_id , "books" , $result['Id']);?>

                            </td>
                        </tr>
									<?php } }?>

                        
                        </tbody>
                    </table>
<br />
             </div>
			 
			  <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Sheets</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $sheets=$sheet->getAddedSheet($user_id);
								    if (mysqli_num_rows($sheets)==0)
								   {
									   echo "<h2> No Added Sheets</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($sheets)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=sheets&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "sheets" , $result['Id']);?>

                            </td>
								   <?php } }?>
                        </tr>
									
                        
                        </tbody>
                    </table>
<br />
             </div>
			 
			 <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Electronic Components</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $electronicComponents=$electronicComponent->getAddedElectronic($user_id);
								    if (mysqli_num_rows($electronicComponents)==0)
								   {
									   echo "<h2> No Added Electronic Components</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($electronicComponents)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode('electronic components');?>&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "electronic components" , $result['Id']);?>
                            </td>
								   <?php } }?>
                        </tr>
                        
                        </tbody>
                    </table>
<br />
             </div> 
			 
                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Hardware Components</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $hardwareComponents=$hardwareComponent->getAddedHardware($user_id);
								    if (mysqli_num_rows($hardwareComponents)==0)
								   {
									   echo "<h2> No Added Hardware Components</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($hardwareComponents)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode('hardware components');?>&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "hardware components" , $result['Id']);?>
                            </td>
								   <?php } }?>
                        </tr>
                        
                        </tbody>
                    </table>
<br />
             </div>		

                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Tools</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $tools=$tool->getAddedTool($user_id);
								    if (mysqli_num_rows($tools)==0)
								   {
									   echo "<h2> No Added Tools</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($tools)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=tools&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "tools" , $result['Id']);?>
                            </td>
								   <?php } }?>
                        </tr>
                        
                        </tbody>
                    </table>
<br />
             </div>			 
			 
				                <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Sport Equipments</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $sportEquipments=$sportEquipment->getAddedSport($user_id);
								    if (mysqli_num_rows($sportEquipments)==0)
								   {
									   echo "<h2> No Added Sport Equipments</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($sportEquipments)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode('sports equipment');?>&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "sports equipment" , $result['Id']);?>

                            </td>
								   <?php } }?>
                        </tr>
                        
                        </tbody>
                    </table>
<br />
             </div>			 
			 
			 
			 <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Musical Instruments</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $musicalInstruments=$musicalInstrument->getAddedMusical($user_id);
								    if (mysqli_num_rows($musicalInstruments)==0)
								   {
									   echo "<h2> No Added Musical Instruments</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($musicalInstruments)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=<?php echo urlencode('musical instrument');?>&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "musical instrument" , $result['Id']);?>

                            </td>
								   <?php } }?>
                        </tr>
                        
                        </tbody>
                    </table>
<br />
             </div>			 
			 
			 <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Tickets</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $tickets=$ticket->getAddedTicket($user_id);
								    if (mysqli_num_rows($tickets)==0)
								   {
									   echo "<h2> No Added Tickets</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($tickets)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=tickets&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "tickets" , $result['Id']);?>

                            </td>
								   <?php } }?>
                        </tr>
                        
                        </tbody>
                    </table>
<br />
             </div>
			
			 <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Accessories</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $accessories=$accessory->getAddedAccessory($user_id);
								    if (mysqli_num_rows($accessories)==0)
								   {
									   echo "<h2> No Added Accessories</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($accessories)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=accessories&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "accessories" , $result['Id']);?>
                            </td>
								   <?php } }?>
                        </tr>
                        
                        </tbody>
                    </table>
<br />
             </div>			 
			 
			 <div class="col-md-9 marginLeft">
                    <h3><i class="icon-user color"></i> &nbsp; Added Others</h3>
                    <!-- Your details -->

                    <table class="table table-striped tcart">
                        <thead>
						<?php 
							 $others=$other->getAddedOther($user_id);
								    if (mysqli_num_rows($others)==0)
								   {
									   echo "<h2> No Added Items</h2>";
								   }
								   else 
								   {
					
										echo "<tr>"."<th>Date</th>"." <th>Name</th>"."<th>Price</th>"."<th></th>"."</tr>";
                         
						?>
                        </thead>
                        <tbody>
						 <?php
                                    while ($result=mysqli_fetch_assoc($others)){
                                 ?>
                        <tr>
									<td><?php echo $result["Date_time"]; ?></td>
                            <td><a href="product-details.php?category=tools&id=<?php echo $result['Id']; ?>"><?php echo $result["Name"]; ?></a></td>
									<td><?php echo $result["Price"]; ?></td>
                            <td>
                                <?php  echo toggleButtons($user_id , "others" , $result['Id']);?>

                            </td>
								   <?php } }?>
                        </tr>
                        
                        </tbody>
                    </table>

             </div>
			 
            </div>
            
            <div class="sep-bor"></div>
         </div>
      </div>

<?php require("assets/layouts/footer.php") ?>