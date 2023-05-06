CREATE DATABASE if not exists  solar_system;

USE solar_system;

drop table if exists palnets;

CREATE TABLE planets (
    id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),
    name VARCHAR(30) NOT NULL,
    color VARCHAR(30) NOT NULL
);

INSERT INTO planets VALUES
    (null, 'earth', 'blue'),
    (null, 'mars', 'red'),
    (null, 'jupiter', 'stripes');


-- создание хранимой процедуры
delimiter $$

drop procedure if exists planets$$

create procedure planets(in planet_name varchar(30))
begin
    select
	    name
		, color
    from
        planets
    where 
        name regexp planet_name;
end$$

delimiter ;		
