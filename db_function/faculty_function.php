<?php

function fetchFacultyData(){
	$link = createConnection();
	$query = "SELECT * FROM faculty";
	$result = $link->query($query);
	closeConnection($link);
	return $result;
}

function fetchFaculty($id){
	$link = createConnection();
	$query = "SELECT * FROM faculty WHERE id = ?";
	$stmt = $link->prepare($query);
	$stmt->bindParam(1, $id);
	$stmt->execute();
	$result = $stmt->fetch();
	closeConnection($link);
	return $result;
}

function addFaculty($name,$establish){
	$link = createConnection();
	$query = "INSERT INTO faculty(name,establish) VALUES(?,?)";
	$stmt = $link->prepare($query);
	$stmt->bindParam(1, $name);
	$stmt->bindParam(2, $establish);
	$link->beginTransaction();
	if ($stmt->execute()) {
		$link->commit();
		$result = 1;
	} else {
		$link->rollBack();
	}
	closeConnection($link);
	return $result;
}

function deleteFaculty($id){
	$link = createConnection();
	$query = "DELETE FROM faculty WHERE id = ?";
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

function updateFaculty($id,$name,$establish){
	$link = createConnection();
	$query = "UPDATE faculty SET name = ?, establish = ? WHERE id = ?";
	$stmt = $link->prepare($query);
	$stmt->bindParam(1, $name);
	$stmt->bindParam(2, $establish);
	$stmt->bindParam(3, $id);
	$link->beginTransaction();
	if ($stmt->execute()) {
		$link->commit();
	} else {
		$link->rollBack();
	}
	closeConnection($link);
}