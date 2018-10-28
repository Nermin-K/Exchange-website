<?php require_once("assets/db_connection.php");?>
<?php require_once("assets/session.php");?>

<?php
    function __autoload ($class_name)
	{
		require_once("assets/classes/".$class_name.".php");
	}
?>

<?php
	
	function redirect_to ($newLocation){
		header ("Location: ". $newLocation);
		exit;
	}

	function has_presence($value){
		return (isset($value) && $value !=="");
	}

	function validate_presence ($required_fields =array(), $errors=array())
	{
		foreach($required_fields as $field)
		{
			$value=trim($_POST[$field]);
			if(!has_presence($value) || $_POST[$field]==$field)
			{
				$errors[] = $field . " can't be blank";
			}
		}
		return $errors;	
	}

	/*function addImage ($table)
	{
		if ($_FILES["image"]["error"] > 0)
		{
		 echo "<font size = '5'><font color=\"#e31919\">Error: NO CHOSEN FILE <br />";
		 //echo"<p><font size = '5'><font color=\"#e31919\">INSERT TO DATABASE FAILED";
		}
	   else
	   {
	     if(move_uploaded_file($_FILES["image"]["tmp_name"],"db/img/" . $_FILES["image"]["name"])
	     	echo"<font size = '5'><font color=\"#0CF44A\">SAVED<br>";

	     $file="img/".$_FILES["image"]["name"];
	     $sql="INSERT INTO {$table} (image) VALUES ('$file');";

	     if (!mysql_query($sql))
	     {
	        die('Error: ' . mysql_error());
	     }
	     echo "<font size = '5'><font color=\"#0CF44A\">SAVED TO DATABASE";

	   }

	}*/

	function addImage($table)
	{
			$target_dir = "img/";
			if(empty($_FILES['image']['name']))
			{
				return "img/items2.jpg";
			}
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$errors[]="File is not an image.";
					$_SESSION["errors"]=$errors;

					redirect_to("addItem2.php");
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				$errors[]= "Please change the image name.";
				$_SESSION["errors"]=$errors;

				redirect_to("addItem2.php");
				$uploadOk = 0;

			}
		/*
			// Check file size
			if ($_FILES["image"]["size"] > 500000) {
				$errors[]="Sorry, your file is too large.";
				$_SESSION["errors"]=$errors;

				redirect_to("addItem2.php");
				$uploadOk = 0;
			}
		*/
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg"
				&& $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF" ) {
				$errors[]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$_SESSION["errors"]=$errors;
				redirect_to("addItem2.php");

				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$errors[]= "Sorry, your file was not uploaded.";
				$_SESSION["errors"]=$errors;
				redirect_to("addItem2.php");
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
				} else {
					$errors[]= "Sorry, there was an error uploading your file.";
					$_SESSION["errors"]=$errors;
					redirect_to("addItem2.php");
				}
			}
		return $target_file;
	}


	?>


	<?php


	$errors = array();
	$required_fields = array("Category", "Name");
	$bookReq = array("bookCategory");
	$sheetReq = array("department","year","semester","Sheetsubject");
	$toolReq = array("toolCategory");
	$ticketReq = array("ticketCategory");

	$newLocation = "addItem2.php";

	if($_POST["submit"])
	{
		$added;
		$errors = validate_presence ($required_fields, $errors);
		if(!empty($errors)){
			$_SESSION["errors"]=$errors;

			redirect_to("addItem2.php");
		}
		else if(!is_numeric($_POST["Price"]) || $_POST["Price"] < 0 ){
			$errors[]="Please enter a valid price";
			$_SESSION["errors"]=$errors;

			redirect_to("addItem2.php");
		}
		else if($_POST["Category"] == "Book") {
				$errors = validate_presence($bookReq,$errors);
				if(!empty($errors))
				{
					$_SESSION["errors"]=$errors;

					redirect_to("addItem2.php");
				}
				else{
					if(trim($_POST["booksubject"]) == "" || $_POST["booksubject"] == "booksubject" )
						$_POST["booksubject"]  = "";

				$book = new book($connection);
					$added=$book->addBook($_POST["Name"] ,$_POST["Price"] ,addImage ("book"),$_POST["description"] ,$_POST["bookCategory"], $_POST["booksubject"],
				 $_SESSION["id"]);
			    }
		}
		else if($_POST["Category"] == "Sheet") {
				$errors = validate_presence($sheetReq , $errors);
				if(!empty($errors))
				{
					$_SESSION["errors"]=$errors;


					redirect_to("addItem2.php");
				}
				else
				{
					$sheet = new sheet ($connection);
					$added=$sheet -> addSheet ($_POST["Name"] ,$_POST["Price"] ,addImage ("sheet") ,$_POST["description"] ,$_POST["department"],
					 $_POST["Sheetsubject"],$_POST["year"] ,$_POST["semester"], $_SESSION["id"]);
				}
		}
		else if($_POST["Category"] == "Tool") {
				$errors = validate_presence($toolReq,$errors);
				if(!empty($errors))
				{
					$_SESSION["errors"]=$errors;

					redirect_to("addItem2.php");
				}
				else
				{
					$tool= new tool ($connection);
					$added= $tool -> addTool($_POST["Name"] ,$_POST["Price"] ,addImage ("tool") ,$_POST["description"] ,$_POST["toolCategory"], $_SESSION["id"]);
				}
		}
		else if($_POST["Category"] == "Ticket") {
				$errors = validate_presence($ticketReq,$errors);
				if(!empty($errors))
				{
					$_SESSION["errors"]=$errors;

					redirect_to("addItem2.php");
				}
				else
				{
					$ticket = new ticket($connection);
					$added=$ticket -> addTicket($_POST["Name"] ,$_POST["Price"] ,addImage ("ticket") ,$_POST["description"],$_POST["ticketCategory"], $_SESSION["id"]);
				}
		}
		else if($_POST["Category"] == "Accessory"){
			$accessory = new accessory($connection);
			$added=$accessory -> addAccessory($_POST["Name"] ,$_POST["Price"] ,addImage ("accessories") ,$_POST["description"], $_SESSION["id"]);
		}
		else if($_POST["Category"] == "Electronic Component"){
			$ec = new electronicComponent($connection);
			$added=$ec -> addElectronicComponent($_POST["Name"] ,$_POST["Price"] ,addImage ("electronic_components") ,$_POST["description"], $_SESSION["id"]);
		}

		else if($_POST["Category"] == "Computer Hardware Component"){
			$hw = new hardwareComponent($connection);
			$added=$hw -> addHardwareComponent($_POST["Name"] ,$_POST["Price"] ,addImage ("hardware_component") ,$_POST["description"], $_SESSION["id"]);
		}
		else if($_POST["Category"] == "Sports Equipment"){
			$se = new sportEquipment($connection);
			$added=$se -> addSportEquipment($_POST["Name"] ,$_POST["Price"] ,addImage ("sport_equipment") ,$_POST["description"], $_SESSION["id"]);
		}
		else if($_POST["Category"] == "Musical Instrument"){
			$mi = new musicalInstrument($connection);
			$added=$mi -> addMusicalInstrument($_POST["Name"] ,$_POST["Price"] ,addImage ("musical_instruments") ,$_POST["description"], $_SESSION["id"]);
		}
		else if($_POST["Category"] == "Others"){
			$other = new other($connection);
			$added=$other -> addOther($_POST["Name"] ,$_POST["Price"] ,addImage ("others") ,$_POST["description"], $_SESSION["id"]);
		}


		if($added==1){
			$_SESSION["message"]="Item Added Successfully";
		}else
		{
			$_SESSION["message"]="Item not added Successfully";
		}

		redirect_to("account.php?user={$_SESSION["id"]}");


}
		
?>