/* создаем схему для демонстрации хранимых функций */
-- create schema if not exists procTest;
-- use procTest;

use db;

/* хранимые функции в MySQL

deterministic -- значение функции зависит от параметров функции

create function(параметры)
retruns типВозвращаемогоРезультата deterministic | reads sql data
begin
    операторы;
    return выражение;
end
*/

delimiter $$

-- If15
-- Даны три числа. Найти сумму двух наибольших из них
drop function if exists funIf15$$

create function funIf15(a int, b int, c int) 
returns int deterministic
begin
    declare summa int default 0;

	if a < b and a < c then
	   set summa := b + c;
	elseif b < c then
        set summa := a + c;
	else
        set summa := a + b;
    end if;
    
    return summa;
end$$

/* пример функции, значение которой не зависит от параметров
   но  функция читает SQL-данные - reads sql data
 */
drop function if exists funGetMin$$

create function funGetMin() 
returns int reads sql data
begin
   declare result int;
   select min(goods.price) into result from goods;
   return result;
end$$

drop function if exists funSumMinMax$$

-- пример использования переменных, хранящих результаты запросов
create function funSumMinMax() 
returns int reads sql data
begin
   declare result int;
   declare minValue int;
   declare `maxValue` int; -- `` - использование синонима системной переменной
   
   -- `` - использование ключевых слов в именах таблиц
   select min(goods.price) into minValue from goods;
   select max(goods.price) into `maxValue` from goods;
   
   -- пример использования переменных, хранящих результат запроса
   set result := minValue + `maxValue`;
   
   return result;
end$$

delimiter ;