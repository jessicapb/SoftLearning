-- Nom de la base de dades
softlearning

-- Nom de l'usuari
jessica 

-- Contrasenya
Joquese2024

-- Crear la taula client
CREATE TABLE client (
    nom varchar (240) not null,
    cognom varchar (240) not null,
    email varchar (240) not null,
    telefon varchar (240) not null,
    adreca varchar(240) not null,
    aniversari date not null,
    soci int not null,
    pagament varchar(240)not null,
    PRIMARY KEY (soci)
);

-- Crear la taula Empresa client
CREATE TABLE clientcompany(
    nom varchar(240) not null,
    cognom varchar(240) not null,
    email varchar(240) not null,
    telefon varchar(240) not null,
    adreca varchar(240) not null,
    antiguitat date not null,
    empresa int not null,
    pagament varchar(240) not null,
    treballador int not null,
    entitat varchar(240) not null,
    PRIMARY KEY(empresa)
);

-- Crear la taula empleat
CREATE TABLE employee(
    nom varchar(240) not null,
    cognoms varchar(240) not null,
    email varchar(240) not null,
    telefon varchar(240) not null,
    adreca varchar(240) not null,
    antiguitat date not null,
    treballador int not null,
    departament varchar(240) not null,
    horari varchar(240) not null,
    banc int not null,
    PRIMARY KEY(treballador)
);

-- Crear la taula proveidor
CREATE TABLE provider(
    nom varchar(240) not null,
    cognom varchar(240) not null,
    email varchar(240) not null,
    telefon varchar(240) not null,
    adreca varchar(240) not null,
    antiguitat date not null,
    proveidor int not null,
    treballa varchar(240) not null,
    treballador int not null,
    entitat varchar(240) not null,
    PRIMARY KEY(proveidor)
);

-- Crear la taula llibres
CREATE TABLE book(
	Codi int not null,
    Preu float not null,
    Descripcio varchar(240) not null,
    Autor varchar(240) not null,
    Titol varchar(240) not null,
    Tapa varchar(240) not null,
    Pagines int not null,
    Genere varchar(240) not null,
    Editorial varchar(240) not null,
    ISBN varchar(240) not null,
    Altura float not null,
    Amplada float not null,
    Longitud float not null,
    Pes int not null,
    PRIMARY KEY (Codi)
);

-- Crear la taula cursos
CREATE TABLE Courses(
    codi int not null,
    preu float not null,
    descripcio varchar(240) not null,
    hores int not null,
    departament varchar(240) not null,
    PRIMARY KEY(codi)
);

