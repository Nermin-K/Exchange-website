<!-- VERSION #1.0 , lAST EDITED BY MAYAR -->
<?php require_once("assets/session.php")?>
<?php require_once("assets/layouts/header.php")?>
<?php
    function __autoload ($class_name)
    {
        require_once("assets/classes/".$class_name.".php");
    }
?>
<?php require_once("assets/db_connection.php");
    if (!isset($_SESSION['id']))
    {
        redirect_to("index.php");
    }



?>



       <div class="register_account">
          	<div class="wrap">
    	      <h4 class="title">ADD Item</h4>
    		   <form action = "FormValidation.php" method = "post" enctype="multipart/form-data">
           <?php
                   echo sessionErrors();
                    echo sessionMessages();
           ?>
    			 <div class="col_1_of_2 span_1_of_2">

                     <select id="cat" name="Category">
		                 <option value="Category">Select a Category</option>         
		                 <option value="Book">Book</option>
		                 <option value="Sheet">Sheet</option>
		                 <option value="Tool">Tool</option>
		                 <option value="Ticket">Ticket</option>
		                 <option value="Accessory">Accessory</option>
		                 <option value="Electronic Component">Electronic Component</option>
		                 <option value="Computer Hardware Component">Computer Hardware Component</option>
                         <option value="Sports Equipment">Sports Equipment</option>
                         <option value="Musical Instrument">Musical Instrument</option>
                         <option value="Others">Others</option>
                    </select>

                     <div><input type="text" name="Name" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}"></div>
                     <div><input type="text" name="Price" value="0.0" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Price';}"></div>
                     <div><input type="file" name="image" class="btn btn-default" value="image" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'image';}"></div>

					  <div id="sheets" > <!-- displayed when sheet category is selected -->
                         <div><select name="department">
                                 <option value="department">Select a Department</option>
                                 <?php
                                    $sheet= new sheet($connection);
                                    $departments = $sheet->getDepartments();
                                    while ($result=mysqli_fetch_assoc($departments)){
                                 ?>

                                 <option value="<?php echo $result["Name"]; ?>"><?php echo $result["Name"]; } ?></option>

                             </select> <!-- generated by database -->

                          <div><select name="year">
                                  <option value="year">Select a year</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                              </select></div>

                          <div><select name="semester">
                                  <option value="semester">Select a semester</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                              </select></div>


                       <div><input type="text" name="Sheetsubject" value="Sheetsubject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Sheetsubject';}"></div>

					 </div>
                          </div>

                     <div id="books" > <!-- displayed when book category is selected -->
                         <div><select name="bookCategory"> <!-- generated from database -->
                                 <option value="bookCategory">Select a Category</option>

                                 <?php
                                 $book= new book($connection);
                                 $categories = $book->getBookCategories();
                                 while ($result=mysqli_fetch_assoc($categories)){
                                 ?>

                                 <option value="<?php echo $result["Name"]; ?>"><?php echo $result["Name"]; } ?></option>


                             </select></div>



                         <div><input type="text" name="booksubject" value="booksubject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'booksubject';}"></div>

                     </div>

                     <div id="tools" > <!-- displayed when book category is selected -->
                         <div><select name="toolCategory"> <!-- generated from database -->
                                 <option value="toolCategory">Select a Category</option>
                                 <?php
                                 $tool= new tool($connection);
                                 $categories = $tool->getToolCategories();
                                 while ($result=mysqli_fetch_assoc($categories)){
                                 ?>

                                 <option value="<?php echo $result["Name"]; ?>"><?php echo $result["Name"]; } ?></option>


                             </select></div>

                     </div>

                     <div id="tickets" > <!-- displayed when book category is selected -->
                         <div><select name="ticketCategory"> <!-- generated from database -->
                                 <option value="ticketCategory">Select a Category</option>
                                 <?php
                                 $ticket= new ticket($connection);
                                 $categories = $ticket->getTicketCategories();
                                 while ($result=mysqli_fetch_assoc($categories)){
                                 ?>

                                 <option value="<?php echo $result["Name"]; ?>"><?php echo $result["Name"]; } ?></option>


                             </select></div>

                     </div>

					 <div><textarea name="description"  value="Description" rows="5" cols="79" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Description';}"></textarea></div>


		         <input type="submit" name ="submit" class="btn btn-danger" value="submit" />
                   </div>
                   <div class="clear"></div>
		    </form>
           </div>
    </div>
    <script type="text/javascript" >
        $(document).ready(function () {
            toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
            //this will call our toggleFields function every time the selection value of our underAge field changes
            $("#cat").change(function () {
                toggleFields();
            });

        });
        //this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field
        function toggleFields() {
            if ($("#cat").val() == "Sheet")
                {$("#sheets").show();
                  $("#tools").hide();
                  $("#books").hide();
                    $("#tickets").hide();
                }
            else if ($("#cat").val()=="Book" )
                {$("#books").show();
                  $("#sheets").hide();
                  $("#tools").hide();
                    $("#tickets").hide();

                }
            else if ($("#cat").val()=="Tool" )
            {$("#tools").show();
              $("#sheets").hide();
              $("#books").hide();
                $("#tickets").hide();

            }
            else if ($("#cat").val()=="Ticket")
            {
                $("#tickets").show();
                $("#sheets").hide();
                $("#books").hide();
                $("#tools").hide();
            }
            else
            {
                $("#sheets").hide();
                $("#books").hide();
                $("#tools").hide();
                $("#tickets").hide();

            }
        }
    </script>
<?php require_once("assets/layouts/footer.php")?>