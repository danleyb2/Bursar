<?php
?>

<nav>
	<!--HEADER-->
	<ul id="dropdown1" class="dropdown-content">
		<li><a href="#!">Profile</a></li>
		<li><a href="#!">Settings</a></li>
		<li class="divider"></li>
		<li><a href="#!">Logout</a></li>
	</ul>
	<div class="nav-wrapper">
		<a href="#" class="brand-logo"><?php echo $_SESSION['school']['name'];?></a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li active><a href="#">Home</a></li>
			<li><a href="students.php">Students</a></li>
			<li><a href="#">School</a></li>
			<li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $_SESSION['school']['admin']?><i
					class="material-icons right">arrow_drop_down</i></a></li>
		</ul>
	</div>
</nav>
<!--END HEADER-->