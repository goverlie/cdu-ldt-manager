<!doctype html>
<html>

<head>
	<title>
		Fortis: Dashboard </title>
	<link type="text/css" rel="stylesheet" href="http://fortis/core/public/css/jquery-ui.css" />
	<link type="text/css" rel="stylesheet" href="http://fortis/core/public/css/jquery-ui.ie.css" />


	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">

	<link type="text/css" rel="stylesheet" href="http://fortis/core/public/css/default.css" />
	<!--Load Custom Theme -->
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha256-daEYF2SGTkiPl4cmxH06AOMnZ+Hb8wBpvs7DqvceszY= sha512-xmSDqcgDrroCG8Sp/p0IArjjB3lO0m0Yde0tm1mOFD4BwmsvZnVNfHgw7icU6q4ScrTCQKCokxnYMy/hUUfGrg==" crossorigin="anonymous">
	<!--End Custom Theme -->

	<script src="http://fortis/core/public/js/jquery.js"></script>
	<script src="http://fortis/core/public/js/jquery-ui.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


	<script src="http://fortis/core/public/js/custom.js"></script>
	<script src="http://fortis/core/modules/dashboard/views/js/default.js"></script>
	<!-- Test Loads -->
	<link type="text/css" rel="stylesheet" href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" />


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
					<a class="navbar-brand" href="http://fortis/">
							Fortis						</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="http://fortis/dashboard">Dashboard</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><sup>1</sup><sub style='margin-left:-20px; bottom: -0.65em;	'>Theme</sub> <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="?theme=1">1&nbsp;<span class="glyphicon glyphicon-ok"></span></a>
									<li><a href="?theme=2">2</a>
										<li><a href="?theme=3">3</a>
											<li><a href="?theme=4">4</a>
												<li><a href="?theme=5">5</a>
													<li><a href="?theme=6">6</a>
														<li><a href="?theme=7">7</a>
															<li><a href="?theme=8">8</a>
																<li><a href="?theme=9">9</a>
																	<li><a href="?theme=10">10</a>
																		<li><a href="?theme=11">11</a>
																			<li><a href="?theme=12">12</a>
																				<li><a href="?theme=13">13</a>
																					<li><a href="?theme=14">14</a>
																						<li><a href="?theme=15">15</a>
																							<li><a href="?theme=16">16</a> </ul>
							</li>
							<li><a href="http://fortis/dashboard/logout">Logout</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="http://fortis/user">Users</a></li>
					</ul>
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
			<pre>Array
(
	[theme] => 1
	[loggedIn] => 1
	[user_id] => 19
	[modules] => [{"module_name":"bad"},{"module_name":"dashboard"},{"module_name":"index"},{"module_name":"login"},{"module_name":"note"},{"module_name":"user"}]
)
</pre>
			<pre>cerulean</pre>
			<div class="row">
				<div class="col-sm-12">

					<div class="page-header">
						<h1>Dashboard</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">

					<!-- XHR Exaample
		<form id="randomInsert" action="http://fortis/dashboard/xhrInsert" method="post">
			<input type="text" name="text" />
			<input type="submit" />
		</form>
		<br>

		<div id="listInserts">

		</div>-->
				</div>
			</div>
			<div id="push"></div>
		</div>
		<!-- close of content -->
	</div>
	<!-- close of wrap -->

	<div id="footer">
		<div class="container">
			<p>Fortis MVC Framework &copy; 2016
				<br> <span class="muted">Created by <a href="mailto:goverlie@me.com">Gary Overliese</a></span></p>
		</div>
	</div>

</body>

</html>
