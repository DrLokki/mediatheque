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
			<input id="search" class="h-16 mr-8" type="text">
			<button class="flex items-center h-16 mr-8" onClick="search()">Menu Item 2</button>
		</nav>
		<section class="flex justify-around mt-10">
			<?php include 'view/component/twitter.php';?>
			<div id="book" class="flex justify-around w-full flex-wrap">
				{{books}}
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
		let filter = ""

		function search() {
			const input = document.getElementById("search");
			const headers = {"Content-type" : "application/json"};
			page = 1;
			filter = input.value;
			const uuid = {
				"filter":filter,
				"page":page
			};
			const init = {
				method: 'POST',
				headers: headers,
				body : JSON.stringify(uuid)
			};

			fetch('/catalogue',init)
				.then((response) => {
					const data = response.text();

					data.then((text) => {
						console.log(text);
						updateCatalog(text);
					})
										
				});
		}

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
			const article = document.getElementById(title);
			const headers = {"Content-type" : "application/json"};
			const uuid = {"title":title};
			const init = {
				method: 'POST',
				headers: headers,
				body : JSON.stringify(uuid)
			};

			fetch('/catalogue',init)
				.then((response) => {
					const data = response.json();

					data.then((jsonData) => {
						if (jsonData.bool){
							article.parentNode.removeChild(article);
						}
						console.log(jsonData);
					})
										
				})
		}

		function updateCatalog(catalog) {
			const content = document.querySelector('#book');
			const article = content.querySelectorAll('.book');
			article.forEach((current) => current.remove());
			content.innerHTML = catalog.trim();
		}

		function next() {
			let headers = {"Content-type" : "application/json"};
			page = (page+1) > {{count}} ? {{count}} : page+1
			let uuid = {
				"filter":filter,
				"page":page
			};
			let init = {
				method: 'POST',
				headers: headers,
				body : JSON.stringify(uuid)
			};

			fetch('/catalogue',init)
				.then((response) => {
					console.log(response);
					const data = response.text();

					data.then((text) => {
						console.log(text);
						updateCatalog(text);
					});
				});
		}

		function prev() {
			let headers = {"Content-type" : "application/json"};
			page = (page-1) < 1 ? 1 : page-1
			let uuid = {
				"filter":filter,
				"page":page
			};
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