<?php

function fetchActivityData(){
	$link = createConnection();
	$query = "SELECT * FROM activity";
	$result = $link->query($query);
	closeConnection($link);
	return $result;
}

function fetchActivity($id){
	$link = createConnection();
	$query = "SELECT * FROM activity WHERE id = ?";
	$stmt = $link->prepare($query);
	$stmt->bindParam(1, $id);
	$stmt->execute();
	$result = $stmt->fetch();
	closeConnection($link);
	return $result;
}

function addActivity($title,$description,$place,$start_date,$end_date,$faculty_id){
	$link = createConnection();
	$query = "INSERT INTO activity(title,description,place,start_date,end_date,faculty_id) VALUES(?,?,?,?,?,?)";
	$stmt = $link->prepare($query);
	$stmt->bindParam(1, $title);
	$stmt->bindParam(2, $description);
	$stmt->bindParam(3, $place);
	$stmt->bindParam(4, $start_date);
	$stmt->bindParam(5, $end_date);
	$stmt->bindParam(6, $faculty_id);
	$link->beginTransaction();
	if ($stmt->execute()) {
		$last_id = $link->LastInsertId();
		$link->commit();
	} else {
		$link->rollBack();
	}
	closeConnection($link);
	return $last_id;
}

function deleteActivity($id){
	$link = createConnection();
	$query = "DELETE FROM activity WHERE id = ?";
	$stmt = $link->prepare($query);
	$stmt->bindParam(1, $id);
	$link->beginTransaction();
	if ($stmt->execute()) {
		$link->commit();
	} else {
		$link->rollBack();
	}
	closeConnection($link);
}

function updateActivity($id,$title,$description,$place,$start_date,$end_date,$faculty_id){
	$link = createConnection();
	$query = "UPDATE activity SET title=?,description=?,place=?,start_date=?,end_date=?,faculty_id=? WHERE id = ?";
	$stmt = $link->prepare($query);
	$stmt->bindParam(1, $title);
	$stmt->bindParam(2, $description);
	$stmt->bindParam(3, $place);
	$stmt->bindParam(4, $start_date);
	$stmt->bindParam(5, $end_date);
	$stmt->bindParam(6, $faculty_id);
	$stmt->bindParam(7, $id);
	$link->beginTransaction();
	if ($stmt->execute()) {
		$link->commit();
	} else {
		$link->rollBack();
	}
	closeConnection($link);
}

function addPhoto($id, $doc_photo){
	$link = createConnection();
	$query = 'UPDATE activity SET doc_photo=? WHERE id=?';
	$stmt = $link->prepare($query);
	$stmt->bindParam(1, $doc_photo);
	$stmt->bindParam(2, $id);
	$link->beginTransaction();
	if ($stmt->execute()) {
		$link->commit();
	} else {
		$link->rollBack();
	}
	closeConnection($link);
}