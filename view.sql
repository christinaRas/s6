--coureur par etapes
create or replace view v_course as
select assignements.id as id_assignement,etapes.id as id_etape,etapes.nom_etape, rang, users.id as id_equipe,login,runners.nom_runner,dossard from assignements
join etapes on assignements.id_etape=etapes.id
join runners on assignements.id_runner=runners.id
join users on runners.id_user=users.id;


--chrono par runner sans penalite
CREATE OR REPLACE VIEW v_runner_chrono AS
SELECT
    v_course.id_equipe,
    assignements.id_etape,
    v_course.nom_etape as nom_etape,
    assignements.id_runner,
    v_course.nom_runner,
    v_course.login,
    TO_CHAR(courses.arrive - courses.depart, 'HH24:MI:SS') AS duree
FROM 
    v_course
JOIN 
    assignements ON v_course.id_assignement = assignements.id
LEFT JOIN 
    courses ON courses.id_assignement = assignements.id;


--penalite
create or replace view v_penalite as
select penalites.id as id_penalite,id_etape,nom_etape,users.id,login as equipe,penalite
from penalites
join etapes on penalites.id_etape=etapes.id
join users on penalites.id_equipe=users.id;

--chrono avec penalite
create or replace view v_runner_chrono_penalite as
SELECT 
v_runner_chrono.id_etape,v_runner_chrono.nom_etape,v_runner_chrono.id_equipe,v_runner_chrono.id_runner,v_runner_chrono.nom_runner,login, 
TO_CHAR((v_runner_chrono.duree::interval + sum(COALESCE(penalites.penalite, '00:00:00')))::time, 'HH24:MI:SS') AS duree
FROM v_runner_chrono
FULL OUTER JOIN penalites ON penalites.id_etape = v_runner_chrono.id_etape and penalites.id_equipe = v_runner_chrono.id_equipe
group by v_runner_chrono.id_equipe,v_runner_chrono.login,v_runner_chrono.id_etape,nom_runner,v_runner_chrono.duree,v_runner_chrono.id_runner,v_runner_chrono.nom_etape;


--classement par etape par coureur
CREATE OR REPLACE VIEW v_classement_etape AS
WITH classement_etape AS (
    SELECT
        vc.id_etape,
        vc.nom_etape,
        vc.id_equipe,
        vc.login,
        vc.nom_runner,
        vc.duree AS duree,
        DENSE_RANK() OVER (PARTITION BY vc.nom_etape,vc.id_etape ORDER BY vc.duree ASC) AS classement
     FROM
        v_runner_chrono_penalite vc
    GROUP BY
        vc.id_etape, vc.nom_etape, vc.login, vc.nom_runner, vc.duree,vc.id_equipe
)

SELECT
    c.id_etape,
    c.nom_etape,
    c.id_equipe,
    c.login,
    c.nom_runner,
    c.duree,
    c.classement,
    COALESCE(p.point, 0) AS point
FROM
    classement_etape c
LEFT JOIN
    points p ON p.classement = c.classement
ORDER BY
    c.id_etape, c.nom_etape, c.classement;



--classement par etape par equipe
CREATE OR REPLACE VIEW v_classement_etape AS
WITH classement_etape AS (
    SELECT
        vc.id_etape,
        vc.nom_etape,
        vc.id_equipe,
        vc.login,
        vc.duree AS duree,
        DENSE_RANK() OVER (PARTITION BY vc.nom_etape,vc.id_etape ORDER BY vc.duree ASC) AS classement
     FROM
        v_runner_chrono_penalite vc
)

SELECT
    c.id_etape,
    c.nom_etape,
    c.id_equipe,
    c.login,
    c.duree,
    c.classement,
    COALESCE(p.point, 0) AS point
FROM
    classement_etape c
LEFT JOIN
    points p ON p.classement = c.classement
ORDER BY
    c.id_etape, c.nom_etape, c.classement;



-- classement par etape par equipe total par equipe
WITH classement_etape AS (
    SELECT
        vc.id_etape,
        vc.nom_etape,
        vc.id_equipe,
        vc.login,
        vc.duree AS duree,
        DENSE_RANK() OVER (PARTITION BY vc.nom_etape,vc.id_etape ORDER BY vc.duree ASC) AS classement
     FROM
        v_runner_chrono_penalite vc
)

SELECT
    c.id_etape,
    c.nom_etape,
    c.id_equipe,
    c.login,
    c.duree,
    c.classement,
    COALESCE(p.point, 0) AS point
FROM
    classement_etape c
LEFT JOIN
    points p ON p.classement = c.classement
ORDER BY
    c.id_etape, c.nom_etape, c.classement;
--sum total
WITH classement_etape AS (
    SELECT
        vc.id_etape,
        vc.nom_etape,
        vc.id_equipe,
        vc.login,
        vc.duree AS duree,
        DENSE_RANK() OVER (PARTITION BY vc.nom_etape, vc.id_etape ORDER BY vc.duree ASC) AS classement
     FROM
        v_runner_chrono_penalite vc
),
points AS (
    SELECT classement, SUM(point) AS point
    FROM points
    GROUP BY classement
)

SELECT
    c.id_etape,
    c.nom_etape,
    c.id_equipe,
    c.login,
    SUM(COALESCE(p.point, 0)) AS total_points
FROM
    classement_etape c
LEFT JOIN
    points p ON p.classement = c.classement
GROUP BY
    c.id_etape, c.nom_etape, c.id_equipe, c.login
ORDER BY
    c.id_etape, c.nom_etape, c.id_equipe, c.login;




--classement total 
create or replace view v_classement_total as
select id_equipe,login, RANK() OVER (ORDER BY sum(point) DESC) AS classement,sum(point) as point from v_classement_etape
group by id_equipe,login;


--classement par categorie
create or replace view v_classement_categorie as
WITH classement_etape AS (
    SELECT
        vc.id_etape,
        vc.nom_etape,
        vc.login,
        vc.nom_runner,
        categories.id as id_categorie,
        categories.nom_categorie,
        vc.duree AS duree,
        DENSE_RANK() OVER (PARTITION BY vc.id_etape, categories.nom_categorie ORDER BY vc.duree ASC) AS classement
    FROM
        v_runner_chrono_penalite vc
    JOIN
        runners on vc.id_runner=runners.id
    Join
        runner_cats ON runner_cats.id_runner = runners.id
    JOIN
        categories ON categories.id = runner_cats.id_categorie
    GROUP BY
        vc.id_etape, vc.nom_etape, vc.login, vc.nom_runner, categories.nom_categorie,categories.id,vc.duree
)

SELECT
    c.id_etape,
    c.nom_etape,
    c.login,
    c.nom_runner,
    c.id_categorie,
    c.nom_categorie,
    c.duree,
    c.classement,
    COALESCE(p.point, 0) AS point
FROM
    classement_etape c
LEFT JOIN
    points p ON p.classement = c.classement
ORDER BY
    c.id_etape, c.nom_etape, c.nom_categorie, c.classement;










--JOUR 4
--chrono avec penalite pas coureur
create or replace view v_runner_chrono_penalite as

SELECT 
v_runner_chrono.id_etape,v_runner_chrono.nom_etape,v_runner_chrono.id_equipe,v_runner_chrono.id_runner,v_runner_chrono.nom_runner,login, 
TO_CHAR((v_runner_chrono.duree::interval + sum(COALESCE(penalites.penalite, '00:00:00')))::time, 'HH24:MI:SS') AS duree
FROM v_runner_chrono
FULL OUTER JOIN penalites ON penalites.id_etape = v_runner_chrono.id_etape and penalites.id_equipe = v_runner_chrono.id_equipe
group by v_runner_chrono.id_equipe,v_runner_chrono.login,v_runner_chrono.id_etape,nom_runner,v_runner_chrono.duree,v_runner_chrono.id_runner,v_runner_chrono.nom_etape;



create or replace view v_etape_coureur_chrono_penalite as
SELECT 
v_runner_chrono.id_etape,
v_runner_chrono.nom_etape,
v_runner_chrono.login,
v_runner_chrono.id_runner,
v_runner_chrono.nom_runner,
runners.genre,
v_runner_chrono.duree,
penalites.id as id_penalite,
COALESCE(penalites.penalite, '00:00:00') as penalite,
TO_CHAR((v_runner_chrono.duree::interval + sum(COALESCE(penalites.penalite, '00:00:00')))::time, 'HH24:MI:SS') AS temps_final,

DENSE_RANK() OVER
(PARTITION BY v_runner_chrono.nom_etape,v_runner_chrono.id_etape ORDER BY 
TO_CHAR((v_runner_chrono.duree::interval + sum(COALESCE(penalites.penalite, '00:00:00')))::time, 'HH24:MI:SS') ASC) AS classement

FROM v_runner_chrono
FULL OUTER JOIN penalites ON penalites.id_etape = v_runner_chrono.id_etape and penalites.id_equipe = v_runner_chrono.id_equipe
JOIN runners on v_runner_chrono.id_runner=runners.id
group by v_runner_chrono.id_etape,v_runner_chrono.login,v_runner_chrono.id_runner,v_runner_chrono.nom_runner,v_runner_chrono.duree,v_runner_chrono.nom_etape,penalites.id,penalite, runners.genre;

select * from v_etape_coureur_chrono_penalite where id_etape=1;





create or replace view v_alea2 as
select id_etape,nom_etape,id_equipe,login,sum(point) from v_classement_etape
group by id_etape,nom_etape,id_equipe,login;