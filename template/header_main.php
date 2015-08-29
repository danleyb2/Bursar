
<header>


	<nav>
		<!--HEADER-->
		<div class="nav-wrapper">
			<a href="#" class="brand-logo center"><?php echo $_SESSION['school']['name'];?></a>
			<a href="#!" data-activates="mobile-nav" class="right button-collapse"><i
				class="mdi-navigation-more-vert"></i></a>


			<ul class="right hide-on-med-and-down">
				<li class="<?php echo ($page=='main')?'active':'';?>"><a href="main.php">Main</a></li>
				<li class="<?php echo ($page=='students')?'active':'';?>"><a href="students.php">Students</a></li>
				<li class="<?php echo ($page=='transactions')?'active':'';?>"><a href="transactions.php">Transactions</a></li>
				<li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $_SESSION['school']['admin']?><i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>
			<div class="left">
				<form id="search">
					<div class="input-field">
						<input type="search" id="search-field" class="field" required
							maxlength=""> <label for="search-field"><i
							class="mdi-action-search"></i></label> <i
							class="mdi-navigation-close close"></i>
					</div>
				</form>
			</div>

		</div>
	</nav>
	<!--END HEADER-->
	<ul id='dropdown1' class='dropdown-content'>
		<li><a href="#!">Profile</a></li>
		<li><a href="#!">Settings</a></li>
		<li class="divider"></li>
		<li><a href="../index.php">Logout</a></li>
	</ul>

	<ul class="side-nav" id="mobile-nav">
		<li class="<?php echo ($page=='main')?'active':'';?>"><a href="main.php">Main</a></li>
		<li class="<?php echo ($page=='students')?'active':'';?>"><a href="students.php">Students</a></li>
		<li class="<?php echo ($page=='transactions')?'active':'';?>"><a href="transactions.php">Transactions</a></li>

	</ul>

</header>