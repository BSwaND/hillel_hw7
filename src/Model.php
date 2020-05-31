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
	 * @return static
	 */
	public static function find(int $id): self
	{
		$pdo = static::connect();
		$sql = 'SELECT * FROM `' . static::getTable() . '` WHERE `id` = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$result =  $stmt->fetch(PDO::FETCH_ASSOC);
		$instants = new static();
		static::errorInfo($stmt);

		foreach ($result as $key=>$val){
			$methodName = 'set'.$key;
			$instants->$methodName($val);
		}
		return $instants;
	}

	/**
	 * @param array $param
	 */
	public function create(array $param)
	{
		$instants = new static();
		$fields= null;
		$bindFields = array();

		/*
		 * Вопросы преподователю:
		 *  - нужно ли тут использовать  new static(), и использовать  методы (get & set),
		 *    что бы получать свойства? Я тут руководствовался логикой, что свойства в классе наследнике
		 *    могут валидироваться.
		 *
		 *  - Ниже по коду foreach делал для универсвльности класса Model, что бы он подхоил под
		 *    любые классы наследники с разнымы полими и разным их количеством. Но мое решение
		 *    мне кажется не лаконичным и сложным.
		 *    Так ли это, можно где-то посмотреть решение данной задачи, я не нашол.
		 *
		 *
		 */

		foreach ($param as $key=>$val){
			$setMethodName = 'set'.ucfirst($key);
			$instants->$setMethodName($val);

			$fields .= '`'.$key.'` = :'.$key.' ,'; // `name` = :name, `email` = :email '
			$getMethodName= 'get'.ucfirst($key);
			$bindFields[$key] = $instants->$getMethodName();
		}
		$fields = substr($fields,0,-1);

		$pdo = $this->connect();
		$sql = 'INSERT INTO `' . static::getTable() . '` SET '. $fields;
		$stmt = $pdo->prepare($sql);
		$stmt->execute($bindFields);
		$this->errorInfo($stmt);
	}

	/**
	 * @param array $param
	 */
	public function update(array $param)
	{
		$instants = new static();
		$fields= null;
		$bindFields = array();

		foreach ($param as $key=>$val){
			$setMethodName = 'set'.ucfirst($key);
			$instants->$setMethodName($val);

			$getMethodName= 'get'.ucfirst($key);
			if($key != 'id'){
				$fields .= '`'.$key.'` = :'.$key.','; // `name` = :name, `email` = :email WHERE `id` = :id
			}
				$bindFields[$key] = $instants->$getMethodName();
		}
		$fields = substr($fields,0,-1);

		$pdo = $this->connect();
		$sql = 'UPDATE `' . static::getTable() . '` SET '.$fields .' WHERE `id` = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->execute($bindFields);
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