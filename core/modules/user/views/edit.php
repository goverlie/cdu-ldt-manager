<div class="row">
	<div class="col-sm-12">
		<div class="page-header">
			<h1><?=$this->title?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">




		<form method="post" action='<?php echo URL; ?>user/editSave/<?php echo $this->user['user_id']; ?>'>
			<table>
				<tr>
					<td>
						<label for="username">Username</label>
					</td>
					<td>
						<input type="text" name="username" id="username" value="<?=$this->user['username']?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="password">Password</label>
					</td>
					<td>
						<input type="text" name="password" id="password" />
					</td>
				</tr>
				<!--<tr>
					<td>
						<label for="role">Role</label>
					</td>
					<td>
						<select id="role" name="permission_level">
							<option value="0" <?php echo ($this->user['permission_level']==0 ? 'selected' : null); ?>>Admin</option>
							<option value="1" <?php echo ($this->user['permission_level']==1 ? 'selected' : null); ?>>Reviewer</option>
							<option value="2" <?php echo ($this->user['permission_level']==2 ? 'selected' : null); ?>>State Manager</option>
							<option value="3" <?php echo ($this->user['permission_level']==3 ? 'selected' : null); ?>>Campus Manager</option>
						</select>
					</td>
				</tr>-->
				<tr>
					<td>
						<label for="firstname">Firstname</label>
					</td>
					<td>
						<input type="text" name="firstname" id="firstname" value="<?=$this->user['firstname']?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="lastname">Lastname</label>
					</td>
					<td>
						<input type="text" name="lastname" id="lastname" value="<?=$this->user['lastname']?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="email">Email</label>
					</td>
					<td>
						<input type="text" name="email" id="email" value="<?=$this->user['email']?>" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input class="btn btn-success pull-right" type="submit" value="Save User" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
