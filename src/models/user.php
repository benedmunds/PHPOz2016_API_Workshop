<?php

class UserModel
{

	var $db;

	function __construct($db)
	{
		$this->db = $db;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("SELECT * FROM users");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getById($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function create($data)
	{
		$stmt = $this->db->prepare("INSERT INTO users (username, first_name, last_name, email) VALUES (:username, :first_name, :last_name, :email)");
		$stmt->bindParam(':username', $data['username']);
		$stmt->bindParam(':first_name', $data['first_name']);
		$stmt->bindParam(':last_name', $data['last_name']);
		$stmt->bindParam(':email', $data['email']);
		$stmt->execute();


		return $this->db->lastInsertId();
	}

	public function update($id, $data)
	{
		$fragments = [];
		$params = [];

		foreach ($data as $col => $val) {
		  $fragments[] = "{$col}=:".$col;
		  $params[$col]    = $val;
		}

		$sql = sprintf("UPDATE users SET %s WHERE id=:id", implode(", ", $fragments));
		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':id', $id);


		foreach ($data as $c => $v) {
		  $stmt->bindParam(':'.$c, $v);
		}

			error_log($stmt->queryString);

		return $stmt->execute();
	}

	public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
		$stmt->bindParam(':id', $id);

		return $stmt->execute();
	}

}