<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="tailwind.css">
	<title>Médiathèque - {{title}}</title>
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
		<section class="flex justify-around mt-10 ">
			<article class="mx-2 p-2 justify-around w-full flex flex-wrap sm:flex-nowrap">
				<img src="{{image}}" alt="" class="shadow-sm">
				<div class="mx-4 leading-relaxed">
					<h3 class="text-center underline text-2xl font-extrabold">{{title}}</h3>
					<div class="">autheur : <span class="underline">{{author}}</span></div>
					<div class="">édition : {{edition}}</div>
					<div class="">date de sortie : {{release}}</div>
					<p class=""> description : <span class="font-serif">{{description}}</span></p>
					<div class="">type de document : {{kind}}</div>
					<div class="text-opacity-90">genre : {{tags}}</div>
					<button id="borrow" class="b{{isbn}} p-2 leading-none rounded font-medium bg-gray-400 text-xs uppercase {{Bclass}}" onclick="borrow('{{URLtitle}}','{{isbn}}')">Emprunter</button>
					<div class="text-sm {{class}}">Ce livre est indisponible, le retour est prévue le <b>{{disponibility}}</b></div>
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

		function borrow(title,isbn) {
			const buttonArticle = document.querySelector(".b"+isbn);
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
							buttonArticle.className += 'cursor-not-allowed line-through';
						}
						console.log(jsonData);
					})
									
				})
		}

	</script>
</body>
</html>