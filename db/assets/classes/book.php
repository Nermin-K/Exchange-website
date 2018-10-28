<?php



class book
{


 private $connection;

    function __construct ($c){
        $this->connection=$c;
    }


    public function getBookCategories()
    {
        $query = "SELECT * FROM book_category";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function addBook($name ,$price ,$image ,$description ,$category, $subject, $userID)
    {
        //escape strings to insert safely in database
        $myDate = date("Y-m-d H:i:s");
        $n=mysqli_real_escape_string($this->connection ,$name);
        $d=mysqli_real_escape_string($this->connection, $description);
        $i=mysqli_real_escape_string($this->connection, $image);
        $c =mysqli_real_escape_string($this->connection , $category);
        $s =mysqli_real_escape_string($this->connection , $subject);
        $user=(int)$userID;
        $p=(float)$price;

        $query = "INSERT INTO book (Name , Date_time ,Price , image , Description , Category_name , Subcategory_name , User_id ) ".
            "VALUES ('{$n}' , '{$myDate}' , {$p} , '{$i}' ,'{$d}', '{$c}' ,'{$s}' , {$user} )";

        $result = mysqli_query($this->connection , $query);
        if($result){
            //success
            //redirect_to ("somepage")
            return 1;
        }else {
            //failure , message= subject creatin failed;
            return -1;
        }
    }

    public function getAllItems  (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM book";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the requiredretu
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }
    public function getMostRecent (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM book ORDER BY Date_time DESC";
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

        $query="UPDATE book SET Name = '{$n}' , Price = {$p} , Description = '{$d}' , Availability = {$a} , image = '{$i}' WHERE Id = {$id}";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function deleteItem($ID){

        $id=(int)$ID;

        $query="DELETE FROM book WHERE Id= {$id} LIMIT 1";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function getItemById($id)
    {
        $query = "SELECT * FROM book WHERE Id = {$id}";
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
        $query = "INSERT INTO book_wish (Item_id, Date_time, User_id) VALUES ({$iId}, '{$date}', {$uId})";
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

        $query = "SELECT * FROM book_wish WHERE Item_id = {$iId} AND User_id= {$uId}";
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
        $query = "DELETE FROM book_wish WHERE Item_id = {$iId} AND User_id = {$uId}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return 1;
        }else {
            //failure , message= subject creating failed;
            return -1;
        }
    }

    public function getAddedBook($id){
        $query = "SELECT Date_time , Name , Price ,Id FROM book WHERE User_id={$id}";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the requiredre
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function searchByName($name)
    {
        $query = "SELECT * FROM book WHERE Name LIKE '%{$name}%'";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return $result;
        }else {
            //failure , message= subject creating failed;
           return -1;
        }

    }

    public function sortByPrice(){
        $query = " SELECT Date_time , Id , Name , Price , image FROM book ORDER BY Price";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
          return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }

    }

    public function getWishes($userId)
    {
        $query="SELECT Name, Price , image , Id , b.User_id , bw.Date_time FROM book as b , ";
        $query.= "book_wish as bw where b.Id = bw.Item_id AND bw.User_id = {$userId} ";
        $query.="order by bw.Date_time Desc";
        $result=mysqli_query($this->connection,$query);
        if(!$result)
        {
            return -1;
        }
        else
        {
            return $result;
        }


    }
    public function getNotifications($userId)
    { $query="SELECT Name, image , Id , bw.User_id  , bw.Date_time FROM book as b , ";
        $query.= "book_wish as bw where b.Id = bw.Item_id and b.User_id = {$userId} ";
        $query.="order by bw.Date_time";
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
    public function getBooksByCategory($categ_name)
    {
        $query="SELECT Id , Name , Price , image , Date_time FROM book where Category_name = '{$categ_name}'";
        $result = mysqli_query($this->connection,$query);
        if(!$result)
        {
            return -1;

        }
        else
        {
            return $result;
        }


    }

    public function countBooks(){

        $query="SELECT COUNT(*) as total FROM book";
        $result=mysqli_query($this->connection , $query);
        if (!$result)
            return -1;
        else
            return $result;
    }

}