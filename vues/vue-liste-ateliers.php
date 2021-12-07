<?php session_start(); ?>


<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Liste ateliers</title>
		
		<link rel="stylesheet" href="../src/css/styles.css"/>
		
	</head>



	<body>
		
		<?php include '../composants/bar-de-navigation.php'; ?>
		
		<div style="display: flex; flex-direction: column; text-align: center; align-items: center">
			<h2>Bienvenue <?php echo $_SESSION['prenom'] ?> </h2>

				<p>Liste des ateliers disponibles :</p>

				<table>

					<thead>
						<td>Numéro</td>
						<td>Date enregistrement</td>
						<td>Date et heure prévue</td>
						<td>Durée</td>
						<td>Nombre de places</td>
						<td>Thème</td>
					</thead>

					<tbody>
						<?php
							foreach($_SESSION['listeAteliers'] as $atelier){
								
								echo "<tr>";
									echo "<td>" .$atelier['numero'] ."</td>";
									echo "<td>" .$atelier['date_enregistrement'] ."</td>"; 
									echo "<td>" .$atelier['date_et_heure_prevue'] ."</td>"; 
									echo "<td>" .$atelier['duree'] ."</td>"; 
									echo "<td>" .$atelier['nb_places'] ."</td>"; 
									echo "<td>" .$atelier['theme'] ."</td>"; 
								echo "</tr>";

							}
						?>
					</tbody>
					
				</table>

				<?php print_r( "Liste participants : " . Participation::getListeParticipantsParAtelier(1) ); ?>



			<div style="text-align: left; color:#0005">
				<h4>[<?php echo $_SESSION["logContent"]; ?>]</h4>
				<h4>Adresse IP : <?php echo $_SERVER['REMOTE_ADDR']; ?></h4>
				<h4>Client HTTP : <?php echo $_SERVER['HTTP_USER_AGENT']; ?> </h4>
				<h4>Date de connexion : <?php echo $_SESSION['datetimeAuth']; ?> </h4>
				<h4>HTTP REFERER : <?php echo $_SERVER['HTTP_REFERER']; ?> </h4>
			</div>
		</div>
		
	</body>


</html>
