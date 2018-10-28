<?php


class accessory
{
    private $connection;

    function __construct ($c){
       $this->connection=$c;

    }

    public function addAccessory($name ,$price ,$image ,$description , $userID)
    {
        $myDate = date("Y-m-d H:i:s");
        $n=mysqli_real_escape_string($this->connection,$name);
        $d=mysqli_real_escape_string($this->connection,$description);
        $i=mysqli_real_escape_string($this->connection,$image);
        $user=(int)$userID;
        $p=(float)$price;


        $query = "INSERT INTO accessories (Name , Date_time ,Price , image , Description ,User_id ) ".
            "VALUES ('{$n}' , '{$myDate}' , {$p} , '{$i}' ,'{$d}', {$user} )";

        $result = mysqli_query($this->connection , $query);
        if($result){
            //success
            return 1;
        }else {
            //failure , message= subject creatin failed;
            return -1;
        }
    }

    public function getAllItems (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM accessories";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function getMostRecent (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM accessories ORDER BY Date_time DESC";
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

        $query="UPDATE accessories SET Name = '{$n}' , Price = {$p} , Description = '{$d}' , Availability = {$a} , image = '{$i}' WHERE Id={$id}";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function deleteItem($ID){

        $id=(int)$ID;

        $query="DELETE FROM accessories WHERE Id= {$id} LIMIT 1";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }



    public function getItemById($id)
    {
        $query = "SELECT * FROM accessories WHERE Id = {$id}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            $result2=mysqli_fetch_assoc($result);
            return $result2;
        }else {
            //failure , message= subject creating failed;
            return -1;
        }

    }

    public function addWish($itemId,$userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;
        $date = date("Y-m-d H:i:s");
        $query = "INSERT INTO accessories_wish (Item_id, Date_time, User_id) VALUES ({$iId}, '{$date}', {$uId})";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return 1;
        }else {
            //failure , message= subject creating failed;
            return -1;
        }
    }

    public function checkWished ($itemId, $userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;

        $query = "SELECT * FROM accessories_wish WHERE Item_id = {$iId} AND User_id= {$uId}";
        $result = mysqli_query($this->connection , $query);
        if(mysqli_num_rows($result)==0){
            return true; // item was not wished before
        }else {
            //item was wished before
            return false;
        }
    }

    public function deleteWish($itemId,$userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;
        $date = date("Y-m-d H:i:s");
        $query = "DELETE FROM accessories_wish WHERE Item_id = {$iId} AND User_id = {$uId}";
        $result = mysqli_query($this->connection , $query);
        if($result){
           return  1;
        }else {
            //failure , message= subject creating failed;
           return -1;
        }
    }

    public  function getAddedAccessory($id){
        $query = "SELECT Date_time , Name , Price ,Id FROM accessories WHERE User_id={$id}";
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
        $query = "SELECT * FROM accessories WHERE Name LIKE '%{$name}%'";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return $result;
        }else {
            //failure , message= subject creating failed;
            return -1;
        }

    }

    public function sortByPrice(){
        $query = " SELECT Date_time , Id , Name , Price , image FROM accessories ORDER BY Price";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }

    }

    public function getWishes($userId)
    { $query="SELECT Name, image , Id , Price , a.User_id , aw.Date_time FROM accessories as a , ";
        $query.= "accessories_wish as aw where a.Id = aw.Item_id and aw.User_id = {$userId} ";
        $query.="order by aw.Date_time ";
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
    {
        $query=$query="SELECT Name, image , Id , aw.User_id , aw.Date_time FROM accessories as a , ";
        $query.= "accessories_wish as aw where a.Id = aw.Item_id and a.User_id = {$userId} ";
        $query.="order by aw.Date_time";
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