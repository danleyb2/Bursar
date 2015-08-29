<?php
if (!defined('__ROOT__')){
    define('__ROOT__', dirname(__DIR__));
}



require_once __ROOT__.'/config/config.php';
include_once __ROOT__.'/includes/Database.php';
require_once __ROOT__.'/includes/Session.php';
require_once __ROOT__.'/includes/School.php';
require_once __ROOT__.'/functions/functions.php';

$page = 'students';
$debug = 0;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>School Bursar</title>
    <?php  include '../setup/js.php';?>
    <?php require '../setup/css.php';?>
</head>
<body>
<?php include '../template/header_main.php';?>
<main>
<div class="container">

    <div class="collection with-header row">
    	<div class="collection-header col s12">
    		<div class="col s7">
    			<div class="col s4"><a><?php echo "First Last";  ?></a></div>
    			<div class="col s3"><a><?php echo "Username";  ?></a></div>
    			<div class="col s2"><a><?php echo "Amount"; ?></a></div>
    			<div class="col s1"><a><?php echo "Form";?></a></div>
    		</div>
    	</div>
<?php

$connection = $database->connection;
// Set how many records do you want to display per page.
$per_page = 20;
$query = 'students';
$query = "SELECT COUNT(*) as `num` FROM {$query}";
$row = mysqli_fetch_row(mysqli_query($connection, $query));
print_prep($row);

$numrows = $row[0];

$totaltpages = ceil($numrows / $per_page);
$page = (int) (! isset($_GET["page"]) ? 1 : $_GET["page"]);
$page = ($page > $totaltpages ? $totaltpages : $page);
$page = ($page < 1 ? 1 : $page);

$offset = ($page - 1) * $per_page;

$statement = "`students` ORDER BY `id` ASC"; // Change `records` according to your table name.

$results = mysqli_query($connection, "SELECT * FROM {$statement} LIMIT {$offset} , {$per_page}");

if (mysqli_num_rows($results) != 0) {

    // displaying records.
    while ($student = mysqli_fetch_assoc($results)) {
        ?>

    <div class="collection-item col s12">
		<div class="col s7">
			<div class="col s4"><a><?php   echo $student['first_name']." ". $student['last_name']; ?></a></div>
			<div class="col s3"><a><?php  echo $student['username'];  ?></a></div>
			<div class="col s2"><a><?php echo  $student['amount']; ?></a></div>
			<div class="col s1"><a> <?php  echo $student['school_level'];?></a></div>
		</div>
		<div class="col s1 right del_stu" id="<?php echo $student['id'];?>">
			<a href="#"><i class="material-icons ">delete</i></a>
		</div>
		<div class="col s1 right">
			<a class="">Edit</a>
		</div>
		<div class="col s1 right">
			<a class="">Transact</a>
		</div>
	</div>
    <?php
    }
} else {
    echo "No records were found.";
}

$url = '?';

$prev = $page - 1;
$next = $page + 1;

if ($totaltpages > 1) {

    ?>
        <div class="col s12 center">
				<ul class="pagination">
					<li class="disabled"><a><?php echo "Page $page of $totaltpages";?></a></li>



        <?php

    if ($page == 1) {

        ?>
            <li class="disabled"><a
						href=<?php echo "{$url}page={$prev}"?>><i class="material-icons">chevron_left</i></a></li>

      <?php
    } else {

        ?>
          <li><a href=<?php echo "{$url}page=1"?>><i
							class="material-icons">chevron_left</i></a></li>

					<li><a href=<?php echo "{$url}page={$prev}"?>><i
							class="material-icons">chevron_left</i></a></li>

          <?php
    }
    $range = 4;

    for ($counter = ($page - $range); $counter < (($page + $range) + 1); $counter ++) {
        if (($counter > 0) && ($counter <= $totaltpages)) {
            // echo "<b>$counter</b>";

            if ($counter == $page) {

                ?>
                <li class="active"><a><?php echo $counter?></a></li>
                <?php
            } else {

                ?>
                    <li class="waves-effect"><a
						href=<?php echo "{$url}page={$counter}"?>><?php echo "{$counter}"?></a></li>



                    <?php
            }
        }
    }

    if ($page != $totaltpages) {

        ?>

                    <li class="waves-effect"><a
						href=<?php echo "{$url}page={$next}"?>><i class="material-icons">chevron_right</i></a></li>

					<li class="waves-effect"><a
						href=<?php echo "{$url}page=$totaltpages"?>> <i
							class="material-icons">chevron_right</i>


					</a></li>


                    <?php
    } else {
        ?>
    <li class="disabled"><a> <i class="material-icons">chevron_right</i></a></li>
					<li class="disabled"><a> <i class="material-icons">chevron_right</i></a></li>

<?php }} ?>
                  </ul>
			</div>


<?php
/*
 * if ($session->is_looged_in()){
 *
 * $dt=$school->findAllStudents($_SESSION['school']['id']);
 * foreach ($dt as $student)://loop though creat a table?>
 *
 * <div class="collection-item col s12" >
 * <div class="col s7">
 * <div class="col s4"><a><?php echo $student[0]." ". $student[1]; ?></a></div>
 * <div class="col s3"><a><?php echo $student[2]; ?></a></div>
 * <div class="col s2"><a> <?php echo $student[3]; ?></a></div>
 * <div class="col s1"><a> <?php echo $student[4];?></a></div>
 * </div>
 * <div class="col s1 right del_stu" id="<?php echo $student[5];?>"> <a href="#">Delete</a></div>
 * <div class="col s1 right"> <a class="">Edit</a></div>
 * <div class="col s1 right"><a class="">Transact</a></div>
 * </div>
 * <?php endforeach;?>
 * <div class="col s6 center">
 *
 * <ul class="pagination">
 * <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
 * <li class="active"><a href="#!">1</a></li>
 * <li class="waves-effect"><a href="#!">2</a></li>
 * <li class="waves-effect"><a href="#!">3</a></li>
 * <li class="waves-effect"><a href="#!">4</a></li>
 * <li class="waves-effect"><a href="#!">5</a></li>
 * <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
 * </ul>
 * </div>
 *
 *
 * <?php
 * }else {
 * echo "Log in";
 * }
 */
?>

</div>

	</div>
</main>

<?php include '../template/footer.php';?>
</body>

</html>

