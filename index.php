<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Accueil</title>
		
		<link rel="stylesheet" href="./src/css/styles.css">

	</head>



	<body>
		
		<div style="display:flex; flex-direction:column;">
			<a href="./vues/vue-connexion.php">Se connecter</a>
			<a href="./vues/vue-enregistrement-client.php">Créer un compte client</a>
			<a href="./vues/testER.php">Test expressions régulières</a>

		</div>

		<?php
		
			$styleErreur = 'color:red; background-color:#fee; border-radius:5%';

			switch($_SERVER['REQUEST_URI']){
				case "/sbateliers/index.php?echec=1" :
					echo "<p style='$styleErreur'>L'identifiant ou le mot de passe est incorrect.</p>";
					break;
				case "/sbateliers/index.php?echec=0":
					echo "<p style='$styleErreur'>Erreur lors de la tentative de connexion.</p>";
					break;
			}

		?>
		
	</body>


</html>
