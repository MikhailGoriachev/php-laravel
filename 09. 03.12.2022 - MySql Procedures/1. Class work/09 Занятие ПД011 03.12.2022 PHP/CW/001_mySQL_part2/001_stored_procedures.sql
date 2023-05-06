use library;
-- Хранимые процедуры

-- подмена разделителя - знака конца исполняемой директивы MySQL
delimiter $$ 

drop procedure if exists Hello$$

-- in    - входной параматр 
-- out   - выходной параметр 
-- inout - и входной и выходной параметр
-- квалификатор имя тип 
create procedure Hello(inout result double)
begin
   -- использование параметра процедуры - без знака @
   -- операция присваиания :=
   set result := result + 1;
   select result as result_in_proc;
end$$

-- возврат разделителя
delimiter ;  