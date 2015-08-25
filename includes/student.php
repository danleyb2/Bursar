<?php
/**
 * @author: ndieks
 * TODO:rename file to Students
 */
require_once('Database.php');
require_once('Transaction.php');

class Student extends MysqlDatabase
{
    protected static $db_fields=array(
        'id',
        'first_name',
        'last_name',
        'password',
        'username',
        'school_level',
        'email',
        'amount',
        'dateAdded',
        'lastUpdated',
        'school_id');

    public  $amount;
    #public  $id;
    public $first_name;
    public $last_name;
    public $password;
    public $school_level;
    public $username;
    public $email;
    public $dateAdded;
    #public $lastUpdated;
    public $school_id;

    public static $table_name="students";
    function __construct()
    {
        $this->sch_id=$_SESSION['school']['id'];

    }
    static function withdraw($amnt=0,$id){
        global $database;
        global $transaction;
        $transaction_type="W";

        //TODO:select concat
        $query="select * from students where id=$id limit 1";
        $result_set=$database->assoc_array( $database->query_database($query));

        $amount=$result_set['amount'];
        //$id=$student['id'];

        if ($amount>=$amnt){
            //there is enough money for a successfull transaction
            $amount-=$amnt;
            $sql="UPDATE students SET amount=$amount WHERE id=$id limit 1";
            $database->query_database($sql);

            #insert transction data to table
            //$st=$_SESSION['student'];
            $st=$result_set;
            //print_prep($st);

            $tq="Insert into transactions(
            id,
            student_name,
            student_id,
            transaction_reason,
            transaction_amount,
            transaction_teller,
            transaction_type,
            transaction_date,
            sent_email,
            verified,
            school_id
            ) VALUES(
            NULL,
            '{$result_set['first_name']} {$result_set['last_name']}',
            $id,
            'No reason given',
            $amnt,
            'Brian',
            '$transaction_type',
            NULL,
            1,
            1,
            $st[school_id])";

            //TODO:Use transaction object to log transaction data

            $dt=$database->query_database($tq);
            if($dt){
                return  "Withdrawal  Succesfull! <br>New Balance ".$amount;

            }else{

                return mysqli_error($database->connection);
            }
        }else {
            return "Student has less money in account";

        }



        //********************//
        /*
        $object=new self();
        $object::instantiate($_SESSION['student']);
        $tr_record=array(
            student_fname=>$object->first_name,
            username=>$object->username,
            student_lname=>$object->last_name,
            school_id=>$object->sch_id,
             student_id=>$object->id,
             amount=>$amnt,
             transacted_by=>'Brian',
             transaction_type=>$transaction_type,
             transaction_date=>'none'
        );
        self::attributes();
        $tr=$transaction::instantiate($tr_record);
        $tr::add_new();/*
        $event=$student['first_name']." ".$student['last_name']." WITHDREW ".$amnt;
        logEvent($event);*/

       // $database->close_connection();



    }
    static function recharge($amnt=0,$id){
        global $database;
        $transaction_type="R";
        //$student=$_SESSION['student'];

        $query="SELECT * FROM students WHERE id=$id LIMIT 1";
        $result_set=$database->assoc_array($database->query_database($query));

        $amount=$result_set['amount'];

        //$id=$student['id'];

        $amount+=$amnt;

        $sql="UPDATE students SET amount=$amount WHERE id=$id limit 1";

        $database->query_database($sql);
        //*******************//




        //$event=$student['first_name']." ".$student['last_name']." RECHARGED ".$amnt;

        //logEvent($event);
        //$st=$_SESSION['student'];
        $st=$result_set;
        $tq="Insert into transactions(
            id,
            student_name,
            student_id,
            transaction_reason,
            transaction_amount,
            transaction_teller,
            transaction_type,
            transaction_date,
            sent_email,
            verified,
            school_id
            ) VALUES(
            NULL,
            '{$result_set['first_name']} {$result_set['last_name']}',
            $id,
            'No reason given',
            $amnt,
            'Brian',
            '$transaction_type',
            NULL,
            1,
            1,
            $st[school_id])";


        $dt=$database->query_database($tq);
        if($dt){

            return  "Recharge Succesfull!!.<br> New Balance is ".$amount;

        }else{

            return mysqli_error($database->connection);
        }

        //$database->close_connection();
    }
    static function st_check($name="",$pass=""){
        global $database;

        $sch_id=$_SESSION['school']['id'];
        $sql="SELECT
            id,
            first_name,
            last_name,
            username,
            school_level as school_form,
            amount,
            email,
            dateAdded,
            lastUpdated FROM students WHERE username='".$name."' AND password='".sha1($pass)."' AND school_id=$sch_id";
        $result_set=$database->assoc_array( $database->query_database($sql));
        if ($result_set){
            return $result_set;
        }else {

            return false;
        }


    }

    public  function add_new(){
        global $database;

        #Encrypting password
        $this->dateAdded=strftime("%Y-%m-%d %H:%M:%S",time());
        $this->password=sha1($this->password);
        $this->school_id=get_school_id();

        $attributes=$this->sanitized_attributes();

        $sql="INSERT INTO ".self::$table_name."(";
        $sql.=join(", ", array_keys($attributes));
        $sql.=")VALUES('";
        $sql.=join("','", array_values($attributes));
        $sql.="')";

        if ($database->query_database($sql)){
            //
            return true;
        }else {
            return false;
        }

    }







}

?>