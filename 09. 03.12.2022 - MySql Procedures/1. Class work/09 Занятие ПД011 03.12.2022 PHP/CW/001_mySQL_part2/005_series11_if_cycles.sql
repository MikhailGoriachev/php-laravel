use db;

-- Series11. Даны целые числа K, N и набор из N целых чисел. Если в наборе
-- имеются числа, меньшие K, то вывести TRUE; в противном случае вывести
-- FALSE.

delimiter $$

drop procedure if exists Series11$$

create procedure Series11(in k int, in n int, out response bool) 
begin

   -- ветвление if условие then опTrue end if;
   --           if условие then опTrue else опFalse end if;
   --           if условие then опTrue elseif условие then опTrue elseif условие then ... else опFalse end if;
   -- циклы     while условиеПродолжения do ... end while;
   --           repeat ... until условиеВыхода end repeat;
   --           loop ... end loop; выход при помощи оператора leave;
   
   -- локальные переменные в процедуре
   declare i int default 0;
   declare x int;
   
   set response = false;
   
   while i < n do
       set x = -10 + 20*rand();  -- -10 .. 10
       if x < k then 
           set response = true; 
       end if;
       
       set i := i + 1;
   end while;
end$$

delimiter ;