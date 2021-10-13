<div id="modal login" class="hidden fixed top-0 bg-opacity-50 flex-col items-center justify-center w-screen h-screen bg-gray-900 text-gray-700">

	<h1 class="font-bold text-2xl">Bienvenue :)</h1>	
	<form class="flex flex-col bg-white rounded shadow-lg p-12 mt-12" action="" method="post">
		<span id="close" class="flex justify-end"><button type="button" onclick="cross()" class="text-right font-bold text-2xl">&times;</button></span>
		<label class="font-semibold text-xs" for="email">Email</label>
		<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" required autocomplete="email" name="email" type="email">
		<label class="font-semibold text-xs mt-3" for="password">Mots de pass</label>
		<input class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 focus:outline-none focus:ring-2" required autocomplete="new-password" name="password" type="password">
		<button type="submit" class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700" onclick="cross()" required name="button" type="submit" value="login">Ce connecter</button>
		<div class="flex mt-6 justify-center text-xs">
			<button type="button" onclick="register()" class="text-blue-400 hover:text-blue-500" href="#">créé un compte</button>
		</div>
	</form>
</div>