use exam_results_goriachev;

-- 1. Хранимая функция 	
-- Выбирает информацию об абитуриентах с заданной фамилией, серией/номером паспорта

delimiter $$

drop procedure if exists query01_procedure$$

create procedure query01_procedure(in last_name varchar(45), in passport varchar(20))
begin
    select * from students_view where students_view.passport like passport and students_view.last_name like last_name;
end$$

delimiter ;


-- 2. Хранимая функция	
-- Выбирает информацию об экзаменах, которые были приняты экзаменатором с заданной фамилией

delimiter $$

drop procedure if exists query02_procedure$$

create procedure query02_procedure(in surname varchar(45))
begin
    select * from exams_view where exams_view.examiner_last_name like surname;
end$$

delimiter ;

-- 3. Хранимая функция	
-- Выбирает информацию об экзаменах, сданных абитуриентом с заданным номером/серией паспорта

delimiter $$

drop procedure if exists query03_procedure$$

create procedure query03_procedure(in passport varchar(20))
begin
    select * from exams_view where exams_view.student_passport like passport;
end$$

delimiter ;

-- 4. Хранимая функция	
-- Выбирает информацию об абитуриенте с заданным номером/серией паспорта. 

delimiter $$

drop procedure if exists query04_procedure$$

create procedure query04_procedure(passport nvarchar(20))
begin
    select * from students_view where students_view.passport like passport;
end$$

delimiter ;

-- 5. Хранимая функция	
-- Выбирает информацию обо всех экзаменаторах

delimiter $$

drop procedure if exists query05_procedure$$

create procedure query05_procedure()
begin
    select * from examiners_view;
end$$

delimiter ;

-- 6. Хранимая функция	
-- Вычисляет для каждого экзамена размер налога (Налог=Размер оплаты*13%) и зарплаты экзаменатора 
-- (Зарплата=Размер оплаты - Налог). Сортировка по полю Код экзаменатора

delimiter $$

drop procedure if exists query06_procedure$$

create procedure query06_procedure()
begin
    select *,
           exams_view.examiner_exam_fee * 0.13                                  as tax,
           exams_view.examiner_exam_fee - (exams_view.examiner_exam_fee * 0.13) as salary
    from exams_view
    order by exams_view.id;
end$$

delimiter ;

-- 7. Хранимая функция	
-- Выполняет группировку по полю Год рождения в таблице АБИТУРИЕНТЫ. Для каждой группы определяет 
-- количество абитуриентов (итоги по полю Код абитуриента)

delimiter $$

drop procedure if exists query07_procedure$$

create procedure query07_procedure()
begin
    select students_view.year_of_birth,
           count(*) as amount
    from students_view
    group by students_view.year_of_birth;
end$$

delimiter ;


-- 8. Хранимая функция	
-- Выполняет группировку по полю Дата сдачи экзамена в таблице ЭКЗАМЕНЫ. Для каждой даты определяет 
-- среднее значения по полю Оценка

delimiter $$

drop procedure if exists query08_procedure$$

create procedure query08_procedure()
begin
    select exams_view.`date`,
           min(exams_view.score) as min_score,
           avg(exams_view.score) as avg_score,
           max(exams_view.score) as max_score,
           count(*)              as amount
    from exams_view
    group by exams_view.`date`;
end$$

delimiter ;
