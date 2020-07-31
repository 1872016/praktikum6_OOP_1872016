<?php

/**
 * 
 */
class ActivityDaoImpl
{
	
	public function fetchActivityData(){
		$link = PDOUtil::createConnection();
		$query = "SELECT * FROM activity";
		$result = $link->query($query);
		$result->setFetchMode( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Activity');
		PDOUtil::closeConnection($link);
		return $result;
	}

	public function fetchActivity($id){
		$link = PDOUtil::createConnection();
		$query = "SELECT * FROM activity WHERE id = ?";
		$stmt = $link->prepare($query);
		$stmt->bindParam(1, $id);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		PDOUtil::closeConnection($link);
		return $stmt->fetchObject('Activity');
	}

	public function addActivity(Activity $activity){
		$link = PDOUtil::createConnection();
		$query = "INSERT INTO activity(title,description,place,start_date,end_date,faculty_id) VALUES(?,?,?,?,?,?)";
		$stmt = $link->prepare($query);
		$stmt->bindValue(1, $activity->getTitle());
		$stmt->bindValue(2, $activity->getDescription());
		$stmt->bindValue(3, $activity->getPlace());
		$stmt->bindValue(4, $activity->getStartDate());
		$stmt->bindValue(5, $activity->getEndDate());
		$stmt->bindValue(6, $activity->getFacultyId());
		$link->beginTransaction();
		if ($stmt->execute()) {
			$last_id = $link->LastInsertId();
			$link->commit();
		} else {
			$link->rollBack();
		}
		PDOUtil::closeConnection($link);
		return $last_id;
	}

	public function deleteActivity($id){
		$link = PDOUtil::createConnection();
		$query = "DELETE FROM activity WHERE id = ?";
		$stmt = $link->prepare($query);
		$stmt->bindParam(1, $id);
		$link->beginTransaction();
		if ($stmt->execute()) {
			$link->commit();
		} else {
			$link->rollBack();
		}
		PDOUtil::closeConnection($link);
	}

	public function updateActivity(Activity $activity){
		$link = PDOUtil::createConnection();
		$query = "UPDATE activity SET title=?,description=?,place=?,start_date=?,end_date=?,faculty_id=? WHERE id = ?";
		$stmt = $link->prepare($query);
		$stmt->bindValue(1, $activity->getTitle());
		$stmt->bindValue(2, $activity->getDescription());
		$stmt->bindValue(3, $activity->getPlace());
		$stmt->bindValue(4, $activity->getStartDate());
		$stmt->bindValue(5, $activity->getEndDate());
		$stmt->bindValue(6, $activity->getFacultyId());
		$stmt->bindValue(7, $activity->getId());
		$link->beginTransaction();
		if ($stmt->execute()) {
			$link->commit();
		} else {
			$link->rollBack();
		}
		PDOUtil::closeConnection($link);
	}

	public function addPhoto($id, $doc_photo){
		$link = PDOUtil::createConnection();
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
		PDOUtil::closeConnection($link);
	}
}