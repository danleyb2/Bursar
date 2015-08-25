<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once __ROOT__.'/config/config.php';
require_once __ROOT__.'/includes/Session.php';
require_once __ROOT__.'/includes/school.php';
require_once __ROOT__.'/functions/functions.php';

$page = 'signup';

if (isset($_POST['name'])) {
    /**
     * TODO:provide appropriate error message on duplicate entry
     */

    #print_prep($_POST);
    $schl = School::instantiate($_POST);
    unset($_POST);

    if ($schl->add_new()) {
        $_SESSION['message'] = "Sign up succesfull, now login..";
        redirect('index.php');
    } else {
        #$_SESSION['message']=
        $message = "No connection to database";
    }

}

?>


<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>School Bursar</title>

    <?php  $bsrc='lib/js/';  include 'setup/js.php';?>
    <?php  $bhref='lib/';    require 'setup/css.php';?>

    <style type="text/css">

  body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
  }

  main {
    flex: 1 0 auto;
  }


    </style>

</head>

<body>

<?php
$state = '<a href="index.php">Sign In</a>';

include 'template/header_index.php';
?>
<br>

	<div class="container">
		<div class="row">
		<p><?php if (isset($_SESSION['message'])){ echo "".$_SESSION['message']. ""; } ?>     </p>
			<div class="row ">
				<form class="pure-form " method="post" action="signup.php">
					<fieldset>
						<div class="col s12">

							<div class="input-field col s10">
								<input class="pure-u-23-24" type="text" id="sch_name"
									 name="name"><label for="sch_name">Full School Name</label>
							</div>
							<div class="input-field col s5">
								<label for="name">School Username</label> <input
									class="pure-u-23-24" id="name" name="username" type="text">
							</div>
							<div class="input-field col s5">
								<label for="username">Your name</label> <input
									class="pure-u-23-24" type="text" id="username"
									 name="admin">
							</div>
							<div class="input-field col s10">
								<label for="email">School Email</label>
								<input class="validate" id="email" name="email" type="email" >
							</div>
							<div class="input-field col s5">
								<label for="password">School Password</label> <input
									class="validate" id="password" name="password"	type="password">
							</div>
							<div class="input-field col s5">
								<label for="rword">Retype Password</label> <input
									class="pure-u-23-24" id="rword" name="password2" type="password">
							</div>
							<div class="col s10 ">


								<button id="" class="btn waves-effect waves-light right"
									type="submit" name="submit">
									Sign up<i class="material-icons right">send</i>
								</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>

		</div>
	</div>

<?php include 'template/footer.php';?>
</body>

</html>