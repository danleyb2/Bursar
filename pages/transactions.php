<?php
require_once '../config/config.php';
include_once '../includes/Database.php';
require_once '../includes/Session.php';


require_once '../includes/Transaction.php';
require_once '../functions/functions.php';

$page='transactions';
$debug=0;

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Bursar</title>
    <?php include '../setup/js.php';?>
    <?php require '../setup/css.php';?>
</head>

<body>
<?php include '../template/header_main.php';?>

<div class="container">
<div class="collection with-header row">
  <div class="collection-header col s12" >
    <div class="col s12">
    <div class="col s2"><a><?php   echo "Name";  ?></a></div>
    <div class="col s1"><a> <?php  echo "Amount"; ?></a></div>
    <div class="col s1"><a> <?php  echo "Teller";?></a></div>
    <div class="col s3"><a> <?php  echo "Date";?></a></div>
    <div class="col s2"><a> <?php  echo "Type";?></a></div>
    <div class="col s1"><a> <?php  echo "Verified";?></a></div>
    </div>
</div>
<?php


$connection = $database->connection;
// Set how many records do you want to display per page.
$per_page = 5;
$query = 'transactions';
$query = "SELECT COUNT(*) as `num` FROM {$query}";
$row = mysqli_fetch_row(mysqli_query($connection, $query));
print_prep($row);

$numrows = $row[0];

$totaltpages = ceil($numrows / $per_page);
$page = (int) (! isset($_GET["page"]) ? 1 : $_GET["page"]);
$page = ($page > $totaltpages ? $totaltpages : $page);
$page = ($page < 1 ? 1 : $page);

$offset = ($page - 1) * $per_page;

$statement = "`transactions` ORDER BY `id` ASC"; // Change `records` according to your table name.

$results = mysqli_query($connection, "SELECT * FROM {$statement} LIMIT {$offset} , {$per_page}");



if (mysqli_num_rows($results) != 0) {

    // displaying records.
    while ($student = mysqli_fetch_assoc($results)) {?>


    <div class="collection-item col s12" >
    <div class="col s12">
    <div class="col s2"><a><?php   echo $student['student_name'];   ?></a></div>
    <div class="col s1"><a> <?php echo  $student['transaction_amount']; ?></a></div>
    <div class="col s1"><a> <?php  echo $student['transaction_teller'];?></a></div>
    <div class="col s3"><a> <?php  echo $student['transaction_date'];?></a></div>
    <div class="col s2"><a> <?php  echo $student['transaction_type']=='W'?'Withdraw':'Recharge'; ?></a></div>
    <div class="col s1"><a> <?php  echo $student['verified'];?></a></div>

   <div class="col s1 right del_tr" id="<?php echo $student['id'];?>"> <a href="#"><i class="material-icons ">delete</i></a></div>
   <div class="col s1 right"> <a class="">Details</a></div>
</div>
    </div>
    <?php
    }
}else {
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




</div>

</div>






<?php include '../template/footer.php';?>
</body>

</html>

