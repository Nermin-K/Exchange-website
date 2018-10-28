<?php

class user
{
    
 private $connection;
    function __construct ($c){
        $this->connection=$c;
    }

    public function getUserById($userId)
    {
        $query = "SELECT * FROM user Where Id= {$userId}";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
           return -1;
        }
        else{
            return mysqli_fetch_assoc($result); //loop through this result set with mysqli fetch assoc
        }
    }

    public function addUser($F_name ,$L_name ,$Password ,$Phone_no ,$Picture ,$Email ,$FB_account)
    {
        //escape strings to insert safely in database
        $fn=mysqli_real_escape_string($this->connection ,$F_name);
        $ln=mysqli_real_escape_string($this->connection ,$L_name);
        $p=mysqli_real_escape_string($this->connection, $Password);
        $ph=( $Phone_no);
        $i =mysqli_real_escape_string($this->connection , $Picture);
        $e =mysqli_real_escape_string($this->connection , $Email);
        $fb =mysqli_real_escape_string($this->connection , $FB_account);

        $query = "INSERT INTO user (F_name , L_name ,Password , Phone_no , Picture , Email , FB_account ) ".
            "VALUES ('{$fn}' , '{$ln}' , '{$p}' , '{$ph}' ,'{$i}', '{$e}' , '{$fb}' )";

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

    public function getUserByEmail ($e){
        $query = "SELECT * FROM user WHERE Email = '{$e}'";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error not that the database didn't find a match for the required
            return -1;
        }
        else{
            return mysqli_fetch_assoc($result); //loop through this result set with mysqli fetch assoc
        }
    }

    public function updateUser($Id ,$F_name ,$L_name ,$Password ,$Phone_no ,$Picture ,$Email ,$FB_account)
    {
        //escape strings to insert safely in database
        $id=(int)$Id;
        $fn=mysqli_real_escape_string($this->connection ,$F_name);
        $ln=mysqli_real_escape_string($this->connection ,$L_name);
        $p=mysqli_real_escape_string($this->connection ,$Password);
        $ph=mysqli_real_escape_string($this->connection , $Phone_no);
        $i =mysqli_real_escape_string($this->connection , $Picture);
        $e =mysqli_real_escape_string($this->connection , $Email);
        $fb =mysqli_real_escape_string($this->connection , $FB_account);

        $query ="UPDATE user SET F_name = '{$fn}' , L_name = '{$ln}' , Password = '{$p}' , Phone_no = '{$ph}' , Picture = '{$i}' , Email = '{$e}' , FB_account = '{$fb}' ".
            "WHERE Id = {$id} ";

        $result = mysqli_query($this->connection , $query);
        if ($result  && mysqli_affected_rows($this->connection)==1)
        {
            return 1;
        }
        else
            return -1;
    }

    public function getIdByMail($email)
    {
        $query="select Id from user where Email= '{$email}' ";
        $result=mysqli_query($this->connection , $query);
        if(!$result)
        {
            return -1;

        }
        else
        {
            $res=mysqli_fetch_assoc($result);
            $id=(int)$res["Id"];
            mysqli_free_result($result);
            return $id;

        }

    }
    public function getUserID($password,$email)
    {
        $password=mysqli_real_escape_string($this->connection ,$password);
        $fn=mysqli_real_escape_string($this->connection,$email );
        $query="SELECT Id FROM user WHERE Password='{$password}' and Email='{$email}'";
        $result=mysqli_query($this->connection,$query);
        if(!$result)
        {
            return -1;
        }
        else
        {  if(mysqli_num_rows($result)==1 )
        {
            $res=mysqli_fetch_assoc($result);
            $id=(int)$res["Id"];
            mysqli_free_result($result);
            return $id;
        }
        else return -2;

        }
    }
    public function deleteUser($id)
    {
        $query="DELETE FROM user WHERE Id = {$id} ";
        $result=mysqli_query($this->connection , $query);
        if(!$result)
        {
            return -1;
        }
        else return 1;

    }

}