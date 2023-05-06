use exam_results_db;

-- 1. Хранимая функция 	
-- Выбирает информацию об абитуриентах с заданной фамилией, серией/номером паспорта

delimiter $$

drop function if exists query01_function$$

create function query01_function(last_name varchar(45), passport varchar(20))
returns int reads sql data
begin
    return (select count(*) from (select * from students_view where students_view.passport like passport and students_view.last_name like last_name) as res);
end$$

delimiter ;


-- 2. Хранимая функция	
-- Выбирает информацию об экзаменах, которые были приняты экзаменатором с заданной фамилией

delimiter $$

drop function if exists query02_function$$

create function query02_function(surname varchar(45)) 
returns int reads sql data
begin
	return (select count(*) from (select * from exams_view where exams_view.examiner_last_name like surname) as res);
end$$

delimiter ;

-- 3. Хранимая функция	
-- Выбирает информацию об экзаменах, сданных абитуриентом с заданным номером/серией паспорта

delimiter $$

drop function if exists query03_function$$

create function query03_function(passport varchar(20))
returns int reads sql data
begin
	return (select count(*) from (select * from exams_view where exams_view.student_passport like passport) as res);
end$$

delimiter ;

-- 4. Хранимая функция	
-- Выбирает информацию об абитуриенте с заданным номером/серией паспорта. 

delimiter $$

drop function if exists query04_function$$

create function query04_function(passport varchar(20)) 
returns int reads sql data
begin
	return (select count(*) from (select * from students_view where students_view.passport like passport) as res);
end$$

delimiter ;

-- 5. Хранимая функция	
-- Выбирает информацию обо всех экзаменаторах

delimiter $$

drop function if exists query05_function$$

create function query05_function()
returns int reads sql data
begin
	return (select count(*) from (select * from examiners_view) as res);
end$$

delimiter ;

-- 6. Хранимая функция	
-- Вычисляет для каждого экзамена размер налога (Налог=Размер оплаты*13%) и зарплаты экзаменатора 
-- (Зарплата=Размер оплаты - Налог). Сортировка по полю Код экзаменатора
 	 	 
delimiter $$

drop function if exists query06_function$$

create function query06_function()
returns int reads sql data
begin
	return (select count(*) from (
		select 
			*, 
            exams_view.examiner_exam_fee * 0.13 as tax, 
            exams_view.examiner_exam_fee - (exams_view.examiner_exam_fee * 0.13) as salary 
		from 
			exams_view
		order by
			exams_view.id
		) as res);
end$$

delimiter ;
 
-- 7. Хранимая функция	
-- Выполняет группировку по полю Год рождения в таблице АБИТУРИЕНТЫ. Для каждой группы определяет 
-- количество абитуриентов (итоги по полю Код абитуриента)
 	 	 
delimiter $$

drop function if exists query07_function$$

create function query07_function()
returns int reads sql data
begin
	return (select count(*) from (
		select 
			students_view.year_of_birth, 
			count(*)
		from 
			students_view
		group by
			students_view.year_of_birth
		) as res);
end$$

delimiter ;


-- 8. Хранимая функция	
-- Выполняет группировку по полю Дата сдачи экзамена в таблице ЭКЗАМЕНЫ. Для каждой даты определяет 
-- среднее значения по полю Оценка

delimiter $$

drop function if exists query08_function$$

create function query08_function()
returns int reads sql data
begin
	return (select count(*) from (
		select 
			exams_view.`date`, 
            min(exams_view.score) as min_score,
            avg(exams_view.score) as avg_score,
            max(exams_view.score) as max_score,
			count(*) as amount
		from 
			exams_view
		group by
			exams_view.`date`
		) as res);
end$$

delimiter ;
