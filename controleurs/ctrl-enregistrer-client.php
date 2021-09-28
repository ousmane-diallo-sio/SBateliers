<?php


	$nom = $_POST[ 'nom' ] ;
	$prenom = $_POST[ 'prenom' ];
	$civilite = $_POST[ 'civilite' ];
	$date_de_naissance = $_POST[ 'date_de_naissance' ];
	$code_postal = $_POST[ 'code_postal' ];
	$ville = $_POST[ 'ville' ];
	$numero_tel = $_POST[ 'numero_tel' ];
	$email = $_POST[ 'email' ] ;
	$adresse = $_POST[ 'adresse' ];
	
	$login = $_POST[ 'email' ] ;
	$mdp = $_POST[ 'mdp' ] ;


	$datetime = new DateTime();
	$dateHeure = $datetime->format('D-m-y H:i:s');

	$ipClient = $_SERVER['REMOTE_ADDR'];
	$navigateurClient = $_SERVER['HTTP_USER_AGENT'];

	if(preg_match("/[0-9]{10}/", $numero_tel)){
		if ( preg_match("/([0-9]{5})|([0-9].)/", $code_postal) ){
      
		
			try {
	
				$bd = new PDO(
								'mysql:host=localhost;dbname=sbateliers' ,
								'sanayabio' ,
								'sb2021'
					) ;
					
				$sql = 'insert into Client(civilite, nom, prenom, date_de_naissance, email, mdp, adresse,' 
					 .'code_postal, ville, numero_tel) values ('
					 .':civilite, :nom, :prenom, :date_de_naissance, :email, :mdp,'
					 .':adresse, :code_postal, :ville, :numero_tel'
					 .')';
					 
				$st = $bd -> prepare( $sql ) ;
				
				$st -> execute( array( 
										':civilite' => $civilite,
										':nom' => $nom,
										':prenom' => $prenom,
										':date_de_naissance' => $date_de_naissance,
										':email' => $email,
										':mdp' => $mdp,
										':adresse' => $adresse,
										':code_postal' => $code_postal,
										':ville' => $ville,
										':numero_tel' => $numero_tel 
								) 
							) ;
				$resultat = $st -> fetchall() ;
				
					
				unset( $bd ) ;
				
				if( count( $resultat ) == 0 ) {
					session_start() ;
					$_SESSION[ 'nom' ] = $resultat[0]['nom'] ;
					$_SESSION[ 'prenom' ] = $resultat[0]['prenom'] ;
					$_SESSION[ 'date_de_naissance' ] = $resultat[0]['date_de_naissance'] ;
					$_SESSION[ 'email' ] = $resultat[0]['email'] ;
					$_SESSION[ 'login' ] = $resultat[0]['login'] ;
					$_SESSION[ 'mdp' ] = $resultat[0]['mdp'] ;
					$_SESSION[ 'adresse' ] = $resultat[0]['adresse'] ;
					$_SESSION[ 'code_postal' ] = $resultat[0]['code_postal'] ;
					$_SESSION[ 'ville' ] = $resultat[0]['ville'] ;
					$_SESSION[ 'numero_tel' ] = $resultat[0]['numero_tel'] ;
								
					header( 'Location: ../index.php');
					exit();
				} 
				else {
					header('Location: ../index.php?echec=1&login=' .$login);
					}
		
			}
			catch( PDOException $e ){
				
				header( 'Location: ../index.php' );
			}
	
		}
		else{
			$logContent = "$ipClient | $dateHeure | inscription-client | code_postal | $code_postal\n";
			file_put_contents("/var/log/sbateliers/err_input.log", $logContent, FILE_APPEND);
			header('Location: ../vues/vue-enregistrement-client.php?echec=code_postal');
		}

	}
	else{
		$logContent = "$ipClient | $dateHeure | inscription-client | numero_tel | $numero_tel\n";
		file_put_contents("/var/log/sbateliers/err_input.log", $logContent, FILE_APPEND);

		header('Location: ../vues/vue-enregistrement-client.php?echec=numero_tel');
	}
		
	
	
	?>
	
