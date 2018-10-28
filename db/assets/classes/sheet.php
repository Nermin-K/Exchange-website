<?php


class sheet
{
    private $connection;

    function __construct ($c){
        $this->connection=$c;
    }


    public function getDepartments()
    {
        $query = "SELECT * FROM department";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function addSheet($name ,$price ,$image ,$description ,$department, $subject,$year ,$semester, $userID)
    {
        //escape strings to insert safely in database
        $myDate = date("Y-m-d H:i:s");
        $n=mysqli_real_escape_string($this->connection ,$name);
        $d=mysqli_real_escape_string($this->connection, $description);
        $i=mysqli_real_escape_string($this->connection, $image);
        $dept =mysqli_real_escape_string($this->connection , $department);
        $s =mysqli_real_escape_string($this->connection , $subject);
        $user=(int)$userID;
        $p=(float)$price;
        $y=(int) $year;
        $sem =(int )$semester;

        $query = "INSERT INTO sheet (Name , Date_time ,Price , image , Description , Dept_name ,".
        " Subject_name , Subject_year , Subject_semester , User_id ) ".
            "VALUES ('{$n}' , '{$myDate}' , {$p} , '{$i}' ,'{$d}', '{$dept}' ,'{$s}' , {$y}  , {$sem} ,{$user} )";

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
        $query = "SELECT Id , Name , Price , image , Date_time FROM sheet";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }
    }

    public function getMostRecent (){
        $query = "SELECT Id , Name , Price , image , Date_time FROM sheet ORDER BY Date_time DESC";
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

        $query="UPDATE sheet SET Name = '{$n}' , Price = {$p} , Description = '{$d}' , Availability = {$a} , image = '{$i}' WHERE Id={$id}";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function deleteItem($ID){

        $id=(int)$ID;

        $query="DELETE FROM sheet WHERE Id= {$id} LIMIT 1";
        $result=mysqli_query($this->connection , $query);
        if ($result && mysqli_affected_rows($this->connection)==1)
            return 1;
        else
            return -1;
    }

    public function getItemById($id)
    {
        $query = "SELECT * FROM sheet WHERE Id = {$id}";
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
        $query = "INSERT INTO sheet_wish (Item_id, Date_time, User_id) VALUES ({$iId}, '{$date}', {$uId})";
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

        $query = "SELECT * FROM sheet_wish WHERE Item_id = {$iId} AND User_id= {$uId}";
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
        $query = "DELETE FROM sheet_wish WHERE Item_id = {$iId} AND User_id = {$uId}";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return 1;
        }else {
            //failure , message= subject creating failed;
          return -1; // get the most recent error in connection
        }
    }

    public function getAddedSheet($id){
        $query = "SELECT Date_time , Name , Price ,Id FROM sheet WHERE User_id={$id}";
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
        $query = "SELECT * FROM sheet WHERE Name LIKE '%{$name}%'";
        $result = mysqli_query($this->connection , $query);
        if($result){
            return $result;
        }else {
            //failure , message= subject creating failed;
            return -1; // get the most recent error in connection
        }

    }

    public function sortByPrice()
    {
        $query = " SELECT Date_time , Id , Name , Price , image FROM sheet ORDER BY Price";
        $result = mysqli_query($this->connection, $query);
        if (!$result) { //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        } else {
            return $result; //loop through this result set with mysqli fetch assoc
        }

    }

    public function getWishes($userId)
    { $query="SELECT Name, image , Price , Id , s.User_id , sw.Date_time FROM sheet as s , ";
        $query.= "sheet_wish as sw where s.Id = sw.Item_id and sw.User_id = {$userId} ";
        $query.="order by sw.Date_time";
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
    { $query="SELECT Name, image , Id , sw.User_id , sw.Date_time FROM sheet as s , ";
        $query.= "sheet_wish as sw where s.Id = sw.Item_id and s.User_id = {$userId} ";
        $query.="order by sw.Date_time";
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
    public function getSheetsByDep($dept_name)
    {

        $query = "SELECT Id , Name , image , Price , Date_time  FROM sheet where Dept_name='{$dept_name}'";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
        
            return -1;
        }
        else{
            return $result; //loop through this result set with mysqli fetch assoc
        }


    }
    public function getSheetsByYear($year)
    {

        $query = "SELECT Id , Name , image , Price , Date_time FROM sheet where Subject_year = {$year}";
        $result = mysqli_query($this->connection , $query);
        if(!$result){
            
            return -1;
        }
        else
        {
            return $result;
        }


    }
    public function getSheetsBySemester($semester)
    {

        $query = "SELECT Id , Name , image , Price , Date_time FROM sheet WHERE Subject_semester = {$semester}";
        $result = mysqli_query($this->connection , $query);
        if(!$result)
        {
            return -1;
        }
        else
        {
            return $result;
        }


    }

    public function countSheets(){

        $query="SELECT COUNT(*) as total FROM sheet";
        $result=mysqli_query($this->connection , $query);
        if (!$result)
            return -1;
        else
            return $result;
    }
}