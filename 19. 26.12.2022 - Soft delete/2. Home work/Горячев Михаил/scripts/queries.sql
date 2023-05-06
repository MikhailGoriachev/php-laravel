-- подключение к базе данных
use car_rental_goriachev;

-- 1 (Запрос на выборку) 
-- Выбирает из таблицы АВТОМОБИЛИ информацию об автомобилях, стоимость одного дня проката которых 
-- меньше заданного значения

set @max_rental = 1900;
call car_rental.query01_procedure(@max_rental);

set @max_rental = 6000;
call car_rental.query01_procedure(@max_rental);

set @max_rental = 8000;
call car_rental.query01_procedure(@max_rental);

set @max_rental = 10000;
call car_rental.query01_procedure(@max_rental);


-- 2 (Запрос на выборку)
-- Выбирает из таблицы АВТОМОБИЛИ информацию об автомобилях, страховая стоимость которых находится в 
-- диапазоне

set @min_inshurance_pay = 2000000;
set @max_inshurance_pay = 3000000;
call car_rental.query02_procedure(@min_inshurance_pay, @max_inshurance_pay);

set @min_inshurance_pay = 2000000;
set @max_inshurance_pay = 5000000;
call car_rental.query02_procedure(@min_inshurance_pay, @max_inshurance_pay);

set @min_inshurance_pay = 5000000;
set @max_inshurance_pay = 7000000;
call car_rental.query02_procedure(@min_inshurance_pay, @max_inshurance_pay);

set @min_inshurance_pay = 7000000;
set @max_inshurance_pay = 12000000;
call car_rental.query02_procedure(@min_inshurance_pay, @max_inshurance_pay);

-- 3 (Запрос на выборку)
-- Выбирает из таблиц КЛИЕНТЫ, АВТОМОБИЛИ и ПРОКАТ информацию о клиентах, серия-номер паспорта которых 
-- начинается с заданной параметром цифры. Включает поля Код клиента, Паспорт, Дата начала проката, 
-- Количество дней проката, Модель автомобиля

set @start_passport = '2';
call car_rental.query03_procedure(@start_passport);

set @start_passport = '4';
call car_rental.query03_procedure(@start_passport);

set @start_passport = '3';
call car_rental.query03_procedure(@start_passport);

set @start_passport = '9';
call car_rental.query03_procedure(@start_passport);


-- 4 (Запрос на выборку)
-- Выбирает из таблицы КЛИЕНТЫ и ПРОКАТ информацию о клиентах, бравших автомобиль напрокат в некоторый 
-- определенный день. 

set @selected_date = '2021-11-01';
call car_rental.query04_procedure(@selected_date);

set @selected_date = '2021-11-07';
call car_rental.query04_procedure(@selected_date);

set @selected_date = '2021-11-05';
call car_rental.query04_procedure(@selected_date);

set @selected_date = '2021-11-08';
call car_rental.query04_procedure(@selected_date);

-- 5 (Запрос на выборку)
-- Выбирает из таблицы АВТОМОБИЛИ информацию обо всех автомобилях, для которых значение в поле Страховая 
-- стоимость автомобиля попадает в некоторый заданный интервал. 

set @min_inshurance_pay = 2000000;
set @max_inshurance_pay = 3000000;
call car_rental.query05_procedure(@min_inshurance_pay, @max_inshurance_pay);

set @min_inshurance_pay = 2000000;
set @max_inshurance_pay = 5000000;
call car_rental.query05_procedure(@min_inshurance_pay, @max_inshurance_pay);

set @min_inshurance_pay = 5000000;
set @max_inshurance_pay = 7000000;
call car_rental.query05_procedure(@min_inshurance_pay, @max_inshurance_pay);

set @min_inshurance_pay = 7000000;
set @max_inshurance_pay = 12000000;
call car_rental.query05_procedure(@min_inshurance_pay, @max_inshurance_pay);


-- 6 (Запрос с вычисляемыми полями)
-- Вычисляет для каждого автомобиля величину выплачиваемого страхового взноса. Включает поля Госномер автомобиля, 
-- Модель автомобиля, Год выпуска автомобиля, Страховая стоимость автомобиля, Страховой взнос. Сортировка по полю 
-- Год выпуска автомобиля

call car_rental.query06_procedure();
    

-- 7 (Итоговый запрос)
-- Выполняет группировку по полю Модель автомобиля. Для каждой модели вычисляет минимальную страховую стоимость 
-- автомобиля.

call car_rental.query07_procedure();
	

-- 8 (Итоговый запрос)
-- Выполняет группировку по полю Код клиента. Для каждого клиента вычисляет минимальное и максимальное значения по 
-- полю Количество дней проката

call car_rental.query08_procedure();
