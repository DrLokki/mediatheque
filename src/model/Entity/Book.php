<?php

namespace Media\model\Entity;
use Media\model\Repository\RepositoryUsers;

/**
 * summary
 */
class Book
{
	private int $id;
	private String $title;
	private String $image;
	private String $release_date;
	private String $description;
	private String $author;
	private String $kind;
	private String $tags;
	private String $isbn;
	private $loan_date;
	private $edition;
	private $borrower;
	private $repository;
	private bool $withdrawal;

	/**
	 * Class Constructor 
	 */
	public function __construct()
	{
		$this->repository = new RepositoryUsers();
	}
	

	public function setTitle($title)
	{
		$this->title = htmlspecialchars($title);
		return $this;
	}

	public function setImage($image)
	{
		$this->image = $image;
		return $this;
	}

	public function setRelease_date($release_date)
	{
		$this->release_date = $release_date;
		return $this;
	}

	public function setDescription($description)
	{
		$this->description = htmlspecialchars($description);
		return $this;
	}

	public function setAuthor($author)
	{
		$this->author = htmlspecialchars($author);
		return $this;
	}

	public function setKind($kind)
	{
		$this->kind = htmlspecialchars($kind);
		return $this;
	}

	public function setTags($tags)
	{
		if (isset($tags)) {
			$this->tags = $tags;
		}else{
			$this->tags = "";
		}
		return $this;
	}

	public function setIsbn($isbn)
	{
		if (isset($isbn)) {
			$this->isbn = htmlspecialchars($isbn);
		}else{
			$this->isbn = "";
		}
		
		return $this;
	}

	public function setLoan_date($loan_date="")
	{
		$this->loan_date = $loan_date;
		return $this;
	}

	public function setEdition($edition)
	{
		if (isset($edition)) {
			$this->edition = htmlspecialchars($edition);
		}else{
			$this->edition = "";
		}
		return $this;
	}

	public function setBorrower($borrower="0")
	{
		$this->borrower = $borrower;
		return $this;
	}

	public function setWithdrawal($withdrawal="false")
	{
		$this->withdrawal = $withdrawal;
		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function getRelease_date()
	{
		return $this->release_date;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getKind()
	{
		return $this->kind;
	}

	public function getTags()
	{
		return $this->tags;
	}

	public function getIsbn()
	{
		return $this->isbn;
	}

	public function getLoan_date()
	{
		return $this->loan_date;
	}

	public function getEdition()
	{
		return $this->edition;
	}

	public function getBorrower()
	{
		return $this->borrower;
	}

	public function getUserBorrwer()
	{
		return $this->repository->findOneById($this->borrower);
	}
}