<?php session_start(); ?>


<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Liste ateliers</title>
		
		<link rel="stylesheet" href="../src/css/styles.css"/>
		
	</head>



	<body>
		
		<?php include '../composants/bar-de-navigation.php'; ?>
		
		<div style="text-align:center">
			<h2>Bienvenue <?php echo $_SESSION['prenom'] ?> </h2>
			<h4>[<?php echo $_SESSION["logContent"]; ?>]</h4>
			<div style="text-align: left">
				<h4>Adresse IP : <?php echo $_SERVER['REMOTE_ADDR']; ?></h4>
				<h4>Client HTTP : <?php echo $_SERVER['HTTP_USER_AGENT']; ?> </h4>
				<h4>Date de connexion : <?php echo $_SESSION['datetimeAuth']; ?> </h4>
			</div>
		</div>
		
	</body>


</html>
