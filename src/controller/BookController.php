<?php 
namespace Media\controller;

use Media\model\Repository\RepositoryBook;

function checkAndDontBorrow($buffer)
{
	if(!isset($_SESSION['id'])){
		
		$buffer = str_replace('onclick="revelLogin()" type="button"', 'type="submit" value="deconect"', $buffer);
		$buffer = str_replace('class="b{{isbn}} p-2 leading-none rounded font-medium bg-gray-400 text-xs uppercase"', 'class="p-2 leading-none rounded font-medium cursor-not-allowed bg-yellow-400 line-through text-xs uppercase {{Bclass}}"', $buffer);
		$buffer = str_replace("borrow('{{URLtitle}}')", "", $buffer);
		return (str_replace("connexion", "déconnexion", $buffer));
	}
	return $buffer;
}

class BookController
{
	private $ob;
	private $repository;

	/**
	 * summary
	 */
	public function __construct()
	{
		ob_start();
		include 'view/page/BookView.php';
		$this->view = checkAndDontBorrow(ob_get_contents());
		ob_end_clean();
		$this->repository = new RepositoryBook;
	}

	public function index()
	{
		// $paterne = [,'%({{image1}})%','%({{image2}})%','%({{image3}})%'];
   //  	$lastImageBook = $this->repository->getLast();
   //  	for ($i = 0; $i <= 3; $i++) {
   //  		$this->view = preg_replace($paterne[$i], $lastImageBook[$i][0], $this->view);
   //  	}
		// if (isset($book["borrower"])) {
			// 	$content = $content." ".preg_replace_callback(
			// 		'%(<button id="borrow" class=")(.+)(" .+>)Emprunter(<\/button>)%',
			// 		function ($matches) {
			// 			return $matches[1]."font-bold rounded font-medium cursor-not-allowed py-1 px-2 text-left bg-red-500".$matches[3]."indisponible".$matches[4];
			// 		},
			// 		$this->bookCard
			// 	);
			// 	$content = preg_replace($paterne,$book,$content);
			// }else {
			// 	$content = $content." ".preg_replace($paterne,$book,$this->bookCard);
			// }
		try{
			if (isset($_GET['title'])) {
				$book = $this->repository->findOneByTitle(urldecode($_GET['title']));
				$this->view = preg_replace('%({{title}})%', $book->getTitle(), $this->view);
				$this->view = preg_replace('%({{image}})%', $book->getImage(), $this->view);
				$this->view = preg_replace('%({{author}})%', $book->getAuthor(), $this->view);
				$this->view = preg_replace('%({{edition}})%', $book->getEdition(), $this->view);
				$this->view = preg_replace('%({{release}})%', date("j F, y",(int)$book->getRelease_date()), $this->view);
				$this->view = preg_replace('%({{description}})%', $book->getDescription(), $this->view);
				$tag = implode(",",json_decode($book->getTags()));
				$this->view = preg_replace('%({{tags}})%',$tag , $this->view);
				$this->view = preg_replace('%({{kind}})%', $book->getKind(), $this->view);
				$this->view = preg_replace('%({{isbn}})%', $book->getIsbn(), $this->view);
				$this->view = preg_replace('%({{URLtitle}})%', urlencode($book->getTitle()), $this->view);
				$disponibilityDate = new \DateTime($book->getLoan_date());
				var_dump($book->getLoan_date());
				$disponibilityDate->modify("+21 day");
				$this->view = preg_replace('%({{disponibility}})%',$disponibilityDate->format('j F, Y') , $this->view);
				if ($book->getBorrower() > 0) {
					$this->view = preg_replace('%({{Bclass}})%','hidden' , $this->view);
					$this->view = preg_replace('%({{class}})%','italic' , $this->view);
				}else {
					$this->view = preg_replace('%({{Bclass}})%','' , $this->view);
					$this->view = preg_replace('%({{class}})%','hidden' , $this->view);					
				}
			}
		} catch (Exception $e) {
			print_r($e);
		}
		echo $this->view;
	}
}
?>