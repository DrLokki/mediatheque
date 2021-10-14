<?php 
namespace Media\controller;

use Media\model\Repository\RepositoryUsers;
use Media\model\Entity\Users;

function check($buffer)
{
	if(isset($_SESSION['id'])){
		
		$buffer = str_replace('onclick="revelLogin()" type="button"', 'type="submit" value="deconect"', $buffer);
		return (str_replace("connexion", "déconnexion", $buffer));
	}
	return $buffer;
}

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
    	$this->ob = check(ob_get_contents());
    	ob_end_clean();

    }

	public function index()
    {
    	echo $this->ob;
	}
}
?>