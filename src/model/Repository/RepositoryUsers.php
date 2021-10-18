<?php

namespace Media\model\Repository;

use Media\crendital;
use Media\model\Entity\Users;

/**
 * summary
 */
class RepositoryUsers extends crendital
{

	/**
	 * summary
	 */
	public function __construct()
	{
		$this->dsn = 'pgsql:host=localhost;port=5432;dbname=media_db;user=ulna;password=radius2';
		$this->pdo = new \PDO($this->dsn);
	}

	public function newUsers(Users $obj)
	{
		$statement = $this->pdo->prepare('INSERT INTO Users(name,last_name,role,email,birth_date,adresse,mdp,is_verified) VALUES (:name, :lname, :role, :email, DATE(:bdate), :adresse, :mdp, :iv)');
		$statement->bindValue(':name',$obj->getName(),\PDO::PARAM_STR);
		$statement->bindValue(':lname',$obj->getLastName(),\PDO::PARAM_STR);
		$statement->bindValue(':role',$obj->getRole(),\PDO::PARAM_STR);
		$statement->bindValue(':email',$obj->getEmail(),\PDO::PARAM_STR);
		$statement->bindValue(':bdate',$obj->getBdate(),\PDO::PARAM_INT);
		$statement->bindValue(':adresse',$obj->getAdress(),\PDO::PARAM_STR);
		$statement->bindValue(':mdp',$obj->getPassword(),\PDO::PARAM_STR);
		$statement->bindValue(':iv',$obj->getIsVerified(),\PDO::PARAM_BOOL);
		$statement->execute();

	}

	public function findOneByEmailPass(String $email, String $mdp)
	{
		$statement = $this->pdo->prepare('SELECT * FROM users WHERE email LIKE :email');
		$statement->bindValue(':email', $email, \PDO::PARAM_STR);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Users::class);
		if ($statement->execute()) {
			$user = $statement->fetch();
			if ($user) {
				if (\password_verify($mdp, $user->getPassword())) {
					return $user;
				}
			}
			
			return false;
		}
	}

	public function findOneByName(String $name)
	{
		$statement = $this->pdo->prepare('SELECT * FROM users WHERE name LIKE :name');
		$statement->bindValue(':name', $name, \PDO::PARAM_STR);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Users::class);
		if ($statement->execute()) {
			$user = $statement->fetch();
			return $user;
		}
	}

	public function findOneById(String $id)
	{
		$statement = $this->pdo->prepare('SELECT *,extract(EPOCH FROM birth_date) as timestamp FROM users WHERE id=:id');
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Users::class);
		if ($statement->execute()) {
			$user = $statement->fetch();
			return $user;
		}
	}

	public function findUnVerified()
	{
		$statement = $this->pdo->prepare('SELECT name,last_name,adresse,id FROM users WHERE is_verified=false');
		if ($statement->execute()) {
			$users = $statement->fetchAll(\PDO::FETCH_NUM);
			return $users;
		}
	}

	public function verified(Int $id, Bool $bool=true)
	{
		$statement = $this->pdo->prepare('UPDATE users SET is_verified=:iv WHERE id=:id RETURNING *');
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->bindValue(':iv', $bool, \PDO::PARAM_BOOL);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Users::class);
		if ($statement->execute()) {
			$user = $statement->fetch();
			return $user;
		}
	}

	public function addLoan(Int $id)
	{
		$statement = $this->pdo->prepare('UPDATE users SET loan_number=loan_number+1 WHERE id=:id RETURNING *');
		$statement->bindValue(':id', $id, \PDO::PARAM_STR);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Users::class);
		if ($statement->execute()) {
			$user = $statement->fetch();
			return $user;
		}
	}

	public function subLoan(Int $id)
	{
		$statement = $this->pdo->prepare('UPDATE users SET loan_number=loan_number-1 WHERE id=:id RETURNING *');
		$statement->bindValue(':id', $id, \PDO::PARAM_STR);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Users::class);
		if ($statement->execute()) {
			$user = $statement->fetch();
			return $user;
		}
	}
}