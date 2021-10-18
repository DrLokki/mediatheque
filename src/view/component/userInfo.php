<ul class="list-inside list-disc">
	<li class="">N° <?php echo $_SESSION['id']; ?></li>
	<li class="">Prénom : <?php echo $_SESSION['firstname']; ?></li>
	<li class="">Nom : <?php echo $_SESSION['lastname']; ?></li>
	<li class="">Adress : {{UserAdress}}</li>
	<li class="">Nombre de livre emprunter : <?php echo $_SESSION['loan_number']; ?></li>
	<li class="">Date de naissance : {{UserBDate}}</li>
	<li class="">Email : {{UserEmail}}</li>
</ul>