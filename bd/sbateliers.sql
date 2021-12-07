drop database if exists sbateliers;
create database sbateliers;

use sbateliers;


drop table if exists Client;

create table Client(
	numero int primary key auto_increment,
	civilite varchar(8),
	nom varchar(30),
	prenom varchar(30),
	date_de_naissance date,
	email varchar(50) unique,
	mdp varchar(30),
	adresse varchar(50),
	code_postal int,
	ville varchar(20),
	numero_tel int
);


create table Responsable_Atelier(
	numero int,
	nom_de_connexion varchar(40),
	nom varchar(30),
	prenom varchar(30),
	mdp varchar(40)
);


create table Atelier(
	numero int primary key,
	date_enregistrement date,
	date_et_heure_prevue datetime,
	duree time,
	nb_places int,
	theme varchar(70)
);


create table Participation(
	numero_atelier int,
	numero_client int,
	foreign key (numero_atelier) references Atelier(numero)
	on update cascade
	on delete cascade,
	foreign key (numero_client) references Client(numero)
	on update cascade
	on delete cascade,
	primary key (numero_atelier, numero_client),
	date_inscription date
);

