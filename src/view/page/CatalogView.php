<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="tailwind.css">
	<title>Médiathèque - Catalogue</title>
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
		<nav class="flex items-center justify-center w-full border-b border-t border-black">
			<a class="flex items-center h-16 mr-8" href="#">Menu Item 1</a>
			<a class="flex items-center h-16 mr-8" href="#">Menu Item 2</a>
		</nav>
		<section class="flex justify-around mt-10">
			<?php include 'view/component/twitter.php';?>
			<div id="book" class="flex justify-around w-full">
				{{books}}
				<article></article>
			</div>	
		</section>
		<nav class="flex items-center justify-center w-full mt-4 border-b border-t border-black">
			<button class="bg-yellow-300 h-16 px-2" onClick="prev()"><<-précédente</button>
			<button class="bg-yellow-300 h-16 px-2" onClick="next()">suivante->></button>
		</nav>
	</main>
	<script>
		// Get the modal
		let modal = document.getElementById("modal login");
		let Rmodal = document.getElementById("modal register");
		let page = 1;

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

		function borrow(title) {
			let article = document.getElementById(title);
			let headers = {"Content-type" : "application/json"};
			let uuid = {"title":title};
			let init = {
				method: 'POST',
				headers: headers,
				body : JSON.stringify(uuid)
			};

			fetch('/catalogue',init)
				.then((response) => {
					console.log(response)
					article.parentNode.removeChild(article);					
				})
		}

		function updateCatalog(catalog) {
			let content = document.querySelector('#book');
			let article = content.querySelectorAll('.book');
			const div = "<div></div>"
			article.forEach((current) => current.remove());
			content.innerHTML = catalog.trim();
			content.innerHTML += div.trim();
		}

		function next() {
			let headers = {"Content-type" : "application/json"};
			page = (page+1) > {{count}} ? {{count}} : page+1
			let uuid = {"page":page};
			let init = {
				method: 'POST',
				headers: headers,
				body : JSON.stringify(uuid)
			};

			fetch('/catalogue',init)
				.then((response) => {
					console.log(response);
					const data = response.text();

					data.then((jsonData) => {
						console.log(jsonData);
						updateCatalog(jsonData);
					});
				});
		}

		function prev() {
			let headers = {"Content-type" : "application/json"};
			page = (page-1) < 1 ? 1 : page-1
			let uuid = {"page":page};
			let init = {
				method: 'POST',
				headers: headers,
				body : JSON.stringify(uuid)
			};

			fetch('/catalogue',init)
				.then((response) => {
					console.log(response);
					const data = response.text();

					data.then((jsonData) => {
						console.log(jsonData);
						updateCatalog(jsonData);
						page
					});
				});
		}
	</script>
</body>
</html>