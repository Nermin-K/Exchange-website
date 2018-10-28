<!-- VERSION #1.0 , lAST EDITED BY MAYAR -->
<?php require_once("assets/layouts/header.php") ?>
<?php require_once("assets/session.php") ?>


       <div class="register_account">
          	<div class="wrap">
    	      <h4 class="title">Create an Account</h4>
				<?php echo sessionErrors(); ?>
				<?php echo sessionMessages(); ?>
    		   <form action="register_validation.php" method ="post" enctype="multipart/form-data">
    			 <div class="col_1_of_2 span_1_of_2">
    			 <label>First Name</label>
				<!-- <span>*</span>-->
		   			 <div><input type="text" name ="firstname" value="" ></div>
		   	     <label>Last Name</label>
				<!-- <span>*</span> -->
                      <div><input type="text" name="lastname" value="" ></div>
                 <label>image</label>
                         <br/>
                         <br/>
				<!-- <span>*</span> -->
		    			<div><input type="file" name="pic" class="btn btn-default" ></div>
		    			<br/>
		    	 <label>E-mail</label>
				 <!-- <span>*</span> -->
		    			<div><input type="text" name="email" value="" ></div>
		    	 <label> Password </label>		    	 
		    	   <br/>

				<!-- <span>*</span> -->
		    			<div><input type="password" name="password" value="" ></div>
		    	 <label>Phone number</label>
				<!-- <span>*</span>-->
		    			<div><input type="text" name="phonenumber" value="" ></div>
		    	 <label>Facebook account</label>
				<!-- <span>*</span>-->

                     <div><input type="text" name="facebook" value=""></div>
                   
		         <button class="grey" type="submit" name="submit" value="submit">Submit</button>
                   </div>
                     <div class="clear"></div>
		    </form>
           </div>
    </div>
       <script type="text/javascript">
			$(document).ready(function() {
			
				var defaults = {
		  			containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
		 		};
				
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
        <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>

<?php require_once("assets/layouts/footer.php") ?>