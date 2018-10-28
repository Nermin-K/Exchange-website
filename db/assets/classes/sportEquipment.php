<?php


class sportEquipment
{
    private $connection;

    function __construct ($c){
        $this->connection=$c;
    }


    public function addSportEquipment($name ,$price ,$image ,$description , $userID)
    {
        $myDate = date("Y-m-d H:i:s");
        $n=mysqli_real_escape_string($this->connection,$name);
        $d=mysqli_real_escape_string($this->connection,$description);
        $i=mysqli_real_escape_string($this->connection,$image);
        $user=(int)$userID;
        $p=(float)$price;


        $query = "INSERT INTO sport_equipment (Name , Date_time ,Price , image , Description ,User_id ) ".
            "VALUES ('{$n}' , '{$myDate}' , {$p} , '{$i}' ,'{$d}', {$user} )";

        $result = mysqli_query($this->connection , $query);
        if($result){
            //success
            return 1;
        }else {
            //failure 
            return -1;
        }
    }

    public function getAllItems (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM sport_equipment";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function getMostRecent (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM sport_equipment ORDER BY Date_time DESC";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }


    public function updateItem($ID , $name , $price , $description , $availability, $image ){

        $id=(int)$ID;
        $n=mysqli_real_escape_string($this->connection,$name);
        $p=(float)$price;
        $d=mysqli_real_escape_string($this->connection,$description);
        $i=mysqli_real_escape_string($this->connection,$image);

        $a = (int)$availability;

        $query="UPDATE sport_equipment SET Name = '{$n}' , Price = {$p} , Description = '{$d}' , Availability = {$a} , image = '{$i}' WHERE Id={$id}";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function deleteItem($ID){

        $id=(int)$ID;

        $query="DELETE FROM sport_equipment WHERE Id= {$id} LIMIT 1";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function getItemById($id)
    {
        $query = "SELECT * FROM sport_equipment WHERE Id = {$id}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            $result2=mysqli_fetch_assoc($result);
            return $result2;
        }else {
            //failure 
            return -1;
        }

    }

    public function addWish($itemId,$userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;
        $date = date("Y-m-d H:i:s");
        $query = "INSERT INTO sport_equipment_wish (Item_id, Date_time, User_id) VALUES ({$iId}, '{$date}', {$uId})";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return 1;
        }else {
            //failure 
            return -1;
        }
    }

    public function checkWished ($itemId, $userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;

        $query = "SELECT * FROM sport_equipment_wish WHERE Item_id = {$iId} AND User_id= {$uId}";
        $result = mysqli_query($this->connection , $query);
        if(mysqli_num_rows($result)==0){
            return 1; // item was not wished before
        }else {
            //item was wished before
            return 0;
        }
    }
    public function deleteWish($itemId,$userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;
        $date = date("Y-m-d H:i:s");
        $query = "DELETE FROM sport_equipment_wish WHERE Item_id = {$iId} AND User_id = {$uId}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return 1;
        }else {
            //failure 
            return -1;
        }
    }

    public function getAddedSport($id){
        $query = "SELECT Date_time , Name , Price , Id FROM sport_equipment WHERE User_id={$id}";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function searchByName($name)
    {
        $query = "SELECT * FROM sport_equipment WHERE Name LIKE '%{$name}%'";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return $result;
        }else {
            //failure 
            return -1;
        }

    }

    public function sortByPrice(){
        $query = " SELECT Date_time , Id , Name , Price , image FROM sport_equipment ORDER BY Price";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }

    }

    public function getWishes($userId)
    { $query="SELECT Name, image , Id , Price ,  se.User_id , sew.Date_time FROM sport_equipment as se , ";
        $query.= "sport_equipment_wish as sew where se.Id = sew.Item_id and sew.User_id = {$userId} ";
        $query.="order by sew.Date_time";
        $result=mysqli_query($this->connection,$query);
        if($result===false)
        {
            return -1;
        }
        else
        {
            return $result;
        }


    }
    public function getNotifications($userId)
    { $query="SELECT Name, image , Id , sew.User_id , sew.Date_time FROM sport_equipment as se , ";
        $query.= "sport_equipment_wish as sew where se.Id = sew.Item_id and se.User_id = {$userId} ";
        $query.="order by sew.Date_time";
        $result=mysqli_query($this->connection,$query);
        if($result===false)
        {
            return -1;
        }
        else
        {
            return $result;
        }


    }
}