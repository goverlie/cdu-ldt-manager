<div class="row">
	<div class="col-sm-12">
		<div class="page-header">
			<h1><?=$this->title?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<form method="post" action='<?php echo URL; ?>user/editSave/<?php echo $this->user["id"]; ?>'>
			<label>Username</label>
			<input style="border: none;" type="text" name="username" value="<?=$this->user['username']?>" />
			<br>
			<label>Password</label>
			<input type="text" name="password" />
			<br>
			<label>First Name</label>
			<input type="text" name="firstname" value="<?=$this->user['firstname']?>" />
			<br>
			<label>Last Name</label>
			<input type="text" name="lastname" value="<?=$this->user['lastname']?>" />
			<br>
			<label>Role</label>
			<select id="permission_level" name="permission_level">
				<option value="0" <?php echo ($this->user['permission_level']==0 ? 'selected' : null); ?>>Admin</option>
				<option value="1" <?php echo ($this->user['permission_level']==1 ? 'selected' : null); ?>>Reviewer</option>
				<option value="2" <?php echo ($this->user['permission_level']==2 ? 'selected' : null); ?>>State Manager</option>
				<option value="3" <?php echo ($this->user['permission_level']==3 ? 'selected' : null); ?>>Campus Manager</option>
			</select>
			<br>
			<label>&nbsp;</label>
			<input type="submit" />
		</form>
	</div>
</div>
