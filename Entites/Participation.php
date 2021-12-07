<?php

class Participation{

    private $numero_atelier;
    private $numero_client;
    private $date_inscription;

    public function __construct(){

    }


    public static function getListeParticipantsParAtelier($numAtelier){
		
        try{
    
            $bd = new PDO(
                            'mysql:host=localhost;dbname=sbateliers',
                            'sanayabio',
                            'sb2021'
            );
    
            $sql = 'select numero, nom, prenom, ville from Client c inner join Participation p on c.numero = p.numero_client where numero_atelier = :numAtelier;';
    
            $st = $bd->prepare($sql);
    
            $st->execute( array(
                        ':numAtelier' => $numAtelier,
                        ) 
            );
    
            $resultat = $st->fetchall();
    
            unset($bd);
    
    
            if( count( $resultat == 1 ) ){
                return $resultat;
            }
    
    
        }
        catch(PDOException $e){
            print_r($e);
        }
    
    }


}


?>