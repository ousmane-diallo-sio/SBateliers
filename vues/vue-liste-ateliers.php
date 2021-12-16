<?php session_start(); ?>

<?php 

function getListeParticipantsParAtelier($numAtelier){
		
	try{

		$bd = new PDO(
						'mysql:host=localhost;dbname=sbateliers',
						'sanayabio',
						'sb2021'
		);

		$sql = 'select numero from Client c inner join Participation p on c.numero = p.numero_client where numero_atelier = :numAtelier;';

		$st = $bd->prepare($sql);

		$st->execute( array(
					':numAtelier' => $numAtelier,
					) 
		);

		$resultat = $st->fetchall();

		unset($bd);


		if( count( $resultat == 1 ) ){
			return $resultat[0];
		}


	}
	catch(PDOException $e){
		print_r($e);
	}

}

?>

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
						<td>Action</td>
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
									if( in_array($_SESSION['numero'], getListeParticipantsParAtelier($atelier['numero'])) ){
										echo "<td><a href='/'>Commenter</a></td>";
									} else{
										echo "<td><a href='/'>Participer</a></td>";
									}
								echo "</tr>";

							}
						?>
					</tbody>
					
				</table>


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
