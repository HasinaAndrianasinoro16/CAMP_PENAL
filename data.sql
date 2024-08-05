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
-- create sequence seqculture increment by 1;
create table culture(
    id varchar(255) primary key,
    nom varchar(50),
    prixunitaire numeric(10,2),
    sol int references sol(id)
);

-- create table culture(
--     id varchar(255) primary key,
--     nom varchar(50),
--     prix numeric(10,2),
--     sol int references sol(id)
-- );

alter table culture add column supeficie decimal;
--les provinces de madagascar
create table province(
    id serial primary key,
    nom varchar(50)
);

ALTER TABLE users ADD COLUMN province INT;
ALTER TABLE users ADD CONSTRAINT fk_province FOREIGN KEY (province) REFERENCES province(id);

create table collaborateur(
    id serial primary key,
    nom varchar(50)
);

create table materiel(
    id serial primary key,
    nom varchar(255),
    durer int 
);


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
--liste des situations juridique
create table situation(
    id serial primary key,
    nom varchar(255)
);
--liste des camp penal
create sequence seqcamp increment by 1; 
create table camp(
    id varchar(255) primary key,
    nom varchar(50),
    province int references province(id),
    lattitude decimal,
    longitude decimal
);
-- alter table camp add column cultivable decimal;
-- alter table camp add column ncultivable decimal;
ALTER TABLE camp ADD COLUMN sol INT;
ALTER TABLE camp ADD CONSTRAINT fk_sol FOREIGN KEY (sol) REFERENCES sol(id);
-- alter table camp add column situation int;
-- alter table camp add constraint fk_situation FOREIGN key (situation) references situation(id);

--detail en plus de chaque camp
create table more(
    id serial,
    camp varchar(255) references camp(id),
    situation int references situation(id),
    distance varchar(255),
    cultivable decimal,
    ncultivable decimal,
    litige decimal
);

create table don (
    id serial,
    collaborateur int references collaborateur(id),
    camp varchar(255) references camp(id),
    materiel int references materiel(id) , --argent,tracteur,brouette,...
    quantite numeric(10,2),
    datedon date
);


create table CampCollab (
    id serial,
    camp varchar(255) references camp(id),
    collaborateur int references collaborateur(id),
    details varchar(255),
    debut date,
    fin date
);

-- liste des cultures stocke en general
create table stockculture(
    id serial primary key,
    camp varchar(50) references camp(id),
    culture varchar(50) references culture(id),
    quantite numeric(10,2), --en kilogramme
    datestock date,
    etat int -- 0 pour entrer et 1 pour sortie // la quantite sortie represente les cultures donnees pour etre revendue tandis que l'entrer sont les cultures destine a etre consomner par les prisonniers
);


--liste des culture existant par camp
create table campculture(
    id serial,
    camp varchar(255) references camp(id),
    culture varchar(50) references culture(id),
    superficie decimal
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

INSERT INTO culture (id, nom, prixunitaire, sol) VALUES
('1', 'Riz', 700000, 6),
('2', 'Maïs', 650000, 3),
('3', 'Manioc', 600000, 7),
('4', 'Patate douce', 550000, 3),
('5', 'Haricot', 750000, 2),
('6', 'Tomate', 1200000, 2),
('7', 'Pomme de terre', 900000, 2),
('8', 'Carotte', 800000, 1),
('9', 'Oignon', 700000, 1),
('10', 'Aubergine', 850000, 2),
('11', 'Chou', 950000, 1),
('12', 'Laitue', 1000000, 2),
('13', 'Courgette', 800000, 2),
('14', 'Épinard', 700000, 5),
('15', 'Piment', 1500000, 4),
('16', 'Gingembre', 2000000, 5),
('17', 'Ail', 2500000, 2),
('18', 'Ananas', 3000000, 4),
('19', 'Banane', 2000000, 4),
('20', 'Papaye', 2500000, 4);



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
        when usertype = 1 then 'D.R.A.P'
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
    c.province as id_province,
    p.nom as province,
    s.nom as sol,
    s.id as id_sol,
    c.lattitude as lat,
    c.longitude as lng,
    coalesce((select SUM(cc.superficie) 
     from campculture cc 
     where cc.camp = c.id),0) as superficie
from camp c
join sol s on s.id = c.sol
join province p on p.id = c.province;


create or replace view v_campculture as
select
    cc.id as is_campculture,
    cc.camp as id_camp,
    c.nom as camp,
    cc.culture as id_culture,
    cu.nom as culture,
    cc.superficie
from campculture cc
join camp c on c.id = cc.camp
join culture cu on cu.id = cc.culture;

create or replace view v_culture as
select
    cl.id as id_culture,
    cl.nom as culture,
    cl.sol as id_sol,
    s.nom as sol
from culture cl
join sol s on s.id = cl.sol;

CREATE OR REPLACE VIEW v_materiel AS
SELECT 
    d.materiel AS id_materiel,
    m.nom AS materiel,
    d.camp,
    (select province from camp where id = d.camp),
    COUNT(d.materiel) AS nombre,
    m.durer AS durer
FROM don d
JOIN materiel m ON m.id = d.materiel
GROUP BY d.materiel, m.nom, d.camp, m.durer;



create or replace view v_don as
select 
    d.materiel as id_materiel,
    m.nom as materiel,
    d.collaborateur as id_colab,
    c.nom as colab,
    d.camp as id_camp,
    cm.nom as camp,
    (select province from camp where id = d.camp),
    d.quantite,
    d.datedon
from don d
join materiel m on m.id = d.materiel
join collaborateur c on c.id = d.collaborateur
join camp cm on cm.id = d.camp;

create or replace view v_campcollab as
select 
    cc.camp as id_camp,
    cm.nom as camp,
    cc.collaborateur as id_colab,
    cl.nom as colab,
    cc.details,
    cc.debut,
    cc.fin
from campcollab cc
join collaborateur cl on cl.id = cc.collaborateur
join camp cm on cm.id = cc.camp;

create or replace view Etatstock as
select
    sc.id as id_stock,
    sc.camp as id_camp,
    cm.nom as camp,
    cm.province,
    sc.culture as id_culture,
    c.nom as culture,
    sc.quantite,
    sc.datestock,
    sc.etat
from stockculture sc
join camp cm on cm.id = sc.camp
join culture c on c.id = sc.culture;


CREATE or replace VIEW moyenne_stocks AS
SELECT
    id_camp,
    camp,
    culture,
    AVG(quantite) AS moyenne_quantite
FROM
    etatstock
where etat = 0
GROUP BY
    camp, culture, id_camp;
