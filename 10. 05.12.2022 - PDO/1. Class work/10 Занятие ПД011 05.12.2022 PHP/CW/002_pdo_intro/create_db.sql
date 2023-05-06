CREATE DATABASE if not exists  solar_system;

USE solar_system;

CREATE TABLE planets (
    id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),
    name VARCHAR(30) NOT NULL,
    color VARCHAR(30) NOT NULL
);

INSERT INTO planets VALUES
    (null, 'earth', 'blue'),
    (null, 'mars', 'red'),
    (null, 'pluto', 'brown'),
    (null, 'mercury', 'gray'),
    (null, 'jupiter', 'stripes');

drop table planets;

-- проверочный запрос
select * from planets;
