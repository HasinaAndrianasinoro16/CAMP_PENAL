create database camppenal;
\c camppenal

-- user creer par la fonctionnalite de breeze
-- ajout de la table user type pour l'authentification et pour l'acces au site

--les differents type de sol a madagascar favorable au culture
create table sol(
    id serial primary key
    nom varchar(50)
);

-- liste des cultures pouvant etre planter dans un sol donnees
create sequence seqculture increment by 1;
create table culture(
    id varchar(255) primary key,
    nom varchar(50),
    prixunitaire numeric(10,2),
    sol int references sol(id)
);

--les provinces de madagascar
create table province(
    id serial primary key,
    nom varchar(50)
);

--les utilisateurs par province
create table ProvinceUtilisateur(
    id serial,
    users int references users(id),
    province int references province(id)
);

--liste des camp penal
create sequence seqcamp increment by 1; 
create table camp(
    id varchar(255),
    nom varchar(50),
    supeficie numeric(10,2),
    province int references province(id),
    longitude decimal,
    lattitude decimal
);

-- liste des cultures stocke en general
create table stockculture(
    id serial primary key,
    culture(id),
    quantite numeric(10,2), --en kilogramme
    datestock date,
    etat int -- 0 pour entrer et 1 pour sortie // la quantite sortie represente les cultures donnees pour etre revendue tandis que l'entrer sont les cultures destine a etre consomner par les prisonniers
);


--liste des culture existant par camp
create table campculture(
    id serial,
    camp varchar(255) references camp(id),
    stock int references stockculture(id)
);

--=========================== INSERTION==============================
INSERT INTO province (nom) VALUES
('Antananarivo'),
('Toamasina'),
('Antsiranana'),
('Mahajanga'),
('Fianarantsoa'),
('Toliara');
--============================== View et fonction ===============================