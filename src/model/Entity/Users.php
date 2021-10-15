<?php

namespace Media\model\Entity;

/**
 * summary
 */
class Users
{
	private int $id;
	private String $name;
	private String $last_name;
	private $role;
	private int $loan_number;
	private String $email;
	private String $birth_date;
	private String $adress;
	private String $mdp;
	private bool $is_verified;

    public function setName($name)
    {
    	$this->name = htmlspecialchars($name);
    	return $this;
    }

    public function setLastName($lName)
    {
        $this->last_name = htmlspecialchars($lName);
        return $this;
    }

    public function setRole($role)
    {
        $this->role = htmlspecialchars($role);
        return $this;
    }

    public function setLoanNumber($loan)
    {
        $this->loan_number = $loan;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = htmlspecialchars($email);
        return $this;
    }

    public function setBdate($bdate)
    {
        $this->birth_date = $bdate;
        return $this;
    }

    public function setAdress($adress)
    {
        $this->adress = htmlspecialchars($adress);
        return $this;
    }

    public function setPassword($password)
    {
        $this->mdp = \password_hash($password,\PASSWORD_DEFAULT);
        return $this;
    }

    public function setIsVerified($iv=false)
    {
        $this->is_verified = $iv;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
    	return $this->name;
    }

    public function getLastName()
    {
    	return $this->last_name;
    }

    public function getRole()
    {
    	return $this->role;
    }

    public function getLoanNumber()
    {
    	return $this->loan_number;
    }

    public function getEmail()
    {
    	return $this->email;
    }

    public function getBdate()
    {
    	return $this->birth_date;
    }

    public function getAdress()
    {
    	return $this->adress;
    }

    public function getPassword()
    {
    	return $this->mdp;
    }

    public function getIsVerified()
    {
    	return $this->is_verified;
    }
}