<?php 
namespace Media\controller;

use Media\model\Repository\RepositoryBook;
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
    	$this->view = check(ob_get_contents());
    	ob_end_clean();
    	$this->repository = new RepositoryBook;
    }

	public function index()
    {
    	$paterne = ['%({{image0}})%','%({{image1}})%','%({{image2}})%','%({{image3}})%'];
    	$paterne2 = ['%({{URLtitle0}})%','%({{URLtitle1}})%','%({{URLtitle2}})%','%({{URLtitle3}})%'];
    	$lastImageBook = $this->repository->getLast();
    	for ($i = 0; $i <= 3; $i++) {
    		$this->view = preg_replace($paterne[$i], $lastImageBook[$i][0], $this->view);
    		$this->view = preg_replace($paterne2[$i], urlencode($lastImageBook[$i][1]), $this->view);
    	}
    	echo $this->view;
	}
}
?>