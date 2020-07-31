<?php
	$facultyDao = new FacultyDaoImpl();

	$fid = filter_input(INPUT_GET, 'fid');
	if (isset($fid)) {
		$faculty = $facultyDao->fetchFaculty($fid);
	}

	$submitPressed = filter_input(INPUT_POST, "btnSubmit");
	if (isset($submitPressed)) {
		$id = $faculty->getId();
		$name = filter_input(INPUT_POST, 'txtName');
		$establish = filter_input(INPUT_POST, 'txtEstablish');
		$upFac = new Faculty();
		$upFac->setId($id);
		$upFac->setName($name);
		$upFac->setEstablish($establish);
		$facultyDao->updateFaculty($upFac);
		header("location:index.php?menu=fac");
	}
?>

<form action="" method="post">
	<div class="form-group">
		<label for="txtId">Id</label>
		<input type="text" class="form-control" name="txtId" value=<?php echo '"'.$faculty->getId().'"'; ?> readonly>
		<label for="txtName">Name</label>
		<input type="text" class="form-control" name="txtName" value=<?php echo '"'.$faculty->getName().'"'; ?>>
		<label for="txtEstablish">Establish</label>
		<input type="text" class="form-control" name="txtEstablish" value=<?php echo '"'.$faculty->getEstablish().'"'; ?>>
	</div>
	<input type="submit" name="btnSubmit" class="btn btn-default">
</form>