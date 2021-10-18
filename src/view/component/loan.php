<aside id="loanList" class="overflow-scroll mt-12 h-96 min-w-min sm:block w-60 lg:w-80 mx-2 border-2 border-black">
	<div class="tab">
		<button class="tablinks bg-gray-200 active:bg-green-700 hover:bg-gray-300 px-4 py-2" onclick="openCity(event, 'loan')">Emprunt en cour</button>
		<button class="tablinks bg-gray-200 active:bg-green-700 hover:bg-gray-300 px-4 py-2" onclick="openCity(event, 'withdrawal')">Livre a récupéré</button>
		<button class="tablinks bg-gray-200 active:bg-green-700 hover:bg-gray-300 px-4 py-2" onclick="openCity(event, 'addBook')">ajouter un livre</button>
	</div>
	<!-- Tab content -->
	<div id="loan" class="tabcontent">
		<h3>Emprunt en cour</h3>
		<ul class="divide-y divide-yellow-500">
			{{loan}}
		</ul>
	</div>
	
	<div id="withdrawal" class="tabcontent hidden">
		<h3>Livre a récupéré</h3>
		<ul class="divide-y divide-yellow-500">
			{{withdrawBook}}
		</ul>
	</div>

	<div  id="addBook" class="tabcontent hidden">
		<form enctype="multipart/form-data" method="post" action="" class="">
			<label class="font-semibold text-xs" for="title">Titre</label>
			<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" required name="title" type="title" pattern="[A-Za-zéèàçùïöôûîëœ0-9\-\s']+">
			<label class="font-semibold text-xs" for="image">Couverture</label>
			<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" required name="image" type="file" ccept="image/png, image/jpeg">
			<label class="font-semibold text-xs" for="release_date">date de sortie</label>
			<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" required name="release_date" type="date">
			<label class="font-semibold text-xs" for="description">Déscription</label>
			<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" required name="description" type="textarea">
			<label class="font-semibold text-xs" for="author">Nom complet de l'auteur</label>
			<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" required name="author" type="text" pattern="[A-Za-zéèàçùïöôûîëœ0-9\-\s']+">
			<label class="font-semibold text-xs" for="kind">Type</label>
			<select class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" required name="kind" type="text">
				<option value="po%C3%A9sie" class="">poésie</option>
				<option value="roman" class="">roman</option>
				<option value="th%C3%A9atre" class="">théatre</option>
				<option value="jeunesse" class="">jeunesse</option>
				<option value="BD" class="">BD</option>
				<option value="comics" class="">comics</option>
				<option value="dvd" class="">dvd</option>
				<option value="cd" class="">cd</option>
				<option value="vinyle" class="">vinyle</option>
				<option value="livre diver" class="">livre diver</option>
				<option value="revue" class="">revue</option>
			</select>
			<label class="font-semibold text-xs" for="isbn">Isbn</label>
			<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" name="isbn" type="text" maxlength="13">
			<label class="font-semibold text-xs" for="edition">édition</label>
			<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" name="edition" type="text" pattern="[A-Za-zéèàçùïöôûîëœ0-9\-\s']+">
			<label class="font-semibold text-xs" for="tags">tags</label>
			<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" name="tags" type="text" pattern='^"[A-Za-zéèàçùïöôûîëœ]+"(,"[A-Za-zéèàçùïöôûîëœ]+")*$'>
			<button class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700" required name="button" type="submit" value="addBook">Ajouter</button>
		</form>
	</div>

	<script type="text/javascript" charset="utf-8" >
		function openCity(evt, cityName) {

		  	// Get all elements with class="tabcontent" and hide them
			let tabcontent = document.getElementsByClassName("tabcontent");
			for (let i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}

			// Show the current tab, and add an "active" class to the button that opened the tab
			document.getElementById(cityName).style.display = "block";
		}
	</script>
</aside>