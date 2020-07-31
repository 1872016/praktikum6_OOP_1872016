<?php

/**
 * 
 */
class FacultyDaoImpl
{
	
	public function fetchFacultyData(){
		$link = PDOUtil::createConnection();
		$query = "SELECT * FROM faculty";
		$result = $link->query($query);
		$result->setFetchMode( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Faculty');
		PDOUtil::closeConnection($link);
		return $result;
	}

	public function fetchFaculty($id){
		$link = PDOUtil::createConnection();
		$query = "SELECT * FROM faculty WHERE id = ?";
		$stmt = $link->prepare($query);
		$stmt->bindParam(1, $id);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		PDOUtil::closeConnection($link);
		return $stmt->fetchObject('Faculty');
	}

	public function addFaculty(Faculty $faculty){
		$link = PDOUtil::createConnection();
		$query = "INSERT INTO faculty(name,establish) VALUES(?,?)";
		$stmt = $link->prepare($query);
		$stmt->bindValue(1, $faculty->getName());
		$stmt->bindValue(2, $faculty->getEstablish());
		$link->beginTransaction();
		if ($stmt->execute()) {
			$link->commit();
			$result = 1;
		} else {
			$link->rollBack();
		}
		PDOUtil::closeConnection($link);
		return $result;
	}

	public function deleteFaculty($id){
		$link = PDOUtil::createConnection();
		$query = "DELETE FROM faculty WHERE id = ?";
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

	public function updateFaculty(Faculty $faculty){
		$link = PDOUtil::createConnection();
		$query = "UPDATE faculty SET name = ?, establish = ? WHERE id = ?";
		$stmt = $link->prepare($query);
		$stmt->bindValue(1, $faculty->getName());
		$stmt->bindValue(2, $faculty->getEstablish());
		$stmt->bindValue(3, $faculty->getId());
		$link->beginTransaction();
		if ($stmt->execute()) {
			$link->commit();
		} else {
			$link->rollBack();
		}
		PDOUtil::closeConnection($link);
	}

}