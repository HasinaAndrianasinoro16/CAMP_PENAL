create database camppenal;
\c camppenal

-- user creer par la fonctionnalite de breeze
-- ajout de la table user type pour l'authentification et pour l'acces au site 0 pour Admin 1 pour dirap et 2 pour ministere

--les differents type de sol a madagascar favorable au culture
alter table users add column imatricule varchar(50);
create table sol(
    id serial primary key,
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

ALTER TABLE users ADD COLUMN province INT;
ALTER TABLE users ADD CONSTRAINT fk_province FOREIGN KEY (province) REFERENCES province(id);

--les poste possible
-- create table position(
--     id serial primary key,
--     nom varchar(50)
-- );
-- alter table users add column usertype int;
-- alter table users add constraint fk_position FOREIGN key (position) references position(id);

-- --les utilisateurs par province
-- create table ProvinceUtilisateur(
--     id serial,
--     users int references users(id),
--     province int references province(id)
-- );

--liste des camp penal
create sequence seqcamp increment by 1; 
create table camp(
    id varchar(255) primary key,
    nom varchar(50),
    supeficie numeric(10,2),
    province int references province(id),
    lattitude decimal,
    longitude decimal
);
ALTER TABLE camp ADD COLUMN sol INT;
ALTER TABLE camp ADD CONSTRAINT fk_sol FOREIGN KEY (sol) REFERENCES sol(id);

-- liste des cultures stocke en general
create table stockculture(
    id serial primary key,
    culture varchar(50) references culture(id),
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

INSERT INTO sol (nom) VALUES
('Argileux'),
('Limoneux'),
('Sableux'),
('Volcaniques'),
('Tourbeux'),
('Alluviaux'),
('Argilo-sableux');
--============================== View et fonction ===============================
create or replace View v_user as 
select 
    u.id,
    u.name,
    u.email,
    u.password,
    u.usertype,
    case
        when usertype < 1 then 'Administrateur'
        when usertype = 1 then 'D.I.R.A.P'
        when usertype > 1 then 'Agent du ministere'
        else null
    end as position,
    u.province as is_province,
    p.nom as province,
    u.imatricule as matricule
from users u
join province p on p.id = u.province;

create or replace view v_camp as
select 
    c.id,
    c.nom,
    c.supeficie as superficie,
    c.province as id_province,
    p.nom as province,
    s.nom as sol,
    s.id as id_sol,
    c.lattitude as lat,
    c.longitude as lng
from camp c
join sol s on s.id = c.sol
join province p on p.id = c.province;