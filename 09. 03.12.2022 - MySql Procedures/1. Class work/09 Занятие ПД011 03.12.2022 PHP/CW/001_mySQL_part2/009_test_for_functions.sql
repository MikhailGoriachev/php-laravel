use db;

-- If15
-- Сумма двух наибольших из трех чисел
set @n11 = 3, @n21 = 2, @n31 = 1;
set @summa1 := funIf15(@n11, @n21, @n31);

set @n12 = 1, @n22 = 3, @n32 = 2;
set @summa2 := funIf15(@n12, @n22, @n32);

select @n11 as n1, @n21 as n2, @n31 as n3, @summa1 as summa_biggest
union all
select @n12, @n22, @n32, @summa2;


set @min1 = funGetMin();
select @min1;


select funGetMin() as min;


set @sum1 := funSumMinMax();
select @sum1;
