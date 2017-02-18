<?php

require '../libs/Form.php';

if (isset($_REQUEST['run'])) {
	try {
		$form = new Form();

		$form
			->post('name')
			->val('minlength', 1)
			->post('age')
			->val('digit')
			->post('gender');
	
		$form->submit();
		
		echo 'The form passed!';
		
		$data = $form->fetch();
		
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	
	


} ?>

<form method="post" action="?run">
	<label>Name: <input type="text" name="name" /></label>
	<label>Age: <input type="text" name="age" /></label>
	<label>Gender: <select name="gender">
			<option value="m">Male</option>
			<option value="f">Female</option>
		</select></label>
	<label><input type="submit" /></label>
</form>
