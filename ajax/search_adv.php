<?php

require_once '../config/config.php';
require_once '../includes/Database.php';
#require_once '../includes/Session.php';

#$sc_id=$_SESSION['school']['id'];

$sc_id=1;

$dbname=DB_NAME;
$host=DB_HOST;
$conn = null;
$columns='
    id,
    first_name,
    last_name,
    username,
    school_level as school_form,
    amount,
    email,
    dateAdded,
    lastUpdated
    ';

try{
    $conn=new PDO("mysql:host={$host};dbname={$dbname}", DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e){
    echo "Error: ".$e->getMessage();
    die('Database connection error');
}


$sql='SELECT '.$columns.' FROM students WHERE first_name LIKE :fq '; /* and last_name LIKE "%:lq" and username LIKE "%:uq"';*/

$stmt=$conn->prepare($sql);

$stmt->bindValue(':fq', $first_name,PDO::PARAM_STR);
$stmt->bindParam(':uq', $username);
$stmt->bindParam(':lq', $last_name);




// search a row
$first_name = ""%"";
$last_name = "";
$username = "";
$stmt->execute();

//$result=$stmt->fetchAll();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // ...
    print_r($result);
}




/*
if (isset($_POST['username'])){
$username=$_POST['username'];
$sql.=" WHERE username LIKE '%$username%' AND sch_id=$sc_id ";
}
if (isset($_POST['first_name'])){
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$sql.=" WHERE (first_name LIKE '%$first_name' AND last_name LIKE '%$last_name') AND sch_id=$sc_id ";
}
//echo $sql;
$result_set=mysqli_fetch_all( $database->query_database($sql));
if ($result_set){
    echo json_encode($result_set);
}else {
    echo 'no result set';
}
*/



?>

<?php
/*
if(isset($_POST['submit'])){
    	  if(isset($_GET['go'])){
       	  if(preg_match("^/[A-Za-z]+/", $_POST['name'])){
           	   $name=$_POST['name'];
            	  }
            	  }
            	  else{
               	  echo  "<p>Please enter a search query</p>";
       	  }

*/
?>