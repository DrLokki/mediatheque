<!-- Tile 1 -->
<article id="{{URLtitle}}" class="book flex flex-col bg-gray-200 rounded-lg p-4 m-2 w-2/6 min-w-min">
	<img src="{{image}}" alt="" class="bg-gray-400 rounded-lg">
	<div class="flex flex-col items-start mt-4">
		<h4 class="text-lg font-semibold">{{title}}</h4>
		<p class="text-base underline my-1">{{author}}</p>
		<p class="text-sm">{{descrition}}</p>
		<span class="flex justify-around items-center mt-3 w-full">
			<button class="p-2 leading-none rounded font-medium bg-gray-400 text-xs uppercase" onclick="borrow('{{URLtitle}}')">Emprunter</button>
			<span class="text-xs text-right">{{tags}}</span>
		</span>		
	</div>
</article>