use db;
-- переменная будет использована в процедуре 
set @result = 0;

delimiter ::

drop procedure if exists goodsCounter::

create procedure goodsCounter(out `number` int) 
begin
    -- into имяПеременной или параметр 
    select count(*) into `number` from goods;
    select count(distinct id_category) into @result from goods;
end::

drop procedure if exists goodsList::

-- выборка данных из таблицы при помощи открытого запроса
-- вернуть таблицу из процедуры нельзя
create procedure goodsList(in price decimal)
begin
    select * from goods where goods.price > price;
end::

delimiter ;

-- ----------------------------------------
-- вызов процедуры
set @counter = 0;
call db.goodsCounter(@counter);
select @result as result, @counter as counter;

-- еще один пример вызова
call db.goodsList(560);
