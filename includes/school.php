<?php
require_once __DIR__.'/Database.php';

class School extends MysqlDatabase
{
    protected static $db_fields=array('id','name','username','password','admin','email','dateAdded');

   # public $id
    public $username;
    public $name;
    public $admin;
    public $email;
    public $password;
   # public $dateAdded;

    protected static $table_name="schools";

    public function findAllStudents($sch_id){
        $sql="select first_name,last_name,username,amount,school_level,id from students where school_id=$sch_id ORDER BY first_name ASC  limit 20";
        $result=mysqli_fetch_all($this->query_database($sql));
        return $result;
    }

    public static  function all_students(){
        global $database;

        $sql="select count(id) as total_st from students where school_id={$_SESSION['school']['id']}";

        $result_set= $database->assoc_array($database->query_database($sql));

        return  $result_set['total_st'];

    }
    public static function total_amount(){
        global $database;

        $sql="select sum(amount) as total_am from students where school_id={$_SESSION['school']['id']}";
        $result_set=$database->assoc_array($database->query_database($sql));
        return  $result_set['total_am'];

    }
    public static  function check($sch="", $pass=""){
        global $database;
        /***
         *
         */



        $sql="SELECT id,name,username,email,admin,dateAdded FROM schools WHERE ";

        if (validateEmail($sch)){
            $sql.="email='".$sch;
        }else {
            $sql.="username='".$sch;
        }
        $sql.="' AND ";
        $sql.="password='".sha1($pass);
        $sql.="' LIMIT 1";

        $result_set=$database->assoc_array($database->query_database($sql));
        if ($result_set){

            return $result_set;

        }else {
            return false;
        }

    }

    public  function add_new(){
    global $database;
    $this->password=sha1($this->password);
    #$this->dateAdded='null';


    $attributes=$this->sanitized_attributes();

    $sql="INSERT INTO ".self::$table_name."(";
    $sql.=join(", ", array_keys($attributes));
    $sql.=")VALUES('";
    $sql.=join("','", array_values($attributes));
    $sql.="')";


    if ($this->query_database($sql)){
        //
        return true;
    }else {
        return false;
    }

}



}
$school=new School();

?>