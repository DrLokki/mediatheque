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
		<section class="flex justify-around mt-10 ">
			<?php include 'view/component/twitter.php';?>
			<article class="mx-2 p-2">
				<h3 class="text-center text-2xl font-extrabold text-sans">Nouveauté</h3>
				<div class="flex justify-center sm:justify-between flex-wrap">
					<div class="w-4/5 sm:w-1/6 xl:max-w-xs min-w-min m-2"><a href="/livre?title={{URLtitle0}}" class=""><img src="{{image0}}" alt=""></a></div>
					<div class="w-4/5 sm:w-1/6 xl:max-w-xs min-w-min m-2"><a href="/livre?title={{URLtitle1}}" class=""><img src="{{image1}}" alt=""></a></div>
					<div class="w-4/5 sm:w-1/6 xl:max-w-xs min-w-min m-2"><a href="/livre?title={{URLtitle2}}" class=""><img src="{{image2}}" alt=""></a></div>
					<div class="w-4/5 sm:w-1/6 xl:max-w-xs min-w-min m-2"><a href="/livre?title={{URLtitle3}}" class=""><img src="{{image3}}" alt=""></a></div>
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

	</script>
</body>
</html>