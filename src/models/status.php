<?php

class StatusModel
{

	var $db;

	function __construct($db)
	{
		$this->db = $db;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("SELECT * FROM statuses");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getById($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM statuses WHERE id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getByUserId($userId)
	{
		$stmt = $this->db->prepare("SELECT * FROM statuses WHERE user_id = :user_id");
		$stmt->bindParam(':user_id', $userId);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function create($data)
	{
		$stmt = $this->db->prepare("INSERT INTO statuses (user_id, status) VALUES (:user_id, :status)");
		$stmt->bindParam(':user_id', $data['user_id']);
		$stmt->bindParam(':status', $data['status']);
		$stmt->execute();


		return $this->db->lastInsertId();
	}

	public function update($id, $data)
	{
		$fragments = [];
		$params = [];

		foreach ($data as $col => $val) {
		  $fragments[] = "{$col} = :".$col;
		  $params[$col]    = $val;
		}

		$sql = sprintf("UPDATE statuses SET %s WHERE id = :id", implode(", ", $fragments));
		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':id', $id);

		$paramCount = 1;
		error_log(json_encode($params));
		foreach ($params as $col => $param) {
			$stmt->bindParam(':'.$col, $param);
			error_log($col);
			error_log($param);
			$paramCount++;
		}

		return $stmt->execute();
	}

	public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM statuses WHERE id = :id");
		$stmt->bindParam(':id', $id);

		return $stmt->execute();
	}

}