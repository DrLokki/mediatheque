<?php 
namespace Media\controller;

use Media\model\Repository\RepositoryUsers;
use Media\model\Repository\RepositoryBook;
use Media\model\Entity\Users;
use Media\model\Entity\Book;


class PanelController
{
	private $ob;
	private $book;
	private $repository;
	private $bookRepository;
	private $loanList;

	/**
	 * summary
	 */
	public function __construct()
	{
		ob_start();
		include 'view/page/UserPanelView.php';
		$this->UPanel = check(ob_get_contents());
		ob_clean();
		include 'view/page/EmployerPanelView.php';
		$this->EPanel = check(ob_get_contents());
		ob_clean();
		include 'view/component/whatingInscription.php';
		$this->component = ob_get_contents();
		ob_clean();
		include 'view/component/empruntList.php';
		$this->empruntList = ob_get_contents();
		ob_clean();
		include 'view/component/withdrawList.php';
		$this->withdrawList = ob_get_contents();
		ob_end_clean();
		$this->book = new Book();
		$this->repository = new RepositoryUsers();
		$this->bookRepository = new RepositoryBook();
	}

	public function index()
	{
		if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'employer') {

			// get unverified account
			$paterne = ['%({{name}})%','%({{last_name}})%','%({{adress}})%','%({{id}})%'];
			$unVerifiedUser = $this->repository->findUnVerified();
			$content = "";
			foreach ($unVerifiedUser as $user) {
				$content = $content." ".preg_replace($paterne,$user,$this->component);
			}
			$this->EPanel = preg_replace('%({{unverified}})%',$content,$this->EPanel);

			// get withdrawal book list
			$withdrawBook = $this->bookRepository->getWithdrawal();
			$content = "";
			$paterne = ['%({{title}})%','%({{author}})%'];
			foreach ($withdrawBook as $book) {
				// check reservation date
				$book["timestamp"] = (int)$book["timestamp"];
				$difDate = time() - $book["timestamp"];
				$difDate = ((int)date("j",$difDate));
				var_dump(date("j",time()), date("j",$book["timestamp"]));
				$content = $content." ".preg_replace($paterne,$book,$this->withdrawList);
				if ($difDate > 3) {
					$user = $this->repository->findOneById($book['borrower']);
					$this->bookRepository->setWithdrawal(false, $book['title']);
					$this->bookRepository->removeBorrow($book['title']);
					$this->repository->subLoan($user->getId());
					$content = preg_replace('%({{specialClass}})%',"hidden",$content);
					$content = preg_replace('%({{specialBalise}})%',"<span class='bg-green-100 px-2 text-right align-middle'> reservation annuler</span>",$content);
				}else {
					$content = preg_replace('%({{specialClass}})%',"",$content);
					$content = preg_replace('%({{specialBalise}})%',"",$content);
				}

				// replace with book info
				$content = preg_replace('%({{URLtitle}})%',urlencode($book['title']),$content);
			}
			$this->EPanel = preg_replace('%({{withdrawBook}})%',$content,$this->EPanel);

			// get borrow(loan) book list
			$this->loanList = $this->bookRepository->getAdminBorrow();
			$content = "";
			foreach ($this->loanList as $book) {
				$user = $book->getUserBorrower();
				$difDate = time() - $book->getTimeStamp();
				$content = $content." ".preg_replace('%({{title}})%',$book->getTitle(),$this->empruntList);
				$difDate = ((int)date("j",$difDate));
				if ($difDate > 21) {
					$content = preg_replace('%({{EMPclass}})%',"bg-red-100",$content);	
				}
				$content = preg_replace('%({{author}})%',urlencode($book->getAuthor()),$content);
				$content = preg_replace('%({{name}})%',urlencode($user->getName()),$content);
				$content = preg_replace('%({{id}})%',urlencode($user->getId()),$content);
				$content = preg_replace('%({{last_name}})%',urlencode($user->getLastName()),$content);
				$content = preg_replace('%({{URLtitle}})%',urlencode($book->getTitle()),$content);
			}
			echo preg_replace('%({{loan}})%',$content,$this->EPanel);
		}elseif ($_SESSION['role'] === 'inscrit') {
			// get withdrawal book list
			$withdrawBook = $this->bookRepository->getWithdrawal();
			$content = "";
			$paterne = ['%({{title}})%','%({{author}})%'];
			foreach ($withdrawBook as $book) {
				$content = $content." ".preg_replace($paterne,$book,$this->withdrawList);
				$content = preg_replace('%({{URLtitle}})%',urlencode($book['title']),$content);
			}
			$this->UPanel = preg_replace('%({{withdrawBook}})%',$content,$this->UPanel);

			// get borrow(loan) book list
			$this->loanList = $this->bookRepository->getBorrow($_SESSION['id']);
			$content = "";
			foreach ($this->loanList as $book) {
				$content = $content." ".preg_replace('%({{title}})%',$book->getTitle(),$this->empruntList);
				$content = preg_replace('%({{author}})%',urlencode($book->getAuthor()),$content);
				$content = preg_replace('%({{name}})%',urlencode($book->getEdition()),$content);
				$content = preg_replace('%(N°{{id}})%',"",$content);
				$content = preg_replace('%({{last_name}})%',implode(",",json_decode($book->getTags())),$content);
				$content = preg_replace('%(<button id="{{URLtitle}}".+<\/button>)%',"",$content);
			}
			$this->UPanel = preg_replace('%({{loan}})%',$content,$this->UPanel);

			// get users info
			$users = $this->repository->findOneById($_SESSION['id']);
			$usersInfo  = [
				'UserAdress' => $users->getAdresse(),
				'UserBDate' => date("j F, Y",$users->getTimeStamp()),
				'UserEmail' => $users->getEmail()
			];
			$paterne = ['%({{UserAdress}})%','%({{UserBDate}})%','%({{UserEmail}})%'];
			 echo preg_replace($paterne,$usersInfo,$this->UPanel);
		}else{
			header('Location: /');
		}

		try{
			// Takes raw data from the request
			$json = file_get_contents('php://input');
			
			// Converts it into a PHP object
			$data = json_decode($json);
			if (isset($data->id)) {
				$this->repository->verified($data->id);
			}elseif (isset($_POST["button"])) {
				if ($_POST["button"] === "addBook") {
					$image = "./picture/".uniqid()."_".$_FILES['image']['name'];
					move_uploaded_file($_FILES['image']['tmp_name'], $image);
					$this->book->setTitle($_POST['title'])
						->setImage($image)
						->setRelease_date($_POST['release_date'])
						->setDescription($_POST['description'])
						->setAuthor($_POST['author'])
						->setKind($_POST['kind'])
						->setIsbn($_POST['isbn'])
						->setEdition($_POST['edition'])
						->setTags($_POST['tags']);
					$this->bookRepository->newBook($this->book);
				}
			}elseif (isset($data->title)) {
				$this->bookRepository->setWithdrawal(true, urldecode($data->title));
			}elseif (isset($data->titleID)) {
				$this->bookRepository->setWithdrawal(false, urldecode($data->titleID));
				$this->bookRepository->removeBorrow(urldecode($data->titleID));
				$this->repository->subLoan($data->userID);
			}
		} catch (Exception $e) {
			print_r($e);
		}
	}
}
?>