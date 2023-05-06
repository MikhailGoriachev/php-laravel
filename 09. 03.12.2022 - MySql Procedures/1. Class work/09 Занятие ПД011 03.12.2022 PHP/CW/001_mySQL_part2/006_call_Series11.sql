use db;

-- запускать со значениями 25 и -25
set @response = 0;
call db.Series11(-5, 10, @response);

-- использование case в запросе select
select case when @response = true then 'TRUE' when @response = false then 'FALSE' end as Series11;

/*
-- !! if допустим только в  хранимых процедурах и функциях 
if @response = 1 then
	select 'TRUE';
else
    select 'FALSE';
end if;
*/

    
