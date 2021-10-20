<div id="modal register" class="hidden fixed top-0 bg-opacity-50 flex-col items-center justify-center w-screen h-screen bg-gray-900 text-gray-700">

	<h1 class="font-bold text-2xl">Bienvenue :)</h1>	
	<form class="flex flex-col bg-white shadow-lg p-12 mt-12" action="" method="post">
		<span id="close" class="flex justify-end"><button type="button" onclick="cross()" class="text-right font-bold text-2xl">&times;</button></span>
		<label class="font-semibold text-xs" for="firstname">Prénom</label>
		<input class="flex items-center h-12 px-4 w-64 bg-lightCyan mt-2 focus:outline-none focus:ring-2" required autocomplete="given-name" name="firstname" type="text">
		<label class="font-semibold text-xs" for="lastname">Nom</label>
		<input class="flex items-center h-12 px-4 w-64 bg-lightCyan mt-2 focus:outline-none focus:ring-2" required autocomplete="family-name" name="lastname" type="text">
		<label class="font-semibold text-xs" for="email">Email</label>
		<input class="flex items-center h-12 px-4 w-64 bg-lightCyan mt-2 focus:outline-none focus:ring-2" required autocomplete="email" name="email" type="email">
		<label class="font-semibold text-xs" for="birthDate">Date de naissance</label>
		<input class="flex items-center h-12 px-4 w-64 bg-lightCyan mt-2 focus:outline-none focus:ring-2" required autocomplete="bday" name="birthDate" type="date">
		<label class="font-semibold text-xs mt-3" for="password">Mots de pass</label>
		<input class="flex items-center h-12 px-4 w-64 bg-lightCyan mt-2 focus:outline-none focus:ring-2" required autocomplete="new-password" name="password" type="password">
		<label class="font-semibold text-xs" for="adress">Adresse</label>
		<input class="flex items-center h-12 px-4 w-64 bg-lightCyan mt-2 focus:outline-none focus:ring-2" required autocomplete="street-address" name="adress" type="text">
		<button class="flex items-center justify-center h-12 px-6 w-64 bg-eagleGreen mt-8 rounded font-semibold text-sm text-mintCream hover:text-vividSky" required name="button" type="submit" value="register">Ce connecter</button>
	</form>

</div>
