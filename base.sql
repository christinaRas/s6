-- insert into categories values(default,'Junior');
-- insert into categories values(default,'Senior');
-- insert into categories values(default,'Homme');
-- insert into categories values(default,'Femme');

    insert into runners values(default,3,'Bema','12','Homme','2004/11/02');
    insert into runners values(default,3,'Koto','5','Homme','2005/01/02');
-- insert into runners values(default,3,'Rasoa','2','Femme','2002/05/28');
-- insert into runners values(default,3,'Jean','2','Homme','2002/05/01');



-- insert into runner_cats values(default,1,1);
-- insert into runner_cats values(default,1,3);
-- insert into runner_cats values(default,2,2);

-- insert into etapes values(default,'Sprint',2,1,2);
-- insert into etapes values(default,'Batton',3.5,2,1);
-- insert into etapes values(default,'Parcours',3.5,3,1);

-- select nom_runner from runners 
-- join users on runners.id_user=users.id
-- where users.id=2;


--coureur par etapes--------------------------------------------------------------------------------------------------------------------------------
create or replace view v_course as
select assignements.id as id_assignement,etapes.id as id_etape,etapes.nom_etape, rang, users.id as id_equipe,login,runners.nom_runner,dossard from assignements
join etapes on assignements.id_etape=etapes.id
join runners on assignements.id_runner=runners.id
join users on runners.id_user=users.id;


--chrono par runner
CREATE OR REPLACE VIEW v_runner_chrono AS
SELECT
    v_course.id_equipe,
    assignements.id_etape,
    v_course.nom_runner,
    TO_CHAR(courses.arrive - courses.depart, 'HH24:MI:SS') AS duree
FROM 
    v_course
JOIN 
    assignements ON v_course.id_assignement = assignements.id
LEFT JOIN 
    courses ON courses.id_assignement = assignements.id;

--------------------------------------------------------------------------------------------------------------------------------------------------------
-- create table point
-- (
--     id_point serial primary key,
--     classement int,
--     point float,
--     foreign key (id_etape) references etape(id_etape)
-- );
-- insert into points values(default,1,10);
-- insert into points values(default,2,6);
-- insert into points values(default,3,4);
-- insert into points values(default,4,2);
-- insert into points values(default,5,1);

-- insert into points values(default,2,1,5);
-- insert into points values(default,2,2,4);
-- insert into points values(default,2,3,3);
-- insert into points values(default,2,4,2);
-- insert into points values(default,2,5,1);


--classement par etape --------------------------------------------------------------------------------------------------------------------------------
select nom_etape,login,sum(arrive-depart) as duree, RANK() OVER (PARTITION BY nom_etape ORDER BY sum(arrive-depart) ASC) AS classement
from courses
join v_course on v_course.id_assignement=courses.id_assignement
group by nom_etape,login;

--                        avec table point point par etape--------------------------------------------------------------------------------------
-- create or replace view v_classement_etape as
-- WITH classement_etape AS (
--     SELECT 
--         id_etape,
--         nom_etape,
--         login,
--         SUM(arrive - depart) AS duree,
--         RANK() OVER (PARTITION BY nom_etape ORDER BY SUM(arrive - depart) ASC) AS classement
--     FROM 
--         courses
--     JOIN 
--         v_course ON v_course.id_assignement = courses.id_assignement
--     GROUP BY 
--         id_etape,nom_etape, login
-- )

-- SELECT 
--     c.id_etape,
--     c.nom_etape,
--     c.login,
--     c.duree,
--     c.classement,
--     COALESCE(p.point, 0) AS point
-- FROM 
--     classement_etape c
-- JOIN 
--     etapes e ON e.nom_etape = c.nom_etape
-- LEFT JOIN 
--     points p ON p.id_etape = e.id AND p.classement = c.classement
-- ORDER BY 
--     c.id_etape,c.nom_etape, c.classement;


--avec table point, meme point par etape

CREATE OR REPLACE VIEW v_classement_etape AS
WITH classement_etape AS (
    SELECT
        vc.id_etape,
        vc.nom_etape,
        vc.login,
        vc.nom_runner,
        SUM(COALESCE(c.arrive - c.depart, interval '0')) AS duree,
        DENSE_RANK() OVER (PARTITION BY vc.nom_etape,vc.id_etape ORDER BY SUM(COALESCE(c.arrive - c.depart, interval '0')) ASC) AS classement
    FROM
        v_course vc
    LEFT JOIN
        courses c ON vc.id_assignement = c.id_assignement
    GROUP BY
        vc.id_etape, vc.nom_etape, vc.login, vc.nom_runner
)

SELECT
    c.id_etape,
    c.nom_etape,
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


-- CREATE OR REPLACE VIEW v_classement_etape AS
-- WITH classement_etape AS (
--     SELECT
--         vc.id_etape,
--         vc.nom_etape,
--         vc.login,
--         vc.nom_runner,
--         SUM(EXTRACT(EPOCH FROM COALESCE(c.arrive - c.depart, interval '0'))) AS duree_seconds,
--         RANK() OVER (PARTITION BY vc.nom_etape ORDER BY SUM(EXTRACT(EPOCH FROM COALESCE(c.arrive - c.depart, interval '0'))) ASC) AS classement
--     FROM
--         v_course vc
--     LEFT JOIN
--         courses c ON vc.id_assignement = c.id_assignement
--     GROUP BY
--         vc.id_etape, vc.nom_etape, vc.login, vc.nom_runner
-- )

-- SELECT
--     c.id_etape,
--     c.nom_etape,
--     c.login,
--     c.nom_runner,
--     (c.duree_seconds / 3600)::int || ':' ||
--     TO_CHAR((c.duree_seconds / 60)::int % 60, 'FM00') || ':' ||
--     TO_CHAR((c.duree_seconds)::int % 60, 'FM00') AS duree,
--     c.classement,
--     COALESCE(p.point, 0) AS point
-- FROM
--     classement_etape c
-- LEFT JOIN
--     points p ON p.classement = c.classement
-- ORDER BY
--     c.id_etape, c.nom_etape, c.classement;


--                              sans table point---------------------------------------------------------------------------------------------
-- create or replace view v_classement_etape as
-- SELECT 
--     id_etape,
--     nom_etape,
--     login,
--     duree,
--     classement,
--     CASE 
--         WHEN classement = 1 THEN 10
--         WHEN classement = 2 THEN 6
--         WHEN classement = 3 THEN 4
--         WHEN classement = 4 THEN 2
--         WHEN classement = 5 THEN 1
--         ELSE 0
--     END AS point
-- FROM (
--     SELECT 
--         id_etape,
--         nom_etape,
--         login,
--         duree,
--         RANK() OVER (PARTITION BY nom_etape ORDER BY duree ASC) AS classement
--     FROM (
--         SELECT 
--             id_etape,
--             nom_etape,
--             login,
--             SUM(arrive - depart) AS duree 
--         FROM 
--             courses
--         JOIN 
--             v_course ON v_course.id_assignement = courses.id_assignement
--         GROUP BY 
--             nom_etape, login, id_etape
--     ) AS subquery
-- ) AS ranked;


--sans table point ni sum---------------------------------------------------------------------------------------------
-- create or replace view v_classement_etape as
-- SELECT 
--     id_etape,
--     nom_etape,
--     login,
--     nom_runner,
--     duree,
--     classement,
--     CASE 
--         WHEN classement = 1 THEN 10
--         WHEN classement = 2 THEN 6
--         WHEN classement = 3 THEN 4
--         WHEN classement = 4 THEN 2
--         WHEN classement = 5 THEN 1
--         ELSE 0
--     END AS point
-- FROM (
--     SELECT 
--         id_etape,
--         nom_etape,
--         login,
--         nom_runner,
--         duree,
--         RANK() OVER (PARTITION BY nom_etape ORDER BY duree ASC) AS classement
--     FROM (
--         SELECT 
--             id_etape,
--             nom_etape,
--             login,
--             nom_runner,
--             (arrive - depart) AS duree 
--         FROM 
--             courses
--         JOIN 
--             v_course ON v_course.id_assignement = courses.id_assignement
--         GROUP BY 
--             nom_etape, login, id_etape,(arrive - depart),nom_runner
--     ) AS subquery
-- ) AS ranked;


--classement total------------------------------------------------------------------------------------------------------------------------------------
create or replace view v_classement_total as
select login, RANK() OVER (ORDER BY sum(point) DESC) AS classement,sum(point) from v_classement_etape
group by login;


--date et heure--------------------------------------------------------------------------------------------------------------------------------------
SELECT TO_CHAR(
    ( '2004-06-03 09:00:00'::timestamp - '2004-06-02 08:00:00'::timestamp ), 
    'HH24:MI:SS'
) AS difference_in_hhmmss;

    SELECT 
        (EXTRACT(EPOCH FROM ('2004-06-02 11:14:55'::timestamp - '2004-06-02 11:00:00'::timestamp)) / 3600)::int || ':' ||
        TO_CHAR((EXTRACT(EPOCH FROM ('2004-06-02 11:14:55'::timestamp - '2004-06-02 11:00:00'::timestamp)) / 60)::int % 60, 'FM00') || ':' ||
        TO_CHAR((EXTRACT(EPOCH FROM ('2004-06-02 11:14:55'::timestamp - '2004-06-02 11:00:00'::timestamp))::int % 60), 'FM00') AS difference_in_hhmmss;



