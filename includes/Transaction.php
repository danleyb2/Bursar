<?php
#require_once 'Database.php';

class Transactions extends MysqlDatabase
{
    protected static $db_fields=array(
        'id',
        'student_id',
        'transaction_reason',
        'transaction_amount',
        'transaction_teller',
        'transaction_type',
        'transaction_date',
        'sent_email',
        'verified',
        'school_id');


    #public $id;
    public $verified;
    public $sent_email;
    public $school_id;
    public $student_id;
    public $transaction_amount;
    public $transaction_teller;
    public $transaction_type;
    public $transaction_date;
    public $transaction_reason;

    protected static $table_name="transactions";


    private  function  delete_transaction($student_id,$school_id,$tr_id){
        $sql="DELETE FROM transactions WHERE ";

        if($student_id){
            $sql.="student_id=".$student_id;

        }
        if ($school_id){
            if ($student_id)$sql.=" AND ";
            $sql.=" school_id=".$school_id;

        }
        if ($tr_id){
            if ($student_id || $school_id)$sql.=" AND ";
            $sql.=" id=".$tr_id;

        }

        echo $sql;

    }
    private function download_tr($school_id){

    }
    private function delete_schtr($school_id){
        $this->delete_transaction(false, $school_id, false);
    }
    public function delete_tr($tr_id){
        $this->delete_transaction(false, false, $tr_id);
    }
    private function delete_sttr(){
        $this->delete_transaction($student_id, false, false);
    }

    public function findAllTransactions($sch_id){
        $sql="select amount,transaction_date,transaction_type,transaction_teller,id from transactions where school_id=$sch_id ORDER BY transaction_date ASC  limit 17";
        $result=mysqli_fetch_all($this->query_database($sql));
        return $result;
    }
    public static  function add_new(){
        global $database;

        $this->verified=0;
        $this->sent_email=0;
        $this->transaction_reason='none given';

        $attributes=self::sanitized_attributes();
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
if (!isset($transactions)){
$transactions=new Transactions();
}
?>