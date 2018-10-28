<?php


class ticket
{
    private $connection;

    function __construct ($c){
        $this->connection=$c;
    }


    public function getTicketCategories()
    {
        $query = "SELECT * FROM ticket_category";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function addTicket($name ,$price ,$image ,$description ,$category, $userID)
    {
        //escape strings to insert safely in database
        $myDate = date("Y-m-d H:i:s");
        $n=mysqli_real_escape_string($this->connection,$name);
        $d=mysqli_real_escape_string($this->connection,$description);
        $i=mysqli_real_escape_string($this->connection,$image);
        $c =mysqli_real_escape_string($this->connection , $category);
        $user=(int)$userID;
        $p=(float)$price;


        $query = "INSERT INTO ticket (Name , Date_time ,Price , image , Description , Category_name , User_id ) ".
            "VALUES ('{$n}' , '{$myDate}' , {$p} , '{$i}' ,'{$d}', '{$c}' , {$user} )";

        $result = mysqli_query($this->connection , $query);
        if($result){
            //success
            //redirect_to ("somepage")
            return 1;
        }else {
            //failure , message= subject creatin failed;
            return -1; // get the most recent error in connection
        }
    }

    public function getAllItems (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM ticket";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function getMostRecent (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM ticket ORDER BY Date_time DESC";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }


    public function updateItem($ID , $name , $price , $description , $image ){

        $id=(int)$ID;
        $n=mysqli_real_escape_string($this->connection,$name);
        $p=(float)$price;
        $d=mysqli_real_escape_string($this->connection,$description);
        $i=mysqli_real_escape_string($this->connection,$image);



        $query="UPDATE ticket SET Name='{$n}' , Price={$p} , Description='{$d}' , image='{$i}' WHERE Id={$id}";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
        {
            return -1;
        }

    }

    public function deleteItem($ID){

        $id=(int)$ID;

        $query="DELETE FROM ticket WHERE Id= {$id} LIMIT 1";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function getItemById($id)
    {
        $query = "SELECT * FROM ticket WHERE Id = {$id}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            $result2=mysqli_fetch_assoc($result);
            return $result2;
        }else {
            //failure , message= subject creating failed;
            return -1; // get the most recent error in connection
        }

    }

    public function addWish($itemId,$userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;
        $date = date("Y-m-d H:i:s");
        $query = "INSERT INTO ticket_wish (Item_id, Date_time, User_id) VALUES ({$iId}, '{$date}', {$uId})";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return 1;
        }else {
            //failure , message= subject creating failed;
            return -1; // get the most recent error in connection
        }
    }
    public function checkWished ($itemId, $userId)
    {
        $uId = (int)$userId;
        $iId = (int)$itemId;

        $query = "SELECT * FROM ticket_wish WHERE Item_id = {$iId} AND User_id= {$uId}";
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
        $query = "DELETE FROM ticket_wish WHERE Item_id = {$iId} AND User_id = {$uId}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return 1;
        }else {
            //failure , message= subject creating failed;
            return -1; // get the most recent error in connection
        }
    }

    public function getAddedTicket($id){
        $query = "SELECT Date_time , Name , Price ,Id FROM ticket WHERE User_id={$id}";
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
        $query = "SELECT * FROM ticket WHERE Name LIKE '%{$name}%'";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return $result;
        }else {
            //failure , message= subject creating failed;
            return -1; // get the most recent error in connection
        }

    }

    public function sortByPrice(){
        $query = " SELECT Date_time , Id , Name , Price , image FROM ticket ORDER BY Price";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }

    }

    public function getWishes($userId)
    { $query="SELECT Name, image , Id , Price ,  t.User_id , tw.Date_time FROM ticket as t , ";
        $query.= "ticket_wish as tw where t.Id = tw.Item_id and tw.User_id = {$userId} ";
        $query.="order by tw.Date_time";
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
    { $query="SELECT Name, image , Id , tw.User_id , tw.Date_time FROM ticket as t , ";
        $query.= "ticket_wish as tw where t.Id = tw.Item_id and t.User_id = {$userId} ";
        $query.="order by tw.Date_time";
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