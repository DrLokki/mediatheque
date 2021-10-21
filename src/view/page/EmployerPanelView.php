<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="tailwind.css">
	<title>Médiathèque</title>
</head>
<body>
	<header>
		<?php include 'view/component/header.php';?>
	</header>
	<main class="my-2">
		<?php 
			include 'view/component/loginModal.php';
			include 'view/component/registerModal.php';
		?>
		<section class="flex justify-around mt-10 flex-wrap">
			<?php include 'view/component/loan.php';?>
			<article class="mx-2 p-2">
				<h3>Inscrit a valider</h3>
				<div class="flex items-center justify-center p-10">
					<!-- Resice the preview panel to check the responsiveness -->
				
					<!-- Component Start -->
					<div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-2 xl:max-w-6xl max-w-4xl">
						{{unverified}}
					<!-- Component End  -->

					</div>
			</article>
		</section>
	</main>
	<script>
		// Get the modal
		let modal = document.getElementById("modal login");
		let Rmodal = document.getElementById("modal register");

		function revelLogin(){
			modal.style.display = "flex";
		}

		function cross() {
			modal.style.display = "none";
			Rmodal.style.display = "none";
		}

		function register() {
			modal.style.display = "none";
			Rmodal.style.display = 'flex';
		}

		function validate() {
			let id = document.getElementById('validate');
			let headers = {"Content-type" : "application/json"};
			let uuid = {"id":id.getAttribute("value")};
			let init = {
				method: 'POST',
            	headers: headers,
            	body : JSON.stringify(uuid)
			};

			fetch('/moncompte',init)
				.then((response) => {
					id.parentNode.parentNode.parentNode.removeChild(id.parentNode.parentNode);					
				});
		}

		function withdrawalValide(title) {
			let id = document.getElementById(title);
			let headers = {"Content-type" : "application/json"};
			let uuid = {"title":id.getAttribute("value")};
			let init = {
				method: 'POST',
				headers: headers,
				body : JSON.stringify(uuid)
			};

			fetch('/moncompte',init)
				.then((response) => {
					id.parentNode.parentNode.removeChild(id.parentNode);
				});
		}

		function comeBack(title,id) {
			let button = document.getElementById(title);
			let headers = {"Content-type" : "application/json"};
			let uuid = {
				"titleID":title,
				"userID":id
			};
			let init = {
				method: 'POST',
				headers: headers,
				body : JSON.stringify(uuid)
			};

			fetch('/moncompte',init)
				.then((response) => {
					button.parentNode.parentNode.removeChild(button.parentNode);
				});
		}
	</script>
</body>
</html>