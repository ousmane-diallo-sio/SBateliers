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
	$mdp = $_POST[ 'mdp' ];
	
	try {

		$cipher = "aes-128-cbc";
		$key = "chiffrement";
		$iv = "123456";

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
			 . 'where email = :email';
			 
		$st = $bd -> prepare( $sql ) ;
		
		$st -> execute( array( 
								':email' => $email 
						) 
					) ;
		$resultat = $st -> fetchall() ;
			
		unset( $bd ) ;
		
		if( count( $resultat ) == 1 && password_verify($mdp, $resultat[0]['mdp']) ) {
			session_start() ;

			$_SESSION[ 'numero' ] = $resultat[0]['numero'] ;
			$_SESSION[ 'nom' ] = openssl_decrypt($resultat[0]['nom'], $cipher, $key, 0, $iv) ;
			$_SESSION[ 'prenom' ] = openssl_decrypt($resultat[0]['prenom'], $cipher, $key, 0, $iv) ;
			$_SESSION[ 'civilite' ] = $resultat[0]['civilite'] ;
			$_SESSION[ 'date_de_naissance' ] = $resultat[0]['date_de_naissance'] ;
			$_SESSION[ 'code_postal' ] = $resultat[0]['code_postal'] ;
			$_SESSION[ 'adresse' ] = openssl_decrypt($resultat[0]['adresse'], $cipher, $key, 0, $iv) ;
			$_SESSION[ 'ville' ] = openssl_decrypt($resultat[0]['ville'], $cipher, $key, 0, $iv) ;
			$_SESSION[ 'numero_tel' ] = openssl_decrypt($resultat[0]['numero_tel'], $cipher, $key, 0, $iv) ;
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