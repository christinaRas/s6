--categorie
-- create or replace view v_classement_categorie as
-- WITH classement_etape AS (
--     SELECT
--         vc.id_etape,
--         vc.nom_etape,
--         vc.login,
--         vc.nom_runner,
--         categories.id as id_categorie,
--         categories.nom_categorie,
--         SUM(COALESCE(c.arrive - c.depart, interval '0')) AS duree,
--         DENSE_RANK() OVER (PARTITION BY vc.id_etape, categories.nom_categorie ORDER BY SUM(COALESCE(c.arrive - c.depart, interval '0')) ASC) AS classement
--     FROM
--         v_course vc
--     LEFT JOIN
--         courses c ON vc.id_assignement = c.id_assignement
--     JOIN
--         runners on vc.nom_runner=runners.nom_runner
--     Join
--         runner_cats ON runner_cats.id_runner = runners.id
--     JOIN
--         categories ON categories.id = runner_cats.id_categorie
--     GROUP BY
--         vc.id_etape, vc.nom_etape, vc.login, vc.nom_runner, categories.nom_categorie,categories.id
-- )

-- SELECT
--     c.id_etape,
--     c.nom_etape,
--     c.login,
--     c.nom_runner,
--     c.id_categorie,
--     c.nom_categorie,
--     c.duree,
--     c.classement,
--     COALESCE(p.point, 0) AS point
-- FROM
--     classement_etape c
-- LEFT JOIN
--     points p ON p.classement = c.classement
-- ORDER BY
--     c.id_etape, c.nom_etape, c.nom_categorie, c.classement;



-- create or replace view v_categorie_r as
-- select 
--     id_categorie,
--     login,
--     DENSE_RANK() OVER (ORDER BY SUM(point) DESC) AS classement,
--     sum(point) as point
-- from v_classement_categorie
-- group by login,id_categorie
-- ORDER by classement;


-- create view v_all_categorie_r as
-- SELECT 
--     login,
--     DENSE_RANK() OVER (ORDER BY SUM(point) DESC) AS classement,
--     SUM(point) as point
-- FROM 
--     v_categorie_r
-- GROUP BY 
--     login
-- ORDER BY 
--     classement;

--categorie Femme
-- create or replace view v_femme as
-- WITH classement_etape AS (
--     SELECT
--         vc.id_etape,
--         vc.nom_etape,
--         vc.login,
--         vc.nom_runner,
--         categories.nom_categorie,
--         SUM(COALESCE(c.arrive - c.depart, interval '0')) AS duree,
--         DENSE_RANK() OVER (PARTITION BY vc.id_etape, categories.nom_categorie ORDER BY SUM(COALESCE(c.arrive - c.depart, interval '0')) ASC) AS classement
--     FROM
--         v_course vc
--     LEFT JOIN
--         courses c ON vc.id_assignement = c.id_assignement
--     JOIN
--         runners on vc.nom_runner=runners.nom_runner
--     Join
--         runner_cats ON runner_cats.id_runner = runners.id
--     JOIN
--         categories ON categories.id = runner_cats.id_categorie
--     where id_categorie=3
--     GROUP BY
--         vc.id_etape, vc.nom_etape, vc.login, vc.nom_runner, categories.nom_categorie
-- )

-- SELECT
--     c.id_etape,
--     c.nom_etape,
--     c.login,
--     c.nom_runner,
--     c.nom_categorie,
--     c.duree,
--     c.classement,
--     COALESCE(p.point, 0) AS point
-- FROM
--     classement_etape c
-- LEFT JOIN
--     points p ON p.classement = c.classement
-- ORDER BY
--     c.id_etape, c.nom_etape, c.nom_categorie, c.classement;


-- create or replace view v_femme_r as
-- select 
--     login,
--     DENSE_RANK() OVER (ORDER BY SUM(point) DESC) AS classement,
--     sum(point) as point
-- from v_femme
-- group by login
-- ORDER by classement;


-- --categorie junior
-- create or replace view v_junior as
-- WITH classement_etape AS (
--     SELECT
--         vc.id_etape,
--         vc.nom_etape,
--         vc.login,
--         vc.nom_runner,
--         categories.nom_categorie,
--         SUM(COALESCE(c.arrive - c.depart, interval '0')) AS duree,
--         DENSE_RANK() OVER (PARTITION BY vc.id_etape, categories.nom_categorie ORDER BY SUM(COALESCE(c.arrive - c.depart, interval '0')) ASC) AS classement
--     FROM
--         v_course vc
--     LEFT JOIN
--         courses c ON vc.id_assignement = c.id_assignement
--     JOIN
--         runners on vc.nom_runner=runners.nom_runner
--     Join
--         runner_cats ON runner_cats.id_runner = runners.id
--     JOIN
--         categories ON categories.id = runner_cats.id_categorie
--     where id_categorie=2
--     GROUP BY
--         vc.id_etape, vc.nom_etape, vc.login, vc.nom_runner, categories.nom_categorie
-- )

-- SELECT
--     c.id_etape,
--     c.nom_etape,
--     c.login,
--     c.nom_runner,
--     c.nom_categorie,
--     c.duree,
--     c.classement,
--     COALESCE(p.point, 0) AS point
-- FROM
--     classement_etape c
-- LEFT JOIN
--     points p ON p.classement = c.classement
-- ORDER BY
--     c.id_etape, c.nom_etape, c.nom_categorie, c.classement;

-- create or replace view v_junior_r as
-- select 
--     login,
--     DENSE_RANK() OVER (ORDER BY SUM(point) DESC) AS classement,
--     sum(point) as point
-- from v_junior
-- group by login
-- ORDER by classement;


--toutes categories
-- CREATE OR REPLACE VIEW v_toute_categorie AS
-- SELECT * FROM v_homme
-- UNION ALL
-- SELECT * FROM v_femme
-- UNION ALL
-- SELECT * FROM v_junior;


-- SELECT 
--     login,
--     DENSE_RANK() OVER (ORDER BY SUM(point) DESC) AS classement,
--     SUM(point) as point
-- FROM 
--     v_toute_categorie
-- GROUP BY 
--     login
-- ORDER BY 
--     classement;






JOUR3

--penalite
create or replace view v_penalite as
select penalites.id as id_penalite,id_etape,nom_etape,users.id,login as equipe,penalite
from penalites
join etapes on penalites.id_etape=etapes.id
join users on penalites.id_equipe=users.id;

v_course.id_equipe,
    assignements.id_etape,
    v_course.nom_runner,
    v_course.login,
    TO_CHAR(courses.arrive - courses.depart, 'HH24:MI:SS') AS duree


create or replace view v_runner_chrono_penalite as
SELECT 
v_runner_chrono.id_etape,v_runner_chrono.nom_etape,v_runner_chrono.id_equipe,v_runner_chrono.id_runner,v_runner_chrono.nom_runner,login, 
TO_CHAR((v_runner_chrono.duree::interval + sum(COALESCE(penalites.penalite, '00:00:00')))::time, 'HH24:MI:SS') AS duree
FROM v_runner_chrono
FULL OUTER JOIN penalites ON penalites.id_etape = v_runner_chrono.id_etape and penalites.id_equipe = v_runner_chrono.id_equipe
group by v_runner_chrono.id_equipe,v_runner_chrono.login,v_runner_chrono.id_etape,nom_runner,v_runner_chrono.duree,v_runner_chrono.id_runner,v_runner_chrono.nom_etape;

-- SELECT 
-- v_runner_chrono.id_equipe,v_runner_chrono.id_etape,v_runner_chrono.nom_runner,login, 
-- v_runner_chrono.duree as duree ,sum(COALESCE(penalites.penalite, '00:00:00')) AS penalite
-- FROM v_runner_chrono
-- FULL OUTER JOIN penalites ON penalites.id_etape = v_runner_chrono.id_etape and penalites.id_equipe = v_runner_chrono.id_equipe
-- group by v_runner_chrono.id_equipe,v_runner_chrono.login,v_runner_chrono.id_etape,nom_runner,v_runner_chrono.duree ;

-- SELECT * FROM v_runner_chrono
-- FULL OUTER JOIN penalites ON penalites.id_etape = v_runner_chrono.id_etape and penalites.id_equipe = v_runner_chrono.id_equipe;





--modification classement par categorie
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
        vc.id_etape, vc.nom_etape, vc.login, vc.nom_runner, categories.nom_categorie,categories.id,vc.duree;



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
