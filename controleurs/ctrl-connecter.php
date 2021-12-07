<?php 

	$datetime = new DateTime();
	$dateHeure = $datetime->format('D-m-y H:i:s');

?>


<?php 

	function getListeAteliers(){


		try{

			$bd = new PDO(
							'mysql:host=localhost;dbname=sbateliers',
							'sanayabio',
							'sb2021'
			);

			$sql = 'select * from Atelier';

			$st = $bd->prepare($sql);

			$st->execute();

			$listeAteliers = $st->fetchall();

			unset($bd);


			if( count( $listeAteliers == 1 ) ){
				return $listeAteliers;
			}


		}
		catch(PDOException $e){
			$errorLog = "/var/log/sbateliers/error.log";

			$errorLogData = "$dateHeure | $e | vue-connexion.php\n";

			file_put_contents($errorLog, $errorLogData, FILE_APPEND);
		}


	} 
?>



<?php
	
	$email = $_POST[ 'email' ] ;
	//$mdp = password_hash( $_POST[ 'mdp' ], PASSWORD_DEFAULT );
	$mdp = $_POST[ 'mdp' ];
	
	try {

		$logFile = "/var/log/sbateliers/access.log";

		$ipClient = $_SERVER['REMOTE_ADDR'];
		$navigateurClient = $_SERVER['HTTP_USER_AGENT'];

		

		$bd = new PDO(
						'mysql:host=localhost;dbname=sbateliers' ,
						'sanayabio' ,
						'sb2021'
			) ;
			
		$sql = 'select * '
			 . 'from Client '
			 . 'where email = :email '
			 . 'and mdp = :mdp' ;
			 
		$st = $bd -> prepare( $sql ) ;
		
		$st -> execute( array( 
								':email' => $email ,
								':mdp' => $mdp 
						) 
					) ;
		$resultat = $st -> fetchall() ;
			
		unset( $bd ) ;
		
		if( count( $resultat ) == 1 ) {
			session_start() ;
			$_SESSION[ 'numero' ] = $resultat[0]['numero'] ;
			$_SESSION[ 'nom' ] = $resultat[0]['nom'] ;
			$_SESSION[ 'prenom' ] = $resultat[0]['prenom'] ;
			$_SESSION[ 'civilite' ] = $resultat[0]['civilite'] ;
			$_SESSION[ 'date_de_naissance' ] = $resultat[0]['date_de_naissance'] ;
			$_SESSION[ 'code_postal' ] = $resultat[0]['code_postal'] ;
			$_SESSION[ 'adresse' ] = $resultat[0]['adresse'] ;
			$_SESSION[ 'ville' ] = $resultat[0]['ville'] ;
			$_SESSION[ 'numero_tel' ] = $resultat[0]['numero_tel'] ;
			$_SESSION[ 'email' ] = $email ;
			$_SESSION['datetimeAuth'] = $datetime->format('D-m-y H:i:s');
			$_SESSION['listeAteliers'] = getListeAteliers();


			$resultatAuth = 'Ok';
			$logContent = "$ipClient | $dateHeure | $email | $resultatAuth | $navigateurClient\n";
			$_SESSION[ 'logContent' ] = $logContent;
			file_put_contents($logFile, $logContent, FILE_APPEND);


			header( 'Location: ../vues/vue-liste-ateliers.php' ) ;
		}
		else {
			$resultatAuth = "Nok";
			$logContent = "$ipClient | $dateHeure | $email | $resultatAuth | $navigateurClient\n";
			file_put_contents($logFile, $logContent, FILE_APPEND);


			header( 'Location: ../index.php?echec=1') ;
		}
	}
	catch( PDOException $e ){
		
		$resultatAuth = "Nok";
		
		$errorLog = "/var/log/sbateliers/error.log";

		$errorLogData = "$dateHeure | $e | vue-connexion.php\n";

		file_put_contents($errorLog, $errorLogData, FILE_APPEND);
				
		header( 'Location: ../index.php?echec=0' ) ;
	}

?>