<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Connexion</title>
		
		<link rel="stylesheet" href="../src/css/styles.css"/>
		
	</head>



	<body>
		
		<form action="../controleurs/ctrl-connecter.php" method="POST" style="display:flex; flex-direction:column;" >
			<label>Identifiant</label>
			<input name="email" type="email" />
			<label>Mot de passe</label>
			<input name="mdp" type="password" /> </br>
			<button type="submit">Se connecter</button>
		</form>
		
	</body>


</html>
