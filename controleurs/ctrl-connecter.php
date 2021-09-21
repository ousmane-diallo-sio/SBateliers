<?php
	
	$email = $_POST[ 'email' ] ;
	$mdp = $_POST[ 'mdp' ] ;
	
	try {
		$datetime = new DateTime();
		$resultatAuth = null;

		$logFile = fopen('/var/log/sbateliers/access.log');
		$logContent = $_SERVER['REMOTE_ADDR'] ." | $datetime->format('D-m-y H:i:s') | $email | $resultatAuth | " .$_SERVER['HTTP_USER_AGENT'];


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

			$resultatAuth = "Ok";
			fputs($logFile , $logContent);
			fclose($logFile);

			header( 'Location: ../vues/vue-liste-ateliers.php' ) ;
		}
		else {
			$resultatAuth = "Nok";
			fputs($logFile , $logContent);
			fclose($logFile);

			header( 'Location: ../index.php?echec=1') ;
		}
	}
	catch( PDOException $e ){
		
		$resultatAuth = "Nok";
		fputs($logFile , $logContent);
		fclose($logFile);
		header( 'Location: ../index.php?echec=0' ) ;
	}

?>