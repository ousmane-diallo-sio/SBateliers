<?php

class Commentaire{

    private $idAtelier;
    private $idClient;
    private $numComm;
    private $saisie;
    private $datePublication;

    public function __construct(Atelier $idAtelier, Client $idClient, int $numComm, string $saisie, DateTime $datePublication){
        $this->idAtelier = $idAtelier;
        $this->idClient = $idClient;
        $this->numComm = $numComm;
        $this->saisie = $saisie;
        $this->datePubliation = $datePublication;
    }

    

    public function getIdAtelier()
    {
        return $this->idAtelier;
    }

    public function setIdAtelier($idAtelier)
    {
        $this->idAtelier = $idAtelier;

        return $this;
    }


    public function getIdClient()
    {
        return $this->idClient;
    }

    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }


    public function getNumComm()
    {
        return $this->numComm;
    }

    public function setNumComm($numComm)
    {
        $this->numComm = $numComm;

        return $this;
    }


    public function getSaisie()
    {
        return $this->saisie;
    }

    public function setSaisie($saisie)
    {
        $this->saisie = $saisie;

        return $this;
    }


    public function getDatePublication()
    {
        return $this->datePublication;
    }

    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }
}

?>