use library;

-- работа с переменными вне хранимых процедур/функций
set @result = 0;

-- вызов хранимой процедуры
call library.Hello(@result);
select @result as result_out;

set @result := 100;
set @a := 10;
set @result := @result + @a;

-- вывести несколько переменных в виде таблмцы
--     имя переменой       значение переменной
select 'result' as `name`, @result as `value`
union all
select 'a', @a
union all
select 'итого', 'получилось';

-- переменная @result все еще существует
call library.Hello(@result);
select @result as result;

   

