<?php 

    session_start();

	$login = $_SESSION[ 'email' ] ;
	
	session_unset() ;
	session_destroy() ;
	
	header( 'Location: ../vues/vue-connexion.php?login=' .$login ) ;

?>