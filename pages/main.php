<?php
require_once '../config/config.php';
include_once '../includes/Database.php';
require_once '../includes/Session.php';
include_once '../includes/School.php';

$page='main';
$debug=0;
$school_id=$_SESSION['school']['id'];
?>

<?php
/*
 * $q='select * from schools where id='.$_SESSION['school']['id'];
 */

print_prep($_SESSION);
print_br();
print_prep($session);
print_br();

if ($session->is_looged_in()) {
    print_br("Session is logged in");
} else {
    header("Location:../index.php");
}
#die();
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>School Bursar</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php include '../setup/js.php';?>
    <?php require '../setup/css.php';?>
</head>

<body>
<?php include '../template/header_main.php';?>

	<br>
	<!--MAIN CONTENT-->

	<div class="row">

		<!--    -->
		<!-- START PANE A   -->

		<div class="col s3 hide-on-small-and-down">




		<?php //TODO: Remove collapsible.. will use it in student and transactions listing ?>
			<ul class="collapsible popout" data-collapsible="accordion">

				<li class="srh">
					<div class="collapsible-header active">
						<i class="material-icons">people</i>Recent <span
							class="right addst_link"><i class="material-icons">add</i>New
							Student</span>
					</div>
					<div class="collapsible-body">
						<!--start listing details-->
						<div class="col s12 card-panel teal">

							<!--listing    -->
							<div>
								<div class="collection"><?php
        $q = 'SELECT * FROM students WHERE school_id=' .$school_id. ' LIMIT 10';
        $result_set = $database->query_database($q);
        while ($student = $database->assoc_array($result_set)) {
            /**
             * *
             * TODO:add student icon for beauty
             */
            ?>

                <div class="collection-item"
										student_id="<?php echo $student['id'];?>"
										style="cursor: pointer;">
										<span href="#!"><?php echo $student['first_name'].' '.$student['last_name'] ?></span>
										<span><?php echo $student['amount'];?></span> Shillings Form <span><?php echo $student['school_level'];?></span>

									</div>
               <?php }?>
               </div>
							</div>
							<!--listing -->



						</div>
						<!-- end listing details-->


					</div>
				</li>

			</ul>
		</div>



		<!-- END PANE A  -->
		<!-- START PANE B  -->
		<div class="col s12 m9 l9">
			<div class="row">

				<div class="col s12 m8">
					<div class="col s12">


						<!-- Start Login student -->
						<div class="col s12 card-panel teal">
							<form class="col s12 sign_in">



								<div class="row">
									<div class="input-field col s4">
										<input id="c_name" type="text"> <label for="c_name">Student Username</label>
									</div>


									<div class="input-field col s4">
										<input id="c_pass" type="text" autocomplete="off"> <label
											for="c_pass">Student Password</label>
									</div>
									<div class="input-field col s4">


												<button id="sign_in" class="btn waves-effect waves-light"
													type="submit" name="Sign In">
													Sign In <i class="material-icons right">send</i>
												</button>

									</div>

								</div>


							</form>

						</div>
						<!-- End student Login -->
					</div>
					<div class="col s12">
						<!--start transactions pane  -->


						<div class="card medium blue-grey darken-1">

							<div class="card-content white-text">
								<span class="card-title">Statistics</span>
							<?php

                            /**
                             * *
                             * TODO:displaying various statics from the database richest and poorest student,frequent student
                             */
                            ?>
							<div class="col s12">Max Transaction <?php echo $database->get_maxtr($school_id); ?></div>
							<div class="col s12">Min Transaction <?php echo $database->get_mintr($school_id);?></div>
							<div class="col s12">Richest student <?php echo $database->get_column_max($school_id, 'amount', 'students');?></div>
							</div>

							<div class="card-action">
								<a class="activator-tr" href="#">Do A Transaction</a> <a
									class="activator-an right" href="#">Add New Student</a>
							</div>

							<div class="card-reveal-an card-reveal">
								<!-- Add new -->
								<span class="card-title grey-text text-darken-4">Add New Student<i class="material-icons">cancel</i></span>

								<!-- New student form -->

								<div class="col s12">
									<form class="col s12">
										<div class="row">
											<div class="input-field col s4">
												<input id="first_name" type="text" class="validate"> <label
													for="first_name">First Name</label>
											</div>
											<div class="input-field col s4">
												<input id="last_name" type="text" class="validate"> <label
													for="last_name">Last Name</label>
											</div>
											<div class="input-field col s4">
												<input id="email" type="email" autocomplete="off"
													class="validate"> <label for="email">Email</label>
											</div>
										</div>
										<div class="row">
											<div class="input-field col s4">
												<input id="username" type="text" autocomplete="off"
													class="validate"> <label for="username">Username</label>
											</div>

											<div class="input-field col s4">
												<input id="password" type="password" autocomplete="off"
													class="validate"> <label for="password">Password</label>
											</div>
											<div class="input-field col s4">
												<input id="amount_in" type="text" autocomplete="off"
													class="validate"> <label for="amount_in">Amount</label>
											</div>
										</div>
										<div class="row">


											<div class="input-field col s4">
												<input id="s_form" type="text" class="validate"> <label
													for="s_form">School Grade</label>
											</div>
											<div class="input-field col s8">

												<button id="add" class="btn waves-effect waves-light"
													type="button" name="add">
													Add <i class="material-icons right">send</i>
												</button>
												<button id="c_add"
													class="btn waves-effect waves-light right " type="button"
													name="add">
													Cancel <i class="material-icons right">cancel</i>
												</button>
											</div>
										</div>
									</form>
								</div>

								<!-- End new student form -->



								<!-- p>Here is some more information about this product that is only revealed once clicked on.</p-->
							</div>
							<div class="card-reveal-tr card-reveal">
								<!-- Transact -->

								<span class="card-title grey-text text-darken-4">Do A
									Transaction<i class="material-icons">cancel</i>
								</span>


								<!-- Start transaction form -->

								<div class="col s12">
									<div class="row">
										<div class="col s3">
											<select id="tr_type" class="browser-default">
												<option value="" disabled selected>Transaction Type</option>
												<option value="1">Withdraw Ksh</option>
												<option value="2">Recharge Ksh</option>
												<?php //TODO:Add listener to options change ?>
											</select>
										</div>

										<input id="amount" style="width: 60px;" type="text"
											placeholder="Amount"> <span id="frto">from</span> <span class="current_student_name">no
											student</span>
									</div>
									<div class="col s12">
										<!-- Switch-->
										<div class="row">
										<div class="col s6">Validate with security question</div>
										<div class="col s5 switch right">
											<label>Off<input type="checkbox"><span class="lever"></span>On
											</label>
										</div>
										</div>

										<div class="row">
										<div class="col s6">Enter reason for transaction</div>
										<div class="col s5 switch right">
											<label>Off<input type="checkbox"><span class="lever"></span>On
											</label>
										</div>
										</div>

										<div class="row">
										<div class="col s6">Email transaction to Guardian</div>
										<div class="col s5 switch right">
											<label>Off<input type="checkbox"><span class="lever"></span>On
											</label>
										</div>
										</div>

									</div>
									<div class="col s12">
										<button class="btn waves-effect waves-light" type="button"
											name="cancel">
											Cancel <i class="material-icons left">cancel</i>
										</button>


										<button id="transact" class="btn waves-effect waves-light"
											type="button" name="transact">
											Submit <i class="material-icons right">send</i>
										</button>


										<!-- End transaction form -->
										<!--  p>Here is some more information about this product that is only revealed once clicked on.</p-->
									</div>

								</div>

							</div>
						</div>
						<!--end transactions pane  -->
					</div>
				</div>

				<!--start after transactions pane  -->
				<div class="col s12 m4 hide-on-small-and-down">


					<div class="col s12">
						<!-- start student details  -->
						<div class="card-panel teal the-return">

							<span>Login a Student for a transaction</span>
						</div>
						<!-- end student details  -->

					</div>

					<div class="col s12">
						<!-- start school status  -->
						<div class="card-panel teal">


							<p class="white-text" style="margin: 0;">You owe</p>
							<p class="white-text" style="margin: 0;">
								<span class="" id="all_students" style="font-size: 25px"><?php   $st = $school::all_students();   echo $st != null ? $st : 0;  ?></span>
								Students
							</p>
							<p class="white-text" style="margin: 0;">
								<span id="total_amount" style="font-size: 25px"><?php $am = $school::total_amount(); echo $am != null ? $am : 0;?></span>
								Shillings
							</p>
						</div>
						<!-- end school status   -->
					</div>




				</div>
				<!--end after transactions pane  -->

			</div>

		</div>
		<!-- END PANE B    -->

	</div>

	<!--END MAIN CONTENT-->
<?php include '../template/footer.php';?>
</body>

</html>