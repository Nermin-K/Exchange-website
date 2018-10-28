<?php


require_once("assets/classes/ticket.php");
require_once ("assets/db_connection.php");

function __autoload ($class_name)
{
    require_once("assets/classes/".$class_name.".php");
}

 $acc= new accessory($connection);
$result = $acc->getMostRecent();
while ($item=mysqli_fetch_assoc($result))
{
    print_r($item); echo "<br />";
}
?>