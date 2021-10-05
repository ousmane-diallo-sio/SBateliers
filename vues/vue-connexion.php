<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Connexion</title>
		
		<link rel="stylesheet" href="../src/css/styles.css"/>
		
	</head>



	<body>

		<?php 
			$lienPage = $_SERVER["REQUEST_URI"];
			$identifiant = explode("login=", $lienPage);

		?>
		
		<form action="../controleurs/ctrl-connecter.php" method="POST" style="display:flex; flex-direction:column;" >
			<label>Identifiant</label>
			<input name="email" type="email" value="<?php echo $identifiant[1]; ?>" />
			<label>Mot de passe</label>
			<input name="mdp" type="password" /> </br>
			<button type="submit">Se connecter</button>
		</form>
		
	</body>


</html>
