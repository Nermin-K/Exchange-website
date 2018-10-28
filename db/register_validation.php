<?php
require_once("assets/validation_functions.php");
require_once("assets/functions.php");
 require_once("assets/db_connection.php");
 require_once("assets/classes/user.php");

if(isset($_POST["submit"])) 
{
   $errors=array();
   $required_fields=array("firstname","lastname","email","facebook","password","phonenumber");
   $max_lengths=array(50,50,100,100,100,15);
   $uploadedImages=false;
if(file_exists($_FILES['pic']['tmp_name']) &&is_uploaded_file($_FILES['pic']['tmp_name'])) 
{

   include("image_validation.php");
   $uploadedImages=true;
}
    else
    {
         $target_file="uploads/profile.png" ;
    }

$errors = validatePresence ($required_fields , $errors);

	$count=0;
   foreach($required_fields as $field)
   {    
     if(!(isMax($_POST[$field],$max_lengths[$count])))
     {
          //echo '{$field}'."exeeded max length"."br/>";
     	$errors[]=$field ." exceeded max length";


       $count=$count+1;

   }}


 if(!validateEmail ($_POST["email"]))
 {
 	$errors[]="this email is invalid";
 }
if(!validateFB ($_POST["facebook"]))
{
	$errors[]="this facebook account is invalid";
}


 
 

if(!empty($errors))
{

     $_SESSION["errors"]=$errors;

     redirect_to("register.php"); //user page with his id and call function add user
}
else if($uploadedImages)  
{
  if(!move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file))
  {

  
    $image_error= "there was an error uploading the file .please try again.";
    $errors[] = $image_error;
    $_SESSION["errors"]=$errors;
    redirect_to("register.php");
  }

 
  
}




	
{

   $email=$_POST["email"];
   $facebook=$_POST["facebook"];
  // 2. Perform database query
  $query  = "SELECT count(*) as count ";
  $query .= "FROM user ";
  $query .= "WHERE Email = '{$email}' ";

  $result = mysqli_query($connection, $query);
  // Test if there was a query error
  if ($result===false)
   {   echo "connection falied";
 
      $_SESSION["message"]="connection failed";
       redirect_to("register.php");
   }

       $count = mysqli_fetch_assoc($result) ;
        
        if((int)$count["count"]!=0)
          {   
              $errors["email_uniqueness"]="this e-mail account is already used ";
          }
         mysqli_free_result($result);

      
  $query  = "SELECT count(*) as count ";
  $query .= "FROM User ";
  $query .= "WHERE ";
  $query .= "FB_account = '{$facebook}' ";
   $result = mysqli_query($connection, $query);
  if ($result===false) 
     { echo "connection failed"."<br/>";
   
          
      $_SESSION["message"]="connection failed";
      redirect_to("register.php");
     }
  $count = mysqli_fetch_assoc($result) ;
        
        if((int)$count["count"]!=0)
        {    
         echo "this facebook account is already used "."<br/>";
         
             $errors["facebook_uniqueness"]="this facebook account is already used ";
            // redirect_to("register.php");
        }
     mysqli_free_result($result);
         
      if(!empty($errors)) 
     {       echo "second";
             
           // echo "uniqueness failed"."<br/>";
          $_SESSION["errors"]=$errors;

          redirect_to("register.php");

     }
     else
     {

         $obj= new user($connection);
        $obj->addUser($_POST["firstname"],$_POST["lastname"],$_POST["password"],$_POST["phonenumber"],$target_file,$_POST["email"],$_POST["facebook"]);	
        
        $mail=$_POST["email"];
       $id= $obj->getIdByMail($mail);
        if($id==-1)
        {   
               $_SESSION["message"]= "Database connection failed";

        //echo "here";
            //echo "adding user failed in the last step"."<br/>";
            //;
            //redirect_to("register.php");
        }
      else
      {
      	echo "adding user succeeded"."<br/>";

        $_SESSION["id"]=$id;
        
        redirect_to("account.php?user=".$id);
      }

     }
      
  
    


}
     
  

   
   
}
else redirect_to("register.php");


    if(isset($connection))
      mysqli_close($connection);
    



?>