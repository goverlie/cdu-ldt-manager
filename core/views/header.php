<?php
use \core\libs as core;

	// Get requested theme and set the session variable
	if (isset($_REQUEST['theme'])) {
		$request = $_REQUEST['theme'];
		core\Session::set('theme_id',$request);
		$this->theme->saveCurrentTheme();
	}
?>
	<!doctype html>
	<html>

	<head>
		<title>
			<?=(isset($this->title)) ? APP_TITLE . ': '.$this->title : APP_TITLE ?>
		</title>
		
		<link type="text/css" rel="stylesheet" href="<?=URL;?>core/public/css/jquery-ui.css" />
		<link type="text/css" rel="stylesheet" href="<?=URL;?>core/public/css/jquery-ui.ie.css" />


		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
		<!--Load Custom Theme -->
		<?php
		// Based on session style apply the stylesheet
		if ($this->theme->isThemeSet()) {
			$theme = core\Session::get('theme_id') ?? 1; //PHP 7
			$theme = $this->theme->getTheme($theme);
			echo $theme[0]['link'];
		}
		?>
		<!--End Custom Theme -->
<!-- Test Loads -->
			<link type="text/css" rel="stylesheet" href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" />
		<link type="text/css" rel="stylesheet" href="<?=URL;?>core/public/css/default.css" />
		

		<script src="<?=URL;?>core/public/js/jquery.js"></script>
		<script src="<?=URL;?>core/public/js/jquery-ui.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


		<script src="<?=URL;?>core/public/js/custom.js"></script>
		<?php
		if (isset($this->js)) {
			foreach ($this->js as $js){
				echo '<script src="'.URL . $js.'"></script>';
			}
		}
	?>
			


	</head>

	<body>


		<div id="wrap">
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?=URL?>">
							<?=APP_TITLE?>
						</a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<?php if (!core\Session::get('loggedIn')) { ?>
								<li><a href="<?=URL?>index">Home</a></li>
								<?php } ?>
									<!-- Begin Logged In Menu -->
									<?php if (core\Session::get('loggedIn')) {
										
					
//										foreach ($this->navigation->coreModules as $coreModule) {
//											echo '<li><a href="'. URL . $coreModule['module_name'] . '">' . $coreModule['module_name'];
//											echo '</a>';
//										}
	
										?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									<?php
										$style = core\Session::get('theme_id');
										if (isset($style)) {
											echo "<sup>" . $this->theme->getThemeName() . "</sup><sub style='margin-left:-20px; bottom: -0.65em;	'>Theme</sub>";
										} else {
											echo "Theme";
										}
									?>
									<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<?php
					$themes = $this->theme->getAllThemes();
					
					foreach ($themes as $theme) {
						echo '<li><a href="?theme=' . $theme['theme_id'] . '">' . $theme['common_name'];
							if(core\Session::get('theme_id') == $theme['theme_id'])
								echo '&nbsp;<span class="glyphicon glyphicon-ok"></span>';
						echo '</a>';
					}
				?>
								</ul>
							</li>
							<li><a href="<?=URL?>dashboard/logout">Logout</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="<?=URL?>user">Users</a></li>
							<li><a href="<?=URL?>production_report">Prod. Report</a></li>
							
						</ul>
						<!-- End Logged In Menu -->
						<?php } else {  ?>
							<li class="divider"></li>
							<li><a href="<?=URL?>login">Login</a></li>
							<?php } ?>
								</ul>
								<!-- this is for search
		<form class="navbar-form navbar-left" role="search">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Search">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
		</form>		</ul>-->

					</div>
				</div>
			</nav>

			<!-- Begin page content -->
			<div class="container-fluid">
			<!--	<pre><?=print_r($_SESSION,1);?></pre>
				<pre><?=print_r($this->navigation->menuItems,1); ?></pre>-->
