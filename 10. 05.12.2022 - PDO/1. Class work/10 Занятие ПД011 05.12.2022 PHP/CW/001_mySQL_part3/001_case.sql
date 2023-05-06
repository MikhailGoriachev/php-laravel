use hwe_insurance_05122020;

/* 
Оператор CASE используется для создания внутри хранимой процедуры MySQL сложной 
условной конструкции. Оператор CASE не может содержать блок ELSE NULL и должен 
закрываться END CASE, а не END. Синтаксис:

CASE переменная    
    WHEN значение THEN список_операторов         
    [WHEN значение THEN список_операторов] 
    ...         
    [ELSE список_операторов] 
END CASE;

CASE     
    WHEN выражение THEN список_операторов         
    [WHEN выражение THEN список_операторов] ...         
    ...
    [ELSE список_операторов] 
END CASE;
*/

/*
Подсчитаем количество сотрудников, удовлетворяющих следующим условиям:

MIN_SALARY > 10000
MIN_SALARY < 10000
MIN_SALARY = 10000
Для этого мы используем следующую процедуру (MySQL хранимой процедуры пример создан в MySQL Workbench ^5.2 CE):
*/
DELIMITER %%
drop procedure if exists my_proc_CASE%%
CREATE PROCEDURE my_proc_CASE(INOUT no_employees INT, IN salary INT)
BEGIN
	CASE
		WHEN salary>10000 
		THEN SELECT COUNT(job_id) INTO no_employees 
			  FROM jobs 
			  WHERE min_salary>10000;
		WHEN (salary<10000) 
		THEN (SELECT COUNT(job_id) INTO no_employees 
			  FROM jobs 
	          WHERE min_salary<10000);
		ELSE (SELECT COUNT(job_id) INTO no_employees 
	          FROM jobs WHERE min_salary=10000);
	END CASE;
END%%

-- вернуть количество договоров 
drop procedure if exists demo_case%%
create procedure demo_case(in summa int, out no_contracts int)
begin
        
    case
        when summa < 1000000 then
            select 
                count(id_client) into no_contracts
            from
                contracts
            where
                amount < 1000000;
        when summa = 1000000 then
            select 
                count(id_client) into no_contracts
            from
                contracts
            where
                amount = 1000000;
        when summa > 1000000 then
            select 
                count(id_client) into no_contracts
            from
                contracts
            where
                amount > 1000000;                
    end case;
end%%
DELIMITER ;

set @result = 0;
call demo_case(1000001, @result);
select @result;

-- тестовый оператор, меняем 100000, 1000000, 10000000
select 
    count(id_client)
from
    contracts
where
    amount > 1000000;

use db;
DELIMITER %%
drop procedure if exists goodsCounters%%
CREATE PROCEDURE goodsCounters(INOUT no_goods INT, IN price INT)
BEGIN
	CASE
		WHEN price>120 
		THEN SELECT COUNT(id) INTO no_goods 
			  FROM goods 
			  WHERE goods.price>120;
		WHEN price<150 
		THEN SELECT COUNT(id) INTO no_goods 
			  FROM goods 
	          WHERE goods.price<150;
		ELSE 
              SELECT COUNT(id) INTO no_goods 
	          FROM goods WHERE goods.price=price;
	END CASE;
END%%

set @r = 0;
call goodsCounters(@r, 100);
select @r;
