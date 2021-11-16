<?php


class ResponsableAtelier{

    private $numero;
    private $nom_de_connexion;
    private $nom;
    private $prenom;
    private $mdp;


    public function __construct(){

    }

    public function progAtelier($date_enregistrement, $date_et_heure_prevue, $duree, $nb_places, $theme){
        
        try {
	
            $bd = new PDO(
                            'mysql:host=localhost;dbname=sbateliers' ,
                            'sanayabio' ,
                            'sb2021'
                ) ;
                
            $sql = 'insert into Client values (null, date_enregistrement, date_et_heure_prevue, duree, nb_places, theme)';

            $st = $bd -> prepare( $sql ) ;
         
            $st -> execute( array( 
                                    ':date_enregistrement' => $date_enregistrement,
                                    ':date_et_heure_prevue' => $date_et_heure_prevue,
                                    ':duree' => $duree,
                                    ':nb_places' => $nb_places
                            ) 
                        ) ;
            $resultat = $st -> fetchall() ;
            
            
            unset( $bd ) ;
            
            return $resultat;
            
        }
        catch( PDOException $e ){
            print_r($e);
        }

    }

}

$ra = new ResponsableAtelier();
$ra->progAtelier("2021-10-20", "2022-01-25", "01:30", 106, "Jeux vidéo");


?>