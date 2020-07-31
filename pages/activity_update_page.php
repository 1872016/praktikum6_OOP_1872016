<?php
	$activityDao = new ActivityDaoImpl();

	$aid = filter_input(INPUT_GET, 'aid');
	if (isset($aid)) {
		$activity = $activityDao->fetchActivity($aid);
	}

	$submitPressed = filter_input(INPUT_POST, "btnSubmit");
	if (isset($submitPressed)) {
		$id = $activity->getId();
		$title = filter_input(INPUT_POST, 'txtTitle');
		$description = filter_input(INPUT_POST, 'txtDescription');
		$place = filter_input(INPUT_POST, 'txtPlace');
		$start_date = filter_input(INPUT_POST, 'txtStartDate');
		$end_date = filter_input(INPUT_POST, 'txtEndDate');
		$faculty_id = filter_input(INPUT_POST, 'txtFacultyId');
		$upAct = new Activity();
		$upAct->setId($id);
		$upAct->setTitle($title);
		$upAct->setDescription($description);
		$upAct->setPlace($place);
		$upAct->setStartDate($start_date);
		$upAct->setEndDate($end_date);
		$upAct->setFacultyId($faculty_id);
		$activityDao->updateActivity($upAct);
		if (isset($_FILES['fileDocPhoto']['name'])) {
			$targetDir = 'uploads/';
			$fileExt = pathinfo($_FILES['fileDocPhoto']['name'], PATHINFO_EXTENSION);
			$newName = $activity->getId().'.'.$fileExt;
			$targetPath = $targetDir.$newName;
			$activityDao->addPhoto($result, $newName);
			move_uploaded_file($_FILES['fileDocPhoto']['tmp_name'], $targetPath);
		}
		header("location:index.php?menu=act");
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="txtId">Id</label>
		<input type="text" class="form-control" name="txtId" value=<?php echo '"'.$activity->getId().'"'; ?> readonly>
		<label for="txtTitle">Title</label>
		<input type="text" class="form-control" name="txtTitle" value=<?php echo '"'.$activity->getTitle().'"'; ?>>
		<label for="txtDescription">Description</label>
		<input type="text" class="form-control" name="txtDescription" value=<?php echo '"'.$activity->getDescription().'"'; ?>>
		<label for="txtPlace">Place</label>
		<input type="text" class="form-control" name="txtPlace" value=<?php echo '"'.$activity->getPlace().'"'; ?>>
		<label for="txtStartDate">Start Date</label>
		<input type="text" class="form-control" name="txtStartDate" value=<?php echo '"'.$activity->getStartDate().'"'; ?>>
		<label for="txtEndDate">End Date</label>
		<input type="text" class="form-control" name="txtEndDate" value=<?php echo '"'.$activity->getEndDate().'"'; ?>>
		<label for="fileDocPhoto">Doc Photo</label>
		<input type="file" class="form-control" name="fileDocPhoto">
		<label for="txtFacultyId">Faculty Id</label>
		<input type="text" class="form-control" name="txtFacultyId" value=<?php echo '"'.$activity->getFacultyId().'"'; ?>>
	</div>
	<input type="submit" name="btnSubmit" class="btn btn-primary">
</form>