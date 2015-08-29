<?php
if (!defined('__ROOT__')){
    define('__ROOT__', dirname(__FILE__));
}

require_once __ROOT__.'/error_reporting.php';
require_once __ROOT__.'/config/config.php';
require_once __ROOT__.'/includes/Session.php';
require_once __ROOT__.'/includes/school.php';
require_once __ROOT__.'/functions/functions.php';


$debug=0;
$page='login';

if ($session->is_looged_in()) {
    $session->end_session();
}

if (isset($_POST['school_name']) && isset($_POST['sc_password'])) {

    $sch_data = School::check($_POST['school_name'], $_POST['sc_password']);

    if ($sch_data) {
        print_prep($sch_data);
        $session->login($sch_data);

        $school = School::instantiate($sch_data);
        print_prep($school);
        #die();



        redirect('pages/main.php');
    } else {
        $_SESSION['message'] = "Wrong school name password combination";
        $forgot_pass=true;
    }
} else {
    // redirect('index.php');
}

?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>School Bursar</title>

    <?php
    $bsrc='lib/js/';
    include 'setup/js.php';?>


    <?php
    $bhref='lib/';
    require 'setup/css.php';?>
</head>

<body>
<?php
$state='<a href="signup.php">Sign Up</a>';

include 'template/header_index.php';?>
<br>

<main>

	<div class="container">


		<div class="row">
			<h2 class="content-head center">Welcome To The School Bursar.</h2>

			<div class="col s12">
				<div class="col l5 m5 s12 ">
					<p>


                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }

                ?>

                </p>
					<form class="" method="post"
						action="index.php">


							<label for="school_name">School Username</label>
							<input id="school_name" name="school_name" type="text" placeholder="The School Username or Email">

							<label for="sc_password">School Password</label>
							<input id="sc_password" name="sc_password" type="password" placeholder="The School Password">



							<button id="submit" class="btn waves-effect waves-light right"
    							type="submit" name="">Sign In
    							 <i class="material-icons right">send</i>
    						</button><br>
    						<span id="" >Need an account? <a href="signup.php">Sign up</a></span>


					</form>
					<?php if(isset($forgot_pass) && $forgot_pass){?>
					<p><a href="forgot.php" class="right">Forgot password</a></p>
					<?php }?>
				</div>

				<div class="col s6 right hide-on-small-and-down">


					<h4>About</h4>
					<p>We help you manage the funds for your students, We don't store
						the money. Just the data about your transactions, try it to find
						out how easy it is.</p>
					<h4>Contact Us</h4>
					<p>ndieksman@gmail.com</p>
				</div>
			</div>

		</div>
	</div>
	</main>
<?php include 'template/footer.php';?>
</body>