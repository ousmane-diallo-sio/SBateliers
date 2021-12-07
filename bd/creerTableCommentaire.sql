create table Commentaire(
	idComm int,
	idClient int,
	idAtelier int,
	saisie varchar(500),
	datePublication datetime,
	foreign key (idClient) references Client(numero)
	on update cascade
	on delete cascade,
	foreign key idAtelier references Atelier(numero)
	on update cascade
	on delete cascade,
	primary key(idClient, idComm, idAtelier)
);

