use db;

/* 
МеткаЦикла:
    repeat 
        операторы;
        ...
        -- переход на условие продолжения / завершения
        if условие then iterate МеткаЦикла; end if
        ...
		-- выход из цикла
        if условие then leave МеткаЦикла; end if
        ...
    until условиеЗавершения 
    end repeat МеткаЦикла;
*/

-- Замена разделителя 
delimiter $$

-- Minmax15
-- Даны числа B, C (0 < B < C) и набор из десяти чисел. Вывести
-- максимальный из элементов набора, содержащихся в интервале [B, C],
-- и его номер. Если требуемые числа в наборе отсутствуют, то дважды вывести 0.
drop procedure if exists demo_repeat_until$$

create procedure demo_repeat_until(in b double, in c double, in n int, out max double, out pos int) 
begin
	-- объявление переменных
    declare i int default 0;
	declare `number` double;
    set max := 0, pos := -1; 

	-- Проверка на допустимые значения
	if (0 < b and b < c) then 
		repeat
			set `number` = -10 + 20*rand();
            -- Если число находится в данном промежутке и больше максимального, присвоить новое значение
			if ((`number` between b and c) and `number` > max) then 
				set pos := i + 1;
				set max := `number`; 
			end if;
			
			set i := i + 1;
		until i > n
        end repeat;
		
        -- Если элементов в данном диапазоне не было, то в pos записываем 0
		if (pos = -1) then 
			set pos := 0;
		end if;
    end if;
end$$

drop procedure if exists demo_leave_iterate$$

-- демонстрация leave, iterate
create procedure demo_leave_iterate(in n int, out counter int) 
begin
	-- объявление переменных
    declare i int default 0;
    set counter = 0;    -- количество обработок в цикле 

Label:
    repeat
        if i = n - 2 then 
            leave Label;   -- выход из цикла
        end if;
        
        if i % 2 != 0 then
            set i = i + 1;
            iterate Label;   -- переход на условие цикла
        end if;
                
        set counter := counter + 1;
        set i := i + 1;
    until i >= n
    end repeat Label;
end$$

drop procedure if exists demo_loop$$
create procedure demo_loop(in b double, in c double, in n int, out max double, out pos int) 
begin
	-- объявление переменных
    declare i int default 0;
	declare number double;
    set max = 0, pos = -1; 

	-- Проверка на допустимые значения   <=> for(;;) {}  while(true) {}   do {} while(true)
	if (0 < b and b < c) then 
        label_loop15: 
        loop
			set number = -10 + 20*rand();
            -- Если число находится в данном промежутке и больше максимального, присвоить новое значение
			if ((number between b and c) and number > max) then 
				set pos = i + 1;
				set max = number; 
			end if;
			
			set i = i + 1;
            if i > n then 
                -- выхоод из цикла 
                leave label_loop15; 
            end if;
        end loop label_loop15;
		
        -- Если элементов в данном диапазоне не было, то в pos записываем 0
		if (pos = -1) then 
			set pos = 0;
		end if;
    end if;
end$$

-- Proc24
-- Описать функцию Even(K) логического типа, возвращающую true, если целый параметр K является четным, 
-- и false в противном случае. С ее помощью найти количество четных чисел в наборе из 10 целых чисел.
drop function if exists proc_24$$
drop function if exists even$$

-- Проверка целого числа на четность
-- deterministic - значение функции зависит от ее паараметров
create function even(k int) 
returns bool deterministic
begin
	return (k % 2) = 0;
end$$

create function proc_24(n int) 
returns int deterministic
begin
	-- объявление переменных
    declare i int default 0;
    declare evens int default 0;
    declare number int;

    while (i < n) do
        set number = -10 + 20*rand();
        if even(number) then 
            set evens := evens + 1;
        end if;
        
        set i := i + 1;
    end while;
    
    return evens;
end$$

delimiter ;

-- --------------------------------------------------
set @counter = 0;
call  demo_leave_iterate(10, @counter);
select @counter as counter;

set @b = 2, @c = 10 ,@n = 5;
call demo_loop(@b, @c, @n, @max, @pos);
select @b, @c, @n, @max, @pos;