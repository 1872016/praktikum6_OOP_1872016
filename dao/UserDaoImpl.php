<?php

/**
 * 
 */
class UserDaoImpl
{
	public function login($username,$password){
		$link = PDOUtil::createConnection();
		$query = 'SELECT * FROM user WHERE username = ? AND password = ?';
		$stmt = $link->prepare($query);
		$stmt->bindParam(1, $username);
		$stmt->bindParam(2, $password);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		PDOUtil::closeConnection($link);
		return $stmt->fetchObject('User');
	}
}