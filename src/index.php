<?php
session_start();
use Media\Autoloader;

require 'Autoloader.php';
Autoloader::register();

use Media\controller\HomeController;
use Media\controller\PanelController;
use Media\controller\CatalogController;
use Media\controller\BookController;
use Media\model\Entity\Users;
use Media\model\Repository\RepositoryUsers;

$home = new HomeController();
$book = new BookController();
$repository = new RepositoryUsers();
$user = new Users();
$panel = new PanelController();
$catalog = new CatalogController();
// router
switch ($_SERVER['PATH_INFO']) {
	case "/moncompte":
		$panel->index();
		break;
	case "/catalogue":
		$catalog->index();
		break;
	case "/livre":
		$book->index();
		break;
	default:
		$home->index();
		break;
}
try {
	if (isset($_POST["button"])) {
		if ($_POST["button"] === "register") {
			$user->setName($_POST['firstname'])
				->setLastName($_POST['lastname'])
				->setRole('inscrit')
				->setEmail($_POST['email'])
				->setBdate($_POST['birthDate'])
				->setAdress($_POST['adress'])
				->setPassword($_POST['password'])
				->setIsVerified(false);
			$repository->newUsers($user);
			unset($_POST);
		}elseif ($_POST["button"] === "login") {
			$user = $repository->findOneByEmailPass($_POST['email'],$_POST['password']);
			unset($_POST);
			if ($user) {
				if ($user->getIsVerified()) {
					$_SESSION['firstname'] = $user->getName();
					$_SESSION['lastname'] = $user->getLastName();
					$_SESSION['id'] = $user->getId();
					$_SESSION['loan_number'] = $user->getLoanNumber();
					$_SESSION['role'] = $user->getRole();
					header('Location: '.$_SERVER['REQUEST_URI']);
				}
			}else
			{
					$_SESSION['role'] = "qsdfqsd";
			}
			
		}elseif ($_POST["button"] === "deconect") {
			$_SESSION = [];
			unset($_SESSION);
    		header('Location: '.$_SERVER['REQUEST_URI']);
		}
	}
} catch (Exception $e) {
	return $e;
}
