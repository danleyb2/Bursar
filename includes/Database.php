<?php



class MysqlDatabase{

    public  $connection;
    private $magic_quotes;

    function __construct(){
        $this->open_connection();
        $this->magic_quotes=get_magic_quotes_gpc();

    }
    public function open_connection(){
        $this->connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD/*,DB_NAME*/);
        if ($this->connection){
            $selection=mysqli_select_db($this->connection, DB_NAME);
            if ($selection){
                //selection succesfull
            }else {
                echo "database selection failed";
                die();
            }
        }else {

            //Connection failed
            echo "database connection failed";
            die();
        }

    }
    public function close_connection(){
        if (isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
    public function query_database($sql){
        $result=mysqli_query($this->connection,$sql);
        if (!$result){

            die("Query failed: Code ".mysqli_errno($this->connection).". Error: ". mysqli_error($this->connection));
        }
        return $result;
    }
    public function assoc_array($result_set){
        return mysqli_fetch_assoc($result_set);
    }
    public function sec_value($val){
        if ($this->magic_quotes){
        $val=stripslashes($val);
        $val=mysqli_real_escape_string($this->connection, $val);

        }
        return $val;
    }

    public function attributes(){
        $attributes=array();
        $class_name=get_called_class();


        foreach ($class_name::$db_fields as $field){
            if (property_exists($this, $field)){
                $attributes[$field]=$this->$field;
            }
        }

        return $attributes;

    }
    public function sanitized_attributes(){
        global $database;
        $clean_attributes=array();
        foreach ($this->attributes() as $key=>$value){
            $clean_attributes[$key]=$database->sec_value($value);

        }
        return $clean_attributes;

    }
    private function has_attribute($attribute){

        $object_vars=$this->attributes();

        return array_key_exists($attribute, $object_vars);
    }
    public static function instantiate($record){


        $class_name=get_called_class();

        #echo $class_name;


        $object=new $class_name();

        foreach ($record as $attribute=>$value) {

            if ($object->has_attribute($attribute)) {
                $object->$attribute=$value;


            }

        }
        return $object;
    }


    public  function get_column_max($school_id,$column,$table){


        $query="SELECT MAX($column) AS max from $table WHERE school_id=$school_id";
        $result_set=mysqli_query($this->connection, $query);
        if ($result_set){
            $rs=mysqli_fetch_assoc($result_set);
            return  $rs['max'];
        }else {
            return false;
        }

    }


    public  function get_column_total($school_id,$column,$table){

        $query="SELECT MAX($column) AS max from $table WHERE school_id=$school_id";
        $result_set=mysqli_query($this->connection, $query);


        if ($result_set){
            $rs=mysqli_fetch_assoc($result_set);
            return  $rs['max'];
        }else {
            return false;
        }

    }



    public  function  get_maxtr($school_id){

        #TODO:query the max transaction from database
        $query="SELECT MAX(amount) AS maxtr from transactions WHERE school_id=$school_id";
        $result_set=mysqli_query($this->connection, $query);

        if ($result_set){
            $rs=mysqli_fetch_assoc($result_set);
            return  $rs['maxtr'];
        }else {
            return 0;
        }
    }
    public  function  get_mintr($school_id){
        #TODO:query the min transaction from database
        $query="SELECT MIN(amount) AS mintr from transactions WHERE school_id=$school_id";
        $result_set=mysqli_query($this->connection, $query);

        if ($result_set){
            $rs=mysqli_fetch_assoc($result_set);
            return  $rs['mintr'];
        }else {
            return 0;
        }
    }
    public  function  get_totaltr($school_id){
        #TODO:query the no of transactions from database
        $query="SELECT COUNT(*) AS totaltr from transactions WHERE school_id=$school_id";
        $rs=mysqli_fetch_assoc(mysqli_query($this->connection, $query));
        if ($rs){
            return  $rs['totaltr'];
        }else {
            return 0;
        }

    }


    //For Subclasses//

}
if (!isset($database)){
$database=new MysqlDatabase();
}
?>