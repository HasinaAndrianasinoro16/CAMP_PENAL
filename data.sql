create database camppenal;
\c camppenal

-- user creer par la fonctionnalite de breeze
-- ajout de la table user type pour l'authentification et pour l'acces au site 0 pour Admin 1 pour dirap et 2 pour ministere

--les differents type de sol a madagascar favorable au culture
alter table users add column imatricule varchar(50);
alter table users add column usertype integer;
create table sol(
    id serial primary key,
    nom varchar(50)
);

-- liste des cultures pouvant etre planter dans un sol donnees
create sequence seqculture increment by 1;
create table culture(
    id varchar(255) primary key,
    nom varchar(50),
    prixunitaire decimal,
    sol int references sol(id)
);

-- create table culture(
--     id varchar(255) primary key,
--     nom varchar(50),
--     prix numeric(10,2),
--     sol int references sol(id)
-- );

-- alter table culture add column supeficie decimal;
--les provinces de madagascar
create table province(
    id serial primary key,
    nom varchar(50)
);

create table region(
    id serial primary key,
    nom varchar(255)
);

ALTER TABLE users ADD COLUMN province INT;
ALTER TABLE users ADD CONSTRAINT fk_province FOREIGN KEY (province) REFERENCES province(id);

ALTER TABLE users add column region int;
alter table users add constraint fk_region FOREIGN key (region) references region(id);

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
    nom varchar(255) unique
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
-- alter table camp add column etablissement varchar(255)

--detail en plus de chaque camp
create table more(
    id serial,
    camp varchar(255) references camp(id) unique,
    situation int references situation(id),
    distance varchar(255),
    cultivable decimal,
    ncultivable decimal,
    litige decimal
);
ALTER TABLE more ADD COLUMN region INT;
ALTER TABLE more ADD CONSTRAINT fk_region FOREIGN KEY (region) REFERENCES region(id);

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
alter table stockculture add column prisonnier integer;

--liste des culture existant par camp
create table campculture(
    id serial,
    camp varchar(255) references camp(id),
    culture varchar(50) references culture(id),
    superficie decimal
);

create table messages (
    id serial primary key,
    from_id int references users(id),
    to_id int references users(id),
    created_at timestamp,
    content varchar(500),
    read_at timestamp
);

CREATE TABLE stock_estimation (
    id SERIAL PRIMARY KEY,
    camp VARCHAR(50) references camp(id) ,
    culture varchar(50) references culture(id),
    nom VARCHAR(50) ,
    quantite NUMERIC(10, 2) ,
    estimation NUMERIC(20, 4) ,
    datestock DATE ,
    etat INT 
);

create table importcamp(
    id serial primary key,
    nom varchar(50),
    province varchar(50),
    lattitude decimal,
    longitude decimal,
    sol varchar(50),
    situation varchar(50),
    distance varchar(50),
    cultivable decimal,
    ncultivable decimal,
    litige decimal,
    region varchar(55)
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

INSERT INTO region (nom) VALUES ('Analamanga');
INSERT INTO region (nom) VALUES ('Vakinankaratra');
INSERT INTO region (nom) VALUES ('Itasy');
INSERT INTO region (nom) VALUES ('Bongolava');
INSERT INTO region (nom) VALUES ('Haute Matsiatra');
INSERT INTO region (nom) VALUES ('Amoron''i Mania');
INSERT INTO region (nom) VALUES ('Vatovavy Fitovinany');
INSERT INTO region (nom) VALUES ('Atsimo Atsinanana');
INSERT INTO region (nom) VALUES ('Ihorombe');
INSERT INTO region (nom) VALUES ('Menabe');
INSERT INTO region (nom) VALUES ('Atsimo Andrefana');
INSERT INTO region (nom) VALUES ('Androy');
INSERT INTO region (nom) VALUES ('Anosy');
INSERT INTO region (nom) VALUES ('Alaotra Mangoro');
INSERT INTO region (nom) VALUES ('Betsiboka');
INSERT INTO region (nom) VALUES ('Boeny');
INSERT INTO region (nom) VALUES ('Sofia');
INSERT INTO region (nom) VALUES ('Diana');
INSERT INTO region (nom) VALUES ('Sava');
INSERT INTO region (nom) VALUES ('Analanjirofo');
INSERT INTO region (nom) VALUES ('Atsinanana');
INSERT INTO region (nom) VALUES ('Melaky');

INSERT into materiel (nom) VALUES ('Argent');



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
    u.imatricule as matricule,
    u.region as id_region,
    r.nom as region
from users u
join province p on p.id = u.province
join region r on r.id = u.region;

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
    sc.prisonnier,
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

CREATE OR REPLACE VIEW About_camp AS
SELECT
    more.camp AS id_camp,
    camp.nom AS camp,
    camp.province,
    more.region AS id_region,
    region.nom AS localite,
    more.distance,
    (more.cultivable + more.ncultivable) AS total,
    more.cultivable,
    more.ncultivable,
    more.situation AS id_situation,
    situation.nom as situation,
    COALESCE(
        (SELECT 'oui(' || SUM(superficie) || 'ha)' FROM campculture WHERE campculture.camp = more.camp),
        'non'
    ) AS Exploite_fonctionnel,
    COALESCE(
        CASE 
            WHEN more.litige > 0 THEN 'oui(' || more.litige || 'ha)'
            ELSE 'non'
        END,
        'non'
    ) AS litige
FROM more
JOIN region ON region.id = more.region
JOIN situation ON situation.id = more.situation
JOIN camp ON camp.id = more.camp;

    -- case 
    --     when (select SUM(supeficie) from campculture where camp = more.camp) > 0 then  (select SUM(supeficie) from campculture where camp = more.camp)

-- create or replace view Estimation as
-- SELECT 
--     es.id_camp,
--     es.camp,
--     es.id_culture,
--     c.nom AS culture,
--     SUM(es.quantite * c.prixunitaire) where AS estimation_prix
-- FROM 
--     etatstock es
-- JOIN 
--     culture c 
-- ON 
--     es.id_culture = c.id
-- GROUP BY 
--     es.id_camp, es.camp, es.id_culture, c.nom
-- ORDER BY
--     es.id_camp, es.id_culture;

CREATE OR REPLACE VIEW v_stock AS
SELECT
    es.id_camp,
    es.camp,
    es.province,
    es.id_culture,
    es.culture,
    SUM(CASE WHEN es.etat = 0 THEN es.quantite ELSE 0 END) AS entre,
    SUM(CASE WHEN es.etat = 1 THEN es.quantite ELSE 0 END) AS sortie,
    ABS(
        SUM(CASE WHEN es.etat = 0 THEN es.quantite ELSE 0 END) -
        SUM(CASE WHEN es.etat = 1 THEN es.quantite ELSE 0 END)
    ) AS total
FROM
    etatstock es
GROUP BY
    es.id_camp,
    es.camp,
    es.province,
    es.id_culture,
    es.culture;

create or replace view Estimation as
select
    es.id_camp,
    es.camp,
    es.id_culture,
    c.nom AS culture,
    SUM(es.total * c.prixunitaire) AS estimation_prix
FROM 
    v_stock es
JOIN 
    culture c 
ON 
    es.id_culture = c.id
GROUP BY 
    es.id_camp, es.camp, es.id_culture, c.nom
ORDER BY
    es.id_camp, es.id_culture;


--rapport mensuel a la gestion de production
CREATE OR REPLACE VIEW rapport_stock AS
SELECT 
    es.id_camp,
    cm.nom AS camp,
    es.id_culture,
    c.nom AS culture,
    SUM(CASE WHEN es.etat = 0 THEN es.quantite ELSE 0 END) AS entre,
    SUM(CASE WHEN es.etat = 1 THEN es.quantite ELSE 0 END) AS sortie,
    ABS(SUM(CASE WHEN es.etat = 0 THEN es.quantite ELSE 0 END) - SUM(CASE WHEN es.etat = 1 THEN es.quantite ELSE 0 END)) AS total_disponible,
    SUM(CASE WHEN es.etat = 1 AND es.prisonnier = 1 THEN es.quantite ELSE 0 END) AS consommation_locale,
    SUM(CASE WHEN es.etat = 1 AND es.prisonnier = 0 THEN es.quantite ELSE 0 END) AS semences,
    SUM(CASE WHEN es.etat = 1 AND es.prisonnier = 2 THEN es.quantite ELSE 0 END) AS etablissements,
    SUM(CASE WHEN es.etat = 1 AND es.prisonnier = 3 THEN es.quantite ELSE 0 END) AS autres_motifs,
    (SELECT SUM(sc.quantite) FROM stockculture sc WHERE sc.camp = es.id_camp AND sc.culture = es.id_culture AND sc.etat = 0) AS report_stock
FROM 
    etatstock es
JOIN 
    camp cm ON cm.id = es.id_camp
JOIN 
    culture c ON c.id = es.id_culture
GROUP BY 
    es.id_camp, cm.nom, es.id_culture, c.nom
ORDER BY 
    es.id_camp, es.id_culture;

    

CREATE OR REPLACE VIEW RapportMensuel AS
SELECT
    es.id_camp,
    c.nom AS camp,
    cu.nom AS produit,
    SUM(CASE WHEN es.etat = 0 THEN es.quantite ELSE 0 END) AS quantite_produite,
    SUM(CASE WHEN es.etat = 1 THEN es.quantite ELSE 0 END) AS quantite_consommation_locale,
    0 AS semences, -- Placeholder si vous avez des données de semences à inclure
    0 AS etablissements, -- Placeholder si vous avez des données des établissements à inclure
    0 AS autres_motifs, -- Placeholder si vous avez d'autres motifs à inclure
    ABS(SUM(CASE WHEN es.etat = 0 THEN es.quantite ELSE 0 END) - 
        SUM(CASE WHEN es.etat = 1 THEN es.quantite ELSE 0 END)) AS disponible_magasin,
    ABS(SUM(CASE WHEN es.etat = 0 THEN es.quantite ELSE 0 END)) AS recolte_du_mois,
    ABS(SUM(CASE WHEN es.etat = 1 THEN es.quantite ELSE 0 END)) AS report_stock_magasin
FROM
    etatstock es
JOIN
    camp c ON es.id_camp = c.id
JOIN
    culture cu ON es.id_culture = cu.id
GROUP BY
    es.id_camp, c.nom, cu.nom
ORDER BY
    es.id_camp, cu.nom;


--rapport trimestriel materiels
CREATE OR REPLACE VIEW RapportTrimestrielMateriels AS
SELECT 
    cm.nom AS cp,
    m.nom AS materiel,
    COUNT(d.materiel) AS nombre,
    SUM(CASE WHEN d.etat = 'Bon' THEN 1 ELSE 0 END) AS etat_bon,
    SUM(CASE WHEN d.etat = 'Mauvais' THEN 1 ELSE 0 END) AS etat_mauvais
FROM 
    don d
JOIN 
    materiel m ON m.id = d.materiel
JOIN 
    camp cm ON cm.id = d.camp
GROUP BY 
    cm.nom, m.nom;


-- --fonction pour enregistrer les importation de camp penal
-- Create or replace FUNCTION insert_data_camp()
-- RETURNS void as $$
-- BEGIN

--     --insrt des donnees de base dans la table camp
--     insert into camp (nom, province, lattitude, longitude, sol)
--     select
--         'CAMP' || LPAD(nextval('seqcamp')::text, 3,'0') as id,
--         ic.nom,
--         ( SELECT id FROM province WHERE nom ILIKE ic.province ||'%') as province,
--         ic.lattitude,
--         ic.longitude,
--         (select id from sol where nom ILIKE ic.sol || '%') as sol
--     from 
--         importcamp ic;

--     --insertion des donnees en plus des camp penaux

--     insert into more(camp, situation, distance, cultivable, ncultivable,litige, region)
--     select
--         (select id from camp where nom ILIKE ic.nom || '%') as camp,
--         (select id from situation where nom ILIKE ic.situation || '%') as situation,
--         ic.distance,
--         ic.cultivable,
--         ic.ncultivable,
--         ic.litige,
--         (select id from region where nom ILIKE ic.region || '%')
--     from 
--         importcamp ic;


--     --apres fin des operations on supprime les donnees    
--     delete from importcamp;
-- END;
-- $$ LANGUAGE plpgsql;

-- Fonction pour enregistrer les importations de camp pénal
CREATE OR REPLACE FUNCTION insert_data_camp()
RETURNS void AS $$
BEGIN

    -- Insertion des données de base dans la table camp
    INSERT INTO camp (id, nom, province, lattitude, longitude, sol)
    SELECT
        'CAMP0' || LPAD(nextval('seqcamp')::text, 3, '0') AS id,
        ic.nom,
        (SELECT id FROM province WHERE nom ILIKE ic.province || '%') AS province,
        ic.lattitude,
        ic.longitude,
        (SELECT id FROM sol WHERE nom ILIKE ic.sol || '%') AS sol
    FROM
        importcamp ic;

    
       --insertion des situation juridique  
    INSERT INTO situation (nom)
    SELECT DISTINCT ic.situation 
    FROM importcamp ic
    WHERE ic.situation NOT IN (SELECT nom FROM situation);

    -- Insertion des données supplémentaires pour les camps pénaux
    INSERT INTO more (camp, situation, distance, cultivable, ncultivable, litige, region)
    SELECT
        c.id AS camp,
        (SELECT id FROM situation WHERE nom ILIKE ic.situation || '%') AS situation,
        ic.distance,
        ic.cultivable,
        ic.ncultivable,
        ic.litige,
        (SELECT id FROM region WHERE nom ILIKE ic.region || '%') AS region
    FROM
        importcamp ic
    JOIN
        camp c ON c.nom = ic.nom;

 

    -- Suppression des données après l'importation
    DELETE FROM importcamp;

END;
$$ LANGUAGE plpgsql;