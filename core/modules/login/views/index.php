<div class="row">
	<?php 
		if ($this->errorMessage){
			echo "<div class='alert alert-danger'>".$this->errorMessage."</div>";
		}
		?>
	<div class="col-sm-12">
		<div class="page-header">
			<h1><?=$this->title?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">

		<form action="<?=URL?>login/run" method="post"> Username:
			<br />
			<input type="text" name="username" value="" />
			<br />
			<br /> Password:
			<br />
			<input type="password" name="password" value="" />
			<br />
			<br />
			<input type="submit" value="Login" />
		</form>
	</div>

</div>
