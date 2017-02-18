<div class="row">
	<div class="page-header">
		<h1><?=$this->title?></h1>
	</div>
</div>
<div class="row">
	<form method="post" action='<?php echo URL; ?>note/editSave/<?php echo $this->note['note_id']; ?>'>
		<label>Title</label>
		<input style="border: none;" type="text" name="title" value="<?=$this->note['title']?>" />
		<br>
		<label>Content</label>
		<textarea name="content">
			<?=$this->note['content']?>
		</textarea>
		<br>
		<label>&nbsp;</label>
		<input type="submit" />
	</form>
</div>
