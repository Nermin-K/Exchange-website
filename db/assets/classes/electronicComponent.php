<?php


class electronicComponent
{
    private $connection;

    function __construct ($c){
        $this->connection=$c;
    }


    public function addElectronicComponent($name ,$price ,$image ,$description , $userID)
    {
        $myDate = date("Y-m-d H:i:s");
        $n=mysqli_real_escape_string($this->connection,$name);
        $d=mysqli_real_escape_string($this->connection,$description);
        $i=mysqli_real_escape_string($this->connection,$image);
        $user=(int)$userID;
        $p=(float)$price;


        $query = "INSERT INTO electronic_components (Name , Date_time ,Price , image , Description ,User_id ) ".
            "VALUES ('{$n}' , '{$myDate}' , {$p} , '{$i}' ,'{$d}', {$user} )";

        $result = mysqli_query($this->connection , $query);
        if($result){
            //success
            //redirect_to ("somepage")
            return 1;
        }else {
            //failure , message= subject creatin failed;
            return -1;}
    }

    public function getAllItems  (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM electronic_components";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function getMostRecent (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM electronic_components ORDER BY Date_time DESC";
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

        $query="UPDATE electronic_components SET Name = '{$n}' , Price = {$p} , Description = '{$d}' , Availability = {$a} , image = '{$i}' WHERE Id={$id}";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function deleteItem($ID){

        $id=(int)$ID;

        $query="DELETE FROM electronic_components WHERE Id= {$id} LIMIT 1";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function getItemById($id)
    {
        $query = "SELECT * FROM electronic_components WHERE Id = {$id}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            $result2=mysqli_fetch_assoc($result);
            return $result2;
        }else {
            //failure , message= subject creating failed;
           return -1;// get the most recent error in connection
        }

    }

    public function addWish($itemId,$userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;
        $date = date("Y-m-d H:i:s");
        $query = "INSERT INTO electronic_components_wish (Item_id, Date_time, User_id) VALUES ({$iId}, '{$date}', {$uId})";
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

        $query = "SELECT * FROM electronic_components_wish WHERE Item_id = {$iId} AND User_id= {$uId}";
        $result = mysqli_query($this->connection , $query);
        if(mysqli_num_rows($result)==0){
            return true; // item was not wished before
        }else {
            //item was wished before
            return false ;
        }
    }

    public function deleteWish($itemId,$userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;
        $date = date("Y-m-d H:i:s");
        $query = "DELETE FROM electronic_components_wish WHERE Item_id = {$iId} AND User_id = {$uId}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return 1;
        }else {
            //failure , message= subject creating failed;
            return -1;
        }
    }

    public function getAddedElectronic($id){
        $query = "SELECT Date_time , Name , Price , Id FROM electronic_components WHERE User_id={$id}";
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
        $query = "SELECT * FROM electronic_components WHERE Name LIKE '%{$name}%'";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return $result;
        }else {
            //failure , message= subject creating failed;
            return -1;
        }

    }

    public function sortByPrice(){
        $query = " SELECT Date_time , Id , Name , Price , image FROM electronic_components ORDER BY Price";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
           return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }

    }

    public function getWishes($userId)
    { $query="SELECT Name, image , Id , Price , e.User_id , ew.Date_time FROM electronic_components as e , ";
        $query.= "electronic_components_wish as ew where e.Id = ew.Item_id and ew.User_id = {$userId} ";
        $query.="order by ew.Date_time";
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
    { $query="SELECT Name, image , Id , ew.User_id , ew.Date_time FROM electronic_components as e , ";
        $query.= "electronic_components_wish as ew where e.Id = ew.Item_id and e.User_id = {$userId} ";
        $query.="order by ew.Date_time";
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

    public function countElectric(){

        $query="SELECT COUNT(*) as total FROM electronic_components";
        $result=mysqli_query($this->connection , $query);
        if (!$result)
            return -1;
        else
            return $result;
    }
}