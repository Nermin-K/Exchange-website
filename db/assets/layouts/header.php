<?php
require_once("assets/session.php");
require_once("assets/functions.php");
$user="";
	if(isLoggedIn())
		$user=$_SESSION["id"];

?>
<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="HTML,CSS,JavaScript,JQuery,BootStrap">
        <meta name="author" content="Mo'men And Mayar">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- Include BootStrap and Jquery-->

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

        <!-------------------------------->

        <!-- Include Our Files-->
       
		<link rel="stylesheet" href = "css/header.css" />
		<link rel="stylesheet" href="css/footer.css" />
		<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/main.css" rel='stylesheet' type='text/css' />
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<link href="css/products.css" rel="stylesheet" />
		<link href="css/product_details.css" rel="stylesheet" />
		<link rel="stylesheet" href="css/login.css"  />
		<link rel="stylesheet" href="css/account.css"  />


		<script type="text/javascript" src="js/megamenu.js"></script>

		<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
		<!-- end menu -->
		<!-- top scrolling -->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
        <!-------------------------------->
        <title>Exchange</title>
    </head>

    <body>

	<div class="header-top">
		<div class="wrap">
			<div class="logo">
				<h2>Exchange</h2>
			</div>
			<div class="cssmenu">
				<ul>
					<li class="active"><a href="account.php?user=<?php echo $user; ?>"><i class="fa fa-user">&nbsp;</i>My Account</a></li> <!--goes to login page or profilr page-->
					<li><a href="wishlist.php?user=<?php echo $user; ?>"><i class="fa fa-star">&nbsp;</i>Wish List</a></li>
					<li><a href="#"><i class="fa fa-bell">&nbsp;</i>Notifications</a></li>
					<li><a href="register.php"><i class="fa fa-sign-in">&nbsp;</i>Sign UP</a></li>
					<?php
                           $parameter="Log in";
                           $page ="login.php";
                         if(isLoggedIn())
						 {
							 $parameter="Log out";
							 $page ="logout.php";
						 }
	                      ?>
					<li><a href="<?php echo $page; ?>"><i class="fa fa-sign-in">&nbsp;</i><?php echo $parameter;?></a></li>
				</ul>
			</div>

			<div class="clear"></div>
		</div>
	</div>
	<div class="header-bottom">
		<div class="wrap">
			<!-- start header menu -->
			<ul class="megamenu skyblue">
				<li><a class="color1" href="index.php">Home</a></li>
				<li><a class="color5" href="products.php?category=books">Books</a></li>
				<li><a class="color6" href="products.php?category=sheets">Sheets</a></li>
				<li><a class="color7" href="products.php?category=<?php echo urlencode("electronic components"); ?>">Electronic Components</a></li>
				<li><a class="color8" href="products.php?category=tools">Tools</a></li>
				<li><a class="color9" href="products.php?category=<?php echo urlencode("sports equipment"); ?>">Sports Equipment</a></li>
				<li><a class="color10" href="products.php?category=tickets">Tickets</a></li>
				<li><a class="color11" href="products.php?category=<?php echo urlencode("hardware components"); ?>">Hardware Components</a></li>
				<li><a class="color12" href="products.php?category=accessories">Accessories</a></li>
				<li><a class="color12" href="products.php?category=others">Others</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form class="form-inline" role="form" id="search" action="searchValidation.php" method="post">
		<div class="form-group">
			<input class="form-control"  type="text" value="" placeholder="Enter Item" name= "itname">
		</div>

		<div class="form-group">
			<select class="form-control" id="sel1" name="category">
				<option value="category">Select a Category</option>
				<option value="books">Books</option>
				<option value="sheet">Sheets</option>
				<option value="tools">Tools</option>
				<option value="tickets">Tickets</option>
				<option value="accessories">Accessories</option>
				<option value="electronic components">Electronic Components</option>
				<option value="hardware components">Computer Hardware Components</option>
				<option value="sports equipment">Sports Equipment</option>
				<option value="musical instrument">Musical Instruments</option>
				<option value="others">Others</option>
			</select>
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-default"  value="Search" name="submit">
		</div>


	</form>

