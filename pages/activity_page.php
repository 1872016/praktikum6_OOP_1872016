<?php
	$activityDao = new ActivityDaoImpl();

	$command = filter_input(INPUT_GET, 'cmd');
	if(isset($command) && $command == 'del'){
		$aid = filter_input(INPUT_GET, 'aid');
		if (isset($aid)) {
			$delFetch = fetchActivity($aid);
			if ($delFetch['doc_photo'] != null) {
				unlink('uploads/'.$delFetch['doc_photo']);
			}
			deleteActivity($aid);
			echo '<div class="bg-success">Data successfully deleted</div>';
		} 
	}

	$submitPressed = filter_input(INPUT_POST, "btnSubmit");
	if (isset($submitPressed)) {
		$title = filter_input(INPUT_POST, 'txtTitle');
		$description = filter_input(INPUT_POST, 'txtDescription');
		$place = filter_input(INPUT_POST, 'txtPlace');
		$start_date = filter_input(INPUT_POST, 'txtStartDate');
		$end_date = filter_input(INPUT_POST, 'txtEndDate');
		$faculty_id = filter_input(INPUT_POST, 'txtFacultyId');
		$activity = new Activity();
		$activity->setTitle($title);
		$activity->setDescription($description);
		$activity->setPlace($place);
		$activity->setStartDate($start_date);
		$activity->setEndDate($end_date);
		$activity->setFacultyId($faculty_id);
		$result = $activityDao->addActivity($activity);
		if (isset($_FILES['fileDocPhoto']['name'])) {
			$targetDir = 'uploads/';
			$fileExt = pathinfo($_FILES['fileDocPhoto']['name'], PATHINFO_EXTENSION);
			$newName = $result.'.'.$fileExt;
			$targetPath = $targetDir.$newName;
			$activityDao->addPhoto($result, $newName);
			move_uploaded_file($_FILES['fileDocPhoto']['tmp_name'], $targetPath);
		}
		$result = 1;
		if ($result) {
			echo '<div class="bg-success">Data successfully added (Activity: '. $activity->getTitle() .')</div>';
		} else {
			echo '<div class="bg-error">Error add data</div>';
		}
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="txtTitle">Title</label>
		<input type="text" class="form-control" name="txtTitle">
		<label for="txtDescription">Description</label>
		<input type="text" class="form-control" name="txtDescription">
		<label for="txtPlace">Place</label>
		<input type="text" class="form-control" name="txtPlace">
		<label for="txtStartDate">Start Date</label>
		<input type="text" class="form-control" name="txtStartDate">
		<label for="txtEndDate">End Date</label>
		<input type="text" class="form-control" name="txtEndDate">
		<label for="fileDocPhoto">Doc Photo</label>
		<input type="file" class="form-control" name="fileDocPhoto">
		<label for="txtFacultyId">Faculty Id</label>
		<input type="text" class="form-control" name="txtFacultyId">
	</div>
	<input type="submit" name="btnSubmit" class="btn btn-primary">
</form>
<br>	
<table id="myTable" class="display">
	<thead>
		<tr>
			<th>Id</th>
			<th>Title</th>
			<th>Description</th>
			<th>Place</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Doc Photo</th>
			<th>Faculty Id</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$activities = $activityDao->fetchActivityData();
			foreach ($activities as $activity) {
				echo "<tr>";
				echo "<td>".$activity->getId()."</td>";
				echo "<td>".$activity->getTitle()."</td>";
				echo "<td>".$activity->getDescription()."</td>";
				echo "<td>".$activity->getPlace()."</td>";
				echo "<td>".$activity->getStartDate()."</td>";
				echo "<td>".$activity->getEndDate()."</td>";
				if ($activity->getDocPhoto() != null) {
					echo '<td>.<img alt="photo" src='.'"uploads/'.$activity->getDocPhoto().'"'.'></td>';
				}
				echo "<td>".$activity->getFacultyId()."</td>";
				echo '<td><button class="btn btn-info" onclick="updateActivityValue(\''.$activity->getId().'\')">Update</button><button class="btn btn-danger" onclick="deleteActivityValue(\''.$activity->getId().'\')">Delete</button></td>';
				echo "</tr>";
			}
		?>
	</tbody>
</table>