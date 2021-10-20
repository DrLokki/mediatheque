<aside id="loanList" class="overflow-scroll mt-12 h-96 min-w-min sm:block w-60 lg:w-80 mx-2 border-2 border-black">
	<div class="tab">
		<button class="tablinks bg-mediumTurquoise hover:bg-eagleGreen px-4 py-2 mb-1" onclick="openCity(event, 'loan')">Emprunt en cour</button>
		<button class="tablinks bg-mediumTurquoise hover:bg-eagleGreen px-4 py-2 mb-1" onclick="openCity(event, 'withdrawal')">Livre a récupéré</button>
	</div>
	<!-- Tab content -->
	<div id="loan" class="tabcontent">
		<h3>Emprunt en cour</h3>
		<ul class="divide-y divide-eagleGreen">
			{{loan}}
		</ul>
	</div>
	
	<div id="withdrawal" class="tabcontent hidden">
		<h3>Livre a récupéré</h3>
		<ul class="divide-y divide-eagleGreen">
			{{withdrawBook}}
		</ul>
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