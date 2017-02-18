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
			<form method="post" action='<?=URL;?>production_report/createUnitStatus'>
				<table>
					<tr>
						<td><label for="status_date">Date</label></td>
						<td><input type="text" name="status_date" id="status_date" value="<?=date("Y-m-d")?>" /></td>
					</tr>
					<tr>
						<td><label for="faculty_id">Faculty</label></td>
						<td>
							<select id="faculty_id" name="faculty_id">
							<?php
								// Table Data
								foreach ($this->facultyList as $faculty) {
									echo "<option value=".$faculty['id'].">".$faculty['shortname']."</option>";
								}
							?>
							</select>				
						</td>
					</tr>
					<tr>
						<td><label for="status_id">Status</label></td>
						<td>
							<select id="status_id" name="status_id">
							<?php
								// Table Data
								foreach ($this->statusList as $status) {
									echo "<option value=".$status['id']." title=".$status['description'].">".$status['status']."</option>";
								}
							?>
							</select>	
						</td>
					</tr>
					<tr>
						<td><label for="no_units">No Units</label></td>
						<td><input type="text" name="no_units" id="no_units" /></td>
					</tr>
					<tr>
						<td><label for="percent">Percent</label></td>
						<td><input type="text" name="percent" id="percent" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-success pull-right" type="submit" value="Insert"/></td>
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
					<th>Date</th>
					<th>Faculty</th>
					<th>Status</th>
					<th>No Units</th>
					<th>Percentage</th>

				</tr>
				</thead>
				<tbody>
				<?php

				// Table Data
				foreach ($this->unitStatusList as $key => $value) {
					echo "<tr>";
					foreach ($value as $index => $data) {
						if ($index != 'faculty_id' || $index != 'status_id'){
						echo "<td>$data</td>";
						}
					}

					$actionEdit = URL . 'production_report/edit/' . $value['status_date'].'/'.$value['faculty_id'].'/'.$value['status'];
					$actionDelete = URL . 'production_report/deleteUnitStatus/' . $value['status_date'].'/'.$value['faculty_id'].'/'.$value['status'];
					echo '<td>';
						echo '<div class="btn-group" role="group" aria-label="User Action Buttons">
						<a data-status-date='.$value['status_date'].' data-faculty-id='.$value['faculty_id'].' data-status-id='.$value['status_id'].' href='.$actionEdit.'  class="btn btn-default btn-sm user-edit"><span class="glyphicon glyphicon-pencil"></span></a> <button data-status-date='.$value['status_date'].' data-faculty-id='.$value['faculty_id'].' data-status-id='.$value['status_id'].' data-action='.$actionDelete.' type="button" class="btn btn-default btn-sm unit-status-delete"><span class="glyphicon glyphicon-trash"></span></button></div>';
					echo '</td>';
					echo '</tr>';
				}
				
?>
				</tbody>
			</table>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			// Do jQuery Things
			$(".unit-status-delete").click(function(e) {
				var actionUrl = $(this).data('action');

				$("form#confirmAction").attr("action", actionUrl);
				$("#myModal").modal();
			});
		});
	</script>
