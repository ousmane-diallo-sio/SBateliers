<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Profil</title>
		
		<link rel="stylesheet" href="../src/css/styles.css"/>

	</head>



	<body>

        <?php include '../composants/bar-de-navigation.php'; ?>

		
		<div style="display:flex; flex-direction:column;">

            <p>Nom : <?php echo $_SESSION['nom']; ?> </p>
            <p>Prenom : <?php echo $_SESSION['prenom']; ?> </p>
            <p>Civilite : <?php echo $_SESSION['civilite']; ?> </p>
            <p>Date de naissance : <?php echo $_SESSION['date_de_naissance']; ?> </p>
            <p>Code postal : <?php echo $_SESSION['code_postal']; ?> </p>
            <p>Adresse : <?php echo $_SESSION['adresse']; ?> </p>
            <p>Ville : <?php echo $_SESSION['ville']; ?> </p>
            <p>Numero de téléphone : <?php echo $_SESSION['numero_tel']; ?> </p>
            <p>Adresse email : <?php echo $_SESSION['email']; ?> </p>


        </div>
		
	</body>


</html>
