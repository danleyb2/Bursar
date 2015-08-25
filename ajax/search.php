<?php
require_once '../config/config.php';
require_once '../includes/Database.php';
// require_once '../includes/Session.php';

// $sc_id=$_SESSION['school']['id'];
$sc_id = 1;
$continue_search = true;

$columns = '
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

$sqls = 'SELECT ' . $columns . ' FROM students ';

// if search_query==1 wordsearch for username first
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // test cases username
    // $username='';
    // $username='f';

    // first search for an exact username match then exit
    $r1=search_match_username($username);

    if($r1){
        echo json_encode(mysqli_fetch_all($r1));
    }

    if ($continue_search) {

    $r1=search_like_username($username);
    if ($r1){
        #echo json_encode(mysqli_fetch_all($r1));
    }
    $r2=search_names_like_username($username);
    if ($r1){
        echo json_encode(mysqli_fetch_all($r1)+mysqli_fetch_all($r2));

    }

    }
}

// if search_query==2 words search for first and last_name first
if (isset($_POST['first_name'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // test cases
    // $first_name='Vaughan';
    // $last_name='Clemons';

    $r1=search_match_names($first_name, $last_name);
    if ($r1){
        echo json_encode(mysqli_fetch_all($r1));
    }



    if ($continue_search) {

       $r1= search_like_names($first_name, $last_name);
       $r2=search_username_like_names($first_name, $last_name);

       if ($r1){
           echo json_encode(mysqli_fetch_all($r1)+mysqli_fetch_all($r2));
       }

    }

}

/**
 *
 * @param string $sqlj
 * @return mysqli_result
 */
function helper($sqlj)
{
    global $database;
    global $sqls;
    $sql = $sqls . $sqlj.' LIMIT 5';

    return $database->query_database($sql);
}

/**
 * if username is given, use that first
 * TODO:pagination support
 * TODO:return a result set imediatley its found
 */

/**
 * Search for exact $username marches
 * TODO: check case
 * if result end search
 * else go on
 *
 * @param string $username
 */
function search_match_username($username)
{
    global $continue_search;
    $sql = "WHERE username='$username'";
    $result_set = helper($sql);
    if (mysqli_num_rows($result_set)==1){
        $continue_search = false;
        return $result_set;
    } else {
        return false;
    }
}

/**
 * TODO:search usernames LIKE param
 * then go on to search as a first or last names
 *
 * @param string $username
 */
function search_like_username($username)
{
    $sqlj = "WHERE username LIKE '%$username%' ";
    $result_set = helper($sqlj);
    if ($result_set) {

        return $result_set;
    } else {return false;}
}

/**
 * TODO:search exact match first and last names match<br>
 * todo: if no result switch names and research
 * todo:if result=1: end search
 *
 * @param string $first_name
 * @param string $last_name
 */
function search_match_names($first_name, $last_name)
{
    global $continue_search;
    $sqlj = "WHERE first_name='$first_name' AND last_name='$last_name'";
    $result_set = helper($sqlj);
    if (mysqli_num_rows($result_set)==1){
        $continue_search = false;
        return $result_set;

    } else {return false;}
}

/**
 * TODO:search where names like params
 * -switch names letter
 * -use each name as a username and search
 *
 * @param string $first_name
 * @param string $last_name
 */
function search_like_names($first_name, $last_name)
{
    $sqlj = "WHERE first_name LIKE '%$first_name%' OR last_name LIKE '%$last_name%'";
    $result_set = helper($sqlj);
    if ($result_set) {
        return $result_set;
    } else {return false;}
}

/**
 * TODO:search username in names
 *
 * @param string $username
 */
function search_names_like_username($username)
{
    $sqlj = "WHERE first_name LIKE '%$username%' OR last_name LIKE '%$username%'";
    $result_set = helper($sqlj);
    if ($result_set) {

        return $result_set;
    } else {return false;}
}

/**
 * search in each name in username
 *
 * @param string $first_name
 * @param string $last_name
 */
function search_username_like_names($first_name, $last_name)
{
    $sqlj = "WHERE username LIKE '%$first_name%' OR username LIKE '%$last_name%'";
    $result_set = helper($sqlj);
    if ($result_set) {

        return $result_set;
    } else {return false;}
}
/*
 * $dbname=DB_NAME;
 * $host=DB_HOST;
 */

/*
 * if (isset($_POST['username'])){
 * $username=$_POST['username'];
 * $sql.=" WHERE username LIKE '%$username%' AND sch_id=$sc_id ";
 * }
 * if (isset($_POST['first_name'])){
 * $first_name=$_POST['first_name'];
 * $last_name=$_POST['last_name'];
 * $sql.=" WHERE (first_name LIKE '%$first_name' AND last_name LIKE '%$last_name') AND sch_id=$sc_id ";
 * }
 * //echo $sql;
 * $result_set=mysqli_fetch_all( $database->query_database($sql));
 * if ($result_set){
 * echo json_encode($result_set);
 * }else {
 * echo 'no result set';
 * }
 */

?>

<?php
/*
 * if(isset($_POST['submit'])){
 * if(isset($_GET['go'])){
 * if(preg_match("^/[A-Za-z]+/", $_POST['name'])){
 * $name=$_POST['name'];
 * }
 * }
 * else{
 * echo "<p>Please enter a search query</p>";
 * }
 */
?>