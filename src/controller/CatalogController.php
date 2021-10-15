<?php 
namespace Media\controller;

use Media\model\Repository\RepositoryUsers;
use Media\model\Repository\RepositoryBook;
use Media\model\Entity\Book;


class CatalogController
{
	private $view;
	private $book;
	private $repository;
	private $UserRepository;

    /**
     * summary
     */
    public function __construct()
    {
    	ob_start();
    	include 'view/page/CatalogView.php';
    	$this->view = check(ob_get_contents());
    	ob_clean();
    	include 'view/component/bookCard.php';
    	$this->bookCard = ob_get_contents();
    	ob_end_clean();
        $this->book = new Book();
        $this->repository = new RepositoryBook();
        $this->UserRepository = new RepositoryUsers();
    }

    public function generatePage($page=1)
    {
    	$paterne = ['%({{title}})%','%({{image}})%','%({{descrition}})%','%({{author}})%','%({{tags}})%'];
    	$bookList = $this->repository->getAll($page);
    	$content = "";
    	foreach ($bookList as $book) {
    		// var_dump($book);
    		if (strlen($book['descrition']) > 148) {
    			$book['descrition'] = substr($book['descrition'],0,strpos($book['descrition'],"."))."..";
    		}
    		$book["tags"] = htmlspecialchars(implode(",",json_decode($book["tags"])));
			$content = $content." ".preg_replace($paterne,$book,$this->bookCard);
			$content = preg_replace('%({{URLtitle}})%',urlencode($book['title']),$content);
		}
		return $content;

    }

	public function index()
    {
    	
    	try{
    		// Takes raw data from the request
			$json = file_get_contents('php://input');
			
			// Converts it into a PHP object
			$data = json_decode($json);
    		if (isset($data)) {
    			if ($data->title) {
    				$this->repository->setBorrow($_SESSION['id'],urldecode($data->title));
    				$this->UserRepository->addLoan($_SESSION['id']);
    			}elseif ($data->page) {
					echo $this->generatePage($data->page);	
    			}
    		}else{
    			$this->view = preg_replace('%({{books}})%',$this->generatePage(),$this->view);
				echo preg_replace('%({{count}})%',ceil($this->repository->getCount()/2),$this->view);
    		}
    	} catch (Exception $e) {
			print_r($e);
		}
	}
}
?>