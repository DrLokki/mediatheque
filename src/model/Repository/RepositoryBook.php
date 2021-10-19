<?php

namespace Media\model\Repository;

use Media\crendital;
use Media\model\Entity\Book;

/**
 * summary
 */
class RepositoryBook extends crendital
{
	/**
	 * summary
	 */
	public function __construct()
	{
		$this->dsn = 'pgsql:host=localhost;port=5432;dbname=media_db;user=ulna;password=radius2';
		$this->pdo = new \PDO($this->dsn);
	}

	public function newBook(Book $obj)
	{
		$statement = $this->pdo->prepare('INSERT INTO Book(title,image,release_date,descrition,author,kind,isbn,edition,tags) VALUES (:title, :image, DATE(:release_date), :description, :author, :kind, :isbn, :edition, :tags )');
		$statement->bindValue(':title',$obj->getTitle(),\PDO::PARAM_STR);
		$statement->bindValue(':image',$obj->getImage(),\PDO::PARAM_STR);
		$statement->bindValue(':release_date',$obj->getRelease_date(),\PDO::PARAM_STR);
		$statement->bindValue(':description',$obj->getDescription(),\PDO::PARAM_STR);
		$statement->bindValue(':author',$obj->getAuthor(),\PDO::PARAM_STR);
		$statement->bindValue(':kind',$obj->getKind(),\PDO::PARAM_STR);
		$statement->bindValue(':isbn',$obj->getIsbn(),\PDO::PARAM_STR);
		$statement->bindValue(':edition',$obj->getEdition(),\PDO::PARAM_STR);
		$statement->bindValue(':tags',$obj->getTags(),\PDO::PARAM_INT);
		$statement->execute();
	}

	public function findAllByTitle(String $title, Int $page){
		$statement = $this->pdo->prepare('SELECT title,image,descrition,author,tags,isbn,borrower FROM book WHERE title LIKE :title ORDER BY title LIMIT 2 OFFSET :start');
		$statement->bindValue(':title', $title, \PDO::PARAM_STR);
		$statement->bindValue(':start', 2*($page-1), \PDO::PARAM_INT);
		if ($statement->execute()) {
			$book = $statement->fetchAll(\PDO::FETCH_ASSOC);
			return $book;
		}

	}

	public function findOneByTitle(String $title){
		$statement = $this->pdo->prepare('SELECT *,EXTRACT(EPOCH FROM release_date) as release_date FROM book WHERE title LIKE :title');
		$statement->bindValue(':title', $title, \PDO::PARAM_STR);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Book::class);
		if ($statement->execute()) {
			$book = $statement->fetch();
			return $book;
		}

	}

	public function getAll(Int $page)
	{
		$statement = $this->pdo->prepare('SELECT title,image,descrition,author,tags,borrower,isbn FROM book ORDER BY title LIMIT 2 OFFSET :start');
		$statement->bindValue(':start', 2*($page-1), \PDO::PARAM_INT);
		if ($statement->execute()) {
			$book = $statement->fetchAll(\PDO::FETCH_ASSOC);
			return $book;
		}
	}

	public function getWithdrawal()
	{
		$statement = $this->pdo->prepare('SELECT title,author,EXTRACT(EPOCH FROM loan_date) as timestamp,borrower FROM book WHERE withdrawal=false AND borrower IS NOT NULL');
		if ($statement->execute()) {
			$book = $statement->fetchAll(\PDO::FETCH_ASSOC);
			return $book;
		}
	}

	public function setWithdrawal(bool $withdrawal, String $title)
	{
		$statement = $this->pdo->prepare('UPDATE book SET withdrawal=:withdrawal,loan_date=CURRENT_DATE  WHERE title=:title');
		$statement->bindValue(':title',$title,\PDO::PARAM_STR);
		$statement->bindValue(':withdrawal',$withdrawal,\PDO::PARAM_BOOL);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Book::class);
		$statement->execute();
	}

	public function getAdminBorrow()
	{
		$statement = $this->pdo->prepare('SELECT *, EXTRACT(EPOCH FROM loan_date) AS timestamp FROM book WHERE borrower IS NOT NULL AND withdrawal=true ORDER BY loan_date');
		$statement->setFetchMode(\PDO::FETCH_CLASS, Book::class);
		if ($statement->execute()) {
			$book = $statement->fetchAll();
			return $book;
		}
	}

	public function getBorrow(int $id)
	{
		$statement = $this->pdo->prepare('SELECT *, EXTRACT(EPOCH FROM loan_date) AS timestamp FROM book WHERE borrower=:id AND withdrawal=true ORDER BY loan_date');
		$statement->bindValue(':id',$id,\PDO::PARAM_STR);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Book::class);
		if ($statement->execute()) {
			$book = $statement->fetchAll();
			return $book;
		}
	}

	public function setBorrow(int $id, String $title)
	{
		$statement = $this->pdo->prepare('UPDATE book SET borrower=:id,loan_date=CURRENT_DATE FROM users WHERE title=:title AND users.loan_number<10 AND users.id=:id');
		$statement->bindValue(':id',$id,\PDO::PARAM_INT);
		$statement->bindValue(':title',$title,\PDO::PARAM_STR);
		$statement->setFetchMode(\PDO::FETCH_CLASS, Book::class);
		if ($statement->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function getLast()
	{
		$statement = $this->pdo->prepare('SELECT image,title FROM book ORDER BY release_date LIMIT 4 ');
		if ($statement->execute()) {
			$book = $statement->fetchAll(\PDO::FETCH_NUM);
			return $book;
		}
	}

	public function getCount()
	{
		$statement = $this->pdo->prepare('SELECT COUNT(*) FROM book');
		if ($statement->execute()) {
			$book = $statement->fetch(\PDO::FETCH_NUM);
			return $book[0];
		}
	}

	public function removeBorrow(String $title)
	{
		$statement = $this->pdo->prepare('UPDATE book SET borrower=NULL,loan_date=NULL WHERE title=:title');
		$statement->bindValue(':title',$title,\PDO::PARAM_STR);
		$statement->execute();
	}
}