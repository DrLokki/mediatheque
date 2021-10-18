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
		<section class="flex justify-around mt-10 flex-wrap">
			<?php include 'view/component/usersLoan.php';?>
			<article class="mx-2 p-2">
				<h3>Vos information de compte</h3>
				<?php include 'view/component/userInfo.php';?>
			</article>
		</section>
	</main>
	<?php include 'view/component/footer.php';?>
	<script>
		function unwithdrawal(title) {
			let id = document.getElementById(title);
			let headers = {"Content-type" : "application/json"};
			let uuid = {"unwithdrawal":id.getAttribute("value")};
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
	</script>
</body>
</html>