-- подключение к базе данных
use car_rental;

-- 1 (Запрос на выборку) 
-- Выбирает из таблицы АВТОМОБИЛИ информацию об автомобилях, стоимость одного дня проката которых 
-- меньше 1900

set @max_rental = 1900;

select
	*
from
	cars_view
where
	rental < @max_rental;


-- 2 (Запрос на выборку)
-- Выбирает из таблицы АВТОМОБИЛИ информацию об автомобилях, страховая стоимость которых находится в 
-- диапазоне от 2 000 000 до 3 000 000

set @min_inshurance_pay = 2000000;
set @max_inshurance_pay = 3000000;

select
	*
from
	cars_view
where
	inshurance_pay between @min_inshurance_pay and @max_inshurance_pay;
    

-- 3 (Запрос на выборку)
-- Выбирает из таблиц КЛИЕНТЫ, АВТОМОБИЛИ и ПРОКАТ информацию о клиентах, серия-номер паспорта которых 
-- начинается с цифры «2». Включает поля Код клиента, Паспорт, Дата начала проката, Количество дней проката, 
-- Модель автомобиля

set @start_passport = '2';

select
	*
from
	rentals_view
where
	passport regexp concat('^', @start_passport);


-- 4 (Запрос на выборку)
-- Выбирает из таблицы КЛИЕНТЫ и ПРОКАТ информацию о клиентах, бравших автомобиль напрокат в некоторый 
-- определенный день. 

set @selected_date = '2021-11-01';

select
	*
from
	rentals_view
where
	date_start = @selected_date;


-- 5 (Запрос на выборку)
-- Выбирает из таблицы АВТОМОБИЛИ информацию обо всех автомобилях, для которых значение в поле Страховая 
-- стоимость автомобиля попадает в некоторый заданный интервал. 

set @min_inshurance_pay = 2000000;
set @max_inshurance_pay = 3000000;

select
	*
from
	cars_view
where
	inshurance_pay between @min_inshurance_pay and @max_inshurance_pay;


-- 6 (Запрос с вычисляемыми полями)
-- Вычисляет для каждого автомобиля величину выплачиваемого страхового взноса. Включает поля Госномер автомобиля, 
-- Модель автомобиля, Год выпуска автомобиля, Страховая стоимость автомобиля, Страховой взнос. Сортировка по полю 
-- Год выпуска автомобиля

-- размер выплачиваемого страхового зноса в процентах
set @percent = 10;

select
	*,
    inshurance_pay * (@percent / 100) as inshurance_pay_value
from
	cars_view
order by
	year_manufacture;
    

-- 7 (Итоговый запрос)
-- Выполняет группировку по полю Модель автомобиля. Для каждой модели вычисляет минимальную страховую стоимость 
-- автомобиля.

select
	brand_name,
    min(inshurance_pay) as min_insgurance_pay,
    avg(inshurance_pay) as avg_insgurance_pay,
    max(inshurance_pay) as max_insgurance_pay,
    count(*) as count
from
	cars_view
group by
	brand_name;
	


-- 8 (Итоговый запрос)
-- Выполняет группировку по полю Код клиента. Для каждого клиента вычисляет минимальное и максимальное значения по 
-- полю Количество дней проката

select
	id_client,
    last_name,
    first_name,
    patronymic,
    passport,
    min(duration) as min_duration,
    avg(duration) as avg_duration,
    max(duration) as max_duration
from
	rentals_view
group by
	id_client, last_name, first_name, patronymic, passport
order by
	id_client;