<?php 
namespace Media\controller;

use Media\model\Repository\RepositoryUsers;
use Media\model\Entity\Users;

?>

<?php

class HomeController
{
	private $ob;
	private $user;
	private $repository;

    /**
     * summary
     */
    public function __construct()
    {
    	ob_start();
    	include 'view/page/HomeView.php';
    	$this->ob = ob_get_contents();
    	ob_end_clean();
        $this->user = new Users();
        $this->repository = new RepositoryUsers();
    }

	public function index()
    {
    	echo $this->ob;

    	try {
			if ($_POST["button"] === "register") {
				$this->user->setName($_POST['firstname'])
					->setLastName($_POST['lastname'])
					->setRole('inscrit')
					->setEmail($_POST['email'])
					->setBdate($_POST['birthDate'])
					->setAdress($_POST['adress'])
					->setPassword($_POST['password'])
					->setIsVerified(false);
				$this->repository->newUsers($this->user);
				unset($_POST);
			}elseif ($_POST["button"] === "login") {
				$this->user = $this->repository->findOneByEmailPass($_POST['email'],$_POST['password']);
				unset($_POST);
				if ($this->user) {
					if ($this->user->getIsVerified()) {
						$_SESSION['firstname'] = $this->user->getName();
						$_SESSION['lastname'] = $this->user->getLastName();
						$_SESSION['id'] = $this->user->getId();
						$_SESSION['loan_number'] = $this->user->getLoanNumber();
						$_SESSION['role'] = $this->user->getRole();
					}
				}else
				{
						$_SESSION['role'] = "qsdfqsd";
				}
				
			}
		} catch (Exception $e) {
			return $e;
		}
	}
}
?>