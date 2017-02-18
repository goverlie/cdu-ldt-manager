<?php include 'core/util/Modal.php'; ?>

	<div class="row">
		
		<?php 
		if ($this->errorMessage){
			echo "<div class='alert alert-danger'>".$this->errorMessage."</div>";
		}
		?>
		<div class="col-sm-5 side-bar">
			<div class="page-header">
				<h1><?=$this->title?></h1>
			</div>
			
			<form method="post" action='<?=URL;?>user/create'>
				<table>
					<tr>
						<td><label for="username">Username</label></td>
						<td><input type="text" name="username" id="username" /></td>
					</tr>
					<tr>
						<td><label for="password">Password</label></td>
						<td><input type="text" name="password" id="password" /></td>
					</tr>
					<tr>
						<td><label for="firstname">Firstname</label></td>
						<td><input type="text" name="firstname" id="firstname" /></td>
					</tr>
					<tr>
						<td><label for="lastname">Lastname</label></td>
						<td><input type="text" name="lastname" id="lastname" /></td>
					</tr>
					<tr>
						<td><label for="email">Email</label></td>
						<td><input type="text" name="email" id="email" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-success pull-right" type="submit" value="Add User"/></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="col-sm-7 main-content">
			<div class="page-header">
				<h1>Accounts</h1>
			</div>
			<table>
				<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Username</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Email</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php

	// Table Data
	foreach ($this->userList as $key => $value) {
		echo "<tr>";
		
		foreach ($value as $index => $data) {
			if ($index != 'id')
			echo "<td>$data</td>";
		}
		//<a class="delete-user" href="'.URL.'user/delete/'.$value['id'].'">Delete</a>
		//<button type="button" class="btn btn-default btn-sm delete-user">Delete</button>
		//if($value['permission_level'] >= 0) {

		$actionEdit = URL . 'user/edit/' . $value['user_id'];
		$actionDelete = URL . 'user/delete/' . $value['user_id'];
			echo '<td>';
			echo '<div class="btn-group" role="group" aria-label="User Action Buttons">
			<a data-user-id='.$value['user_id'].' href='.$actionEdit.'  class="btn btn-default btn-sm user-edit"><span class="glyphicon glyphicon-pencil"></span></a> <button data-user-id='.$value['user_id'].' data-action='.$actionDelete.' type="button" class="btn btn-default btn-sm user-delete"><span class="glyphicon glyphicon-trash"></span></button></div>';
			echo '</td>';
		//}
			

		echo '</tr>';
	}
?>
				</tbody>
			</table>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$(".user-delete").click(function(e) {
				var actionUrl = $(this).data('action');

				$("form#confirmAction").attr("action", actionUrl);
				$("#myModal").modal();
			});
		});
	</script>
