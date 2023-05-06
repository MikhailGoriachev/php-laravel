use exam_results_db;

-- 1. Хранимая функция 	
-- Выбирает информацию об абитуриентах с заданной фамилией, серией/номером паспорта

select * from students_view;

set @surname = 'Соловьёв';
set @passport = '33790923';

select exam_results_db.query01_function(@surname, @passport) as amount_students;

set @surname = 'Ширяев';
set @passport = '13721490';

select exam_results_db.query01_function(@surname, @passport) as amount_students;

set @surname = 'Лукин';
set @passport = '34754110';

select exam_results_db.query01_function(@surname, @passport) as amount_students;


-- 2. Хранимая функция	
-- Выбирает информацию об экзаменах, которые были приняты экзаменатором с заданной фамилией

select * from examiners_view;

set @surname = 'Филиппов';

select exam_results_db.query02_function(@surname) as amount_exams;

set @surname = 'Новиков';

select exam_results_db.query02_function(@surname) as amount_exams;

set @surname = 'Лукин';

select exam_results_db.query02_function(@surname) as amount_exams;

-- 3. Хранимая функция	
-- Выбирает информацию об экзаменах, сданных абитуриентом с заданным номером/серией паспорта

select * from exams_view;

set @passport = '33790923';

select exam_results_db.query03_function(@passport) as amount_exams;

set @passport = '13721490';

select exam_results_db.query03_function(@passport) as amount_exams;

set @passport = '34754110';

select exam_results_db.query03_function(@passport) as amount_exams;


-- 4. Хранимая функция	
-- Выбирает информацию об абитуриенте с заданным номером/серией паспорта. 

select * from students_view;

set @passport = '33790923';

select exam_results_db.query04_function(@passport) as amount_exams;

set @passport = '13721490';

select exam_results_db.query04_function(@passport) as amount_exams;

set @passport = '34754110';

select exam_results_db.query04_function(@passport) as amount_exams;


-- 5. Хранимая функция	
-- Выбирает информацию обо всех экзаменаторах

select exam_results_db.query05_function() as exams_amount;


-- 6. Хранимая функция	
-- Вычисляет для каждого экзамена размер налога (Налог=Размер оплаты*13%) и зарплаты экзаменатора 
-- (Зарплата=Размер оплаты - Налог). Сортировка по полю Код экзаменатора
 	 	 
select exam_results_db.query06_function() as exams_amount;
         
         
-- 7. Хранимая функция	
-- Выполняет группировку по полю Год рождения в таблице АБИТУРИЕНТЫ. Для каждой группы определяет 
-- количество абитуриентов (итоги по полю Код абитуриента)

select exam_results_db.query07_function() as year_of_birth_amount;


-- 8. Хранимая функция	
-- Выполняет группировку по полю Дата сдачи экзамена в таблице ЭКЗАМЕНЫ. Для каждой даты определяет 
-- среднее значения по полю Оценка

select exam_results_db.query07_function() as date_exam_amount;
