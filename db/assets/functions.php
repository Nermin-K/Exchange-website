<?php
require_once("session.php");
// any extra functions should be here , include the file and call the function for better display
function redirect_to ($newLocation){
    header ("Location: ". $newLocation);
    exit;
}

function isLoggedIn()
{
    if(isset($_SESSION["id"])&&!empty($_SESSION["id"]))
    {
        return true;
    }
    else return false;

}

function displaySideBar($category, $object)
{
    $output="";
    if($category=="sheets"){
        $output.=" <div class=\"col-sm-3\">";
        $output.="<div class=\"left-sidebar\">";
        $output.="<h2>FILTER BY</h2>";

        //first panel for departments
        $output.="<div class=\"panel-group category-products\" id=\"accordian\">";
        $output.=" <div class=\"panel panel-default\"> <div class=\"panel-heading\">";
        $output.="<h4 class='panel-title'> <a href='#deps' data-parent='#accordian' data-toggle='collapse'>
        <span class='badge pull-right'><i class='fa fa-plus'></i></span>
        Departments</a></h4> </div>";
        $output.="<div id='deps' class='panel-collapse collapse in'><div class='panel-body'><ul>";
        $d= $object->getDepartments();
        while ($department=mysqli_fetch_assoc($d)){
            $output.="<li><a href=\"products.php?category=sheets&filter=department&name={$department['Name']}\">".$department['Name'] ."</a></li>";
        }
        $output.="</ul></div></div></div>"; //end of panel group

        //second panel for years

        $output.=" <div class=\"panel panel-default\"> <div class=\"panel-heading\">";
        $output.="<h4 class='panel-title'> <a href='#year' data-parent='#accordian' data-toggle='collapse'>
        <span class='badge pull-right'><i class='fa fa-plus'></i></span>
        Year</a></h4> </div>";
        $output.="<div id='year' class='panel-collapse collapse in'><div class='panel-body'><ul>";
        $output.="<li><a href=\"products.php?category=sheets&filter=year&num=1\">"."First" ."</a></li>";
        $output.="<li><a href=\"products.php?category=sheets&filter=year&num=2\">"."Second" ."</a></li>";
        $output.="</ul></div></div></div>"; //end of second panel

        //third panel for semester

        $output.=" <div class=\"panel panel-default\"> <div class=\"panel-heading\">";
        $output.="<h4 class='panel-title'> <a href='#sem' data-parent='#accordian' data-toggle='collapse'>
        <span class='badge pull-right'><i class='fa fa-plus'></i></span>
        Semester</a></h4> </div>";
        $output.="<div id='sem' class='panel-collapse collapse in'><div class='panel-body'><ul>";
        $output.="<li><a href=\"products.php?category=sheets&filter=semester&num=1\">"."First" ."</a></li>";
        $output.="<li><a href=\"products.php?category=sheets&filter=semester&num=2\">"."Second" ."</a></li>";
        $output.="</ul></div></div></div>"; //end of second panel


        $output.="</div>"; //end of all panels
        $output.="</div>"; //end of left sidebar
        $output.="</div>"; //end of column





    }else if ($category=="books")
    {
        $output.=" <div class=\"col-sm-3\">";
        $output.="<div class=\"left-sidebar\">";
        $output.="<h2>Sort By</h2>";

        //first panel for departments
        $output.="<div class=\"panel-group category-products\" id=\"accordian\">";
        $output.=" <div class=\"panel panel-default\"> <div class=\"panel-heading\">";
        $output.="<h4 class='panel-title'> <a href='#cats' data-parent='#accordian' data-toggle='collapse'>
        <span class='badge pull-right'><i class='fa fa-plus'></i></span>
        Book Categories</a></h4> </div>";
        $output.="<div id='cats' class='panel-collapse collapse in'><div class='panel-body'><ul>";
        $b= $object->getBookCategories();
        while ($book=mysqli_fetch_assoc($b)){
            $output.="<li><a href=\"products.php?category=books&filter=bookcat&name=".urlencode($book['Name'])."\">".$book['Name'] ."</a></li>";
        }
        $output.="</ul></div></div></div>"; //end of panel group

        $output.="</div>"; //end of all panels
        $output.="</div>"; //end of left sidebar
        $output.="</div>"; //end of column

    }
    return $output;
}
function displayAvailability ($item)
{
    $output="";

    $output.=" <div id=\"available\">";
    $output.= " <label for=\"available: \">Available: </label>";
    $output.=" <input type=\"radio\" name=\"available\" value=\"1\"";
     if($item['Availability']) {
         $output .= " checked ";
     }

    $output.=" />";


    $output.="YES &nbsp;";

    $output.="<input type=\"radio\" name=\"available\" value=\"0\"";
    if(!$item['Availability'])
    {
        $output.=" checked ";
    }

    $output.=" />";
    $output.="NO &nbsp;";


    $output.=" <br /><br />";
    $output.="</div>";

    return $output;
}

function toggleButtons ($userId , $category , $itemId)
{
    $output="";
    $cat=urlencode($category);

    if ($userId==$_SESSION['id'])
    {
        $output.="<a href=\"updateItem.php?category={$cat}&item={$itemId}\" class=\" btn btn-danger\" >Update</a> &nbsp;";
        $output.="<a href=\"deleteItem.php?category={$category}&item={$itemId}\" class=\" btn btn-danger\" >Delete</a> &nbsp;";

    }
    else
    {
       $output.="<a href=\"addWish.php?category={$cat}&item={$itemId}\" class=\" btn btn-danger\" >Add to Wish List</a> &nbsp;";
    }

    return $output;
}


function updateImage($default)
{
    $target_dir = "img/";

    if(empty($_FILES['image']['name']))
    {
        return $default;
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
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return $target_file;
}


function getCategory($category , $connection)
{
    $obj;
    switch($category){

        case'books':
        {
            $obj=new book($connection) ;
            break;

        }
        case'sheets': {
            $obj = new sheet($connection);
            break;
        }

        case'tools':
        {
            $obj=new tool($connection) ;
            break;

        }
        case'tickets':
        {
            $obj=new ticket($connection) ;

            break;
        }
        case'accessories':
        {
            $obj=new accessory($connection) ;

            break;
        }
        case'others':
        {
            $obj=new other($connection) ;

            break;
        }

        case'electronic components':
        {
            $obj=new electronicComponent($connection) ;

            break;
        }
        case'sports equipment':
        {
            $obj=new sportEquipment($connection) ;

            break;
        }
        case'hardware components':
        {
            $obj=new hardwareComponent($connection) ;

            break;
        }
        case'musical instrument':
        {
            $obj=new musicalInstrument($connection) ;

            break;
        }


        default :
            $obj=NULL;

    }

    return $obj;
}

?>