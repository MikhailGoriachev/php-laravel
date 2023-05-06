use db;

set @counter = 0;
call db.goodsCounter(@counter); 

-- работаем только с локальноq переменной
-- select @counter as counter;

-- переменная @result определена в другом скрипте (003_query_on_proc.sql)
select @result as result, @counter as counter;

-- будет ошибка при выполнении - это выходной параметр
-- он не может быть константой 
-- call db.goodsCounter(150);

-- входной параметр этой процедуры может быть константой
call db.goodsList(1500);

-- показать системные переменные (не пользовательские)
show variables;
show variables like 'result';