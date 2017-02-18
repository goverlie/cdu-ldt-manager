<div class="row">
	<div class="page-header">
		<h1><?=$this->title?></h1>
	</div>
</div>
<div class="row">
	<form method="post" action='<?php echo URL; ?>note/create'>
		<label>Title</label>
		<input style="border: none;" type="text" name="title" />
		<br>
		<label>Content</label>
		<textarea name="content"></textarea>
		<br>
		<label>&nbsp;</label>
		<input type="submit" />
	</form>


<hr>
<?php if (!empty($this->noteList)): ?>
	<?php
	echo "<table>";
	// Table Headers
	$headers = array_keys(reset($this->noteList));
	echo '<tr>';
	foreach ($headers as $header) {
		echo '<th>' . $header . '</th>';
	}
	echo '</tr>';
	// Table Data
	foreach ($this->noteList as $key => $value) {
		echo "<tr>";
		foreach ($value as $data) {
			echo "<td>$data</td>";
		}
		echo '<td><a href="'.URL.'note/edit/'.$value['note_id'].'">Edit</a> <a class="delete-note" href="'.URL.'note/delete/'.$value['note_id'].'">Delete</a></td>';
		echo '</tr>';
	}
	echo "</table>";
	endif;
?>
</div>
<script>
	$(document.body).on( "click",".delete-note", function(e) {
		var c = confirm("Are you sure you want to delete?");
		if (c === false) return false;
	});
</script>
