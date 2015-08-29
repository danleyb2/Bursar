<?php
if (!defined('__ROOT__')){
    define('__ROOT__', dirname(__FILE__));
}


require_once __ROOT__.'/error_reporting.php';
require_once __ROOT__.'/config/config.php';
require_once __ROOT__.'/includes/Session.php';
require_once __ROOT__.'/includes/school.php';
require_once __ROOT__.'/functions/functions.php';

$page = 'signup';
$debug=0;

if (isset($_POST['name'])) {
    /**
     * TODO:provide appropriate error message on duplicate entry
     * TODO:check for password match before validation
     */
    if ($_POST['password']===$_POST['password2']){
        #password match
        #print_prep($_POST);
        $schl = School::instantiate($_POST);
        $valid=$schl->validateData();


        print_prep($_POST);
        #unset($_POST);

        if ($valid){
        #data validated
        if (/*$schl->add_new()*/1) {
            $_SESSION['message'] = "Sign up succesfull, now login..";
            die();
            redirect('index.php');
            die();
        } else {
            #$_SESSION['message']=
            $message = "No connection to database";
        }
        }else{
            #invalid data
            die("Invalid data");
        }


    }else{
        #passwords do not match

        $_SESSION['message'] = "Your Passwords did not match";
        //redirect('signup.php');
        //die();
    }
    #print_prep($_SESSION);


}

?>


<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>School Bursar</title>

    <?php  $bsrc='lib/js/';  include 'setup/js.php';?>
    <?php  $bhref='lib/';    include 'setup/css.php';?>


</head>

<body>

<?php
$state = '<a href="index.php">Sign In</a>';

include __ROOT__.'/template/header_index.php';
?>
<br>
<main>
	<div class="container">
		<div class="row">

		<?php if (isset($_SESSION['message'])){?>

		<div class="col l12 s12"> <?php echo "".$_SESSION['message']. "";   ?>   </div>

		<?php } ?>



			<div class="row ">
				<form class="signup-sch-form" method="post" onsubmit="return validate(this)" action="signup.php">

						<div class="col s12">

							<div class="input-field col s12 l10">
								<input class="" type="text" id="sch_name" value="<?php echo(isset($_POST['name']))?$_POST['name']:'' ; ?>"
									 name="name"><label for="sch_name">Full School Name</label>
							</div>
							<div class="input-field col s12 l5">
								<label for="name">School Username</label> <input value="<?php echo(isset($_POST['username']))?$_POST['username']:'' ;?>"
									class="" id="name" name="username" type="text" >
							</div>
							<div class="input-field col s12 l5">
								<label for="username">Your name</label> <input value="<?php echo(isset($_POST['admin']))?$_POST['admin']:'' ;?>"
									class="" type="text" id="username"
									 name="admin" >
							</div>
							<div class="input-field col s12 l10">
								<label for="email">School Email</label>
								<input class="validate" id="email" name="email" type="email" value="<?php echo(isset($_POST['email']))?$_POST['email']:'' ;?>" >
							</div>
							<div class="input-field col s12 l5">
								<label for="password">School Password</label> <input
									class="validate" id="password" name="password"	type="password" >
							</div>
							<div class="input-field col s12 l5">
								<label for="rword">Retype Password</label> <input
									class="" id="rword" name="password2" type="password" >
							</div>
							<div class="col s12 l10 ">


								<button id="" class="btn waves-effect waves-light right"
									type="submit" name="submit">
									Sign up<i class="material-icons right">send</i>
								</button>
							</div>
						</div>

				</form>
			</div>

		</div>
	</div>
	</main>

<?php include __ROOT__.'/template/footer.php';?>
</body>

</html>