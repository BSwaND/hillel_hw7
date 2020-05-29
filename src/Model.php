<?php

namespace App;

use PDO;

/**
 * Class Model
 * @package App\Model
 */
abstract class Model
{
	abstract static function getTable(): string;

	/**
	 * @return PDO connect
	 */
	private function connect()
	{
		return new PDO('mysql:host=db;dbname=myDb', 'user', 'test');
	}

	/**
	 * @param int $id
	 * @return array
	 */
	public static function find(int $id)//: array
	{
		$pdo = static::connect();
		$sql = 'SELECT * FROM `' . static::getTable() . '` WHERE `id` = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		static::errorInfo($stmt);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * @param string $name
	 * @param string $email
	 */
	public function create(string $name, string $email)
	{
		$pdo = $this->connect();
		$sql = 'INSERT INTO `' . static::getTable() . '` SET `name` = :name, `email` = :email ';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$this->errorInfo($stmt);
	}

	/**
	 * @param int $id
	 * @param string $name
	 * @param string $email
	 */
	public function update(int $id, string $name, string $email)
	{
		$pdo = $this->connect();
		$sql = 'UPDATE `' . static::getTable() . '` SET `name` = :name, `email` = :email WHERE `id` = :id ';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$this->errorInfo($stmt);
	}

	/**
	 * @param int $id
	 */
	public function delete(int $id)
	{
		$pdo = $this->connect();
		$sql = 'DELETE FROM `' . static::getTable() . '` WHERE `id` = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$this->errorInfo($stmt);
	}

	/**
	 * @param $stmt
	 */
	public function errorInfo($stmt)
	{
		if ($stmt->errorInfo()[0] == '00000') return;

		echo '<pre>PDOStatement::errorInfo():<hr>';
		$arr = $stmt->errorInfo();
		print_r($arr);
		echo '<hr></pre>';
	}
}