use db;
/*
  delete from имяТаблицы
  where
      условияВыбораЗаписей
  limit количество;
  
  удаление всех записей из таблицы
  truncate table имяТаблицы;  
*/

delete from 
    goods
where
    price > 1000
limit 1;    
    
 -- дефрагментация после большого числа удалений   
 optimize table goods;   -- InnoDB не поддерживает операцию
 
 -- восстановление при нарушении целостности данных
 repair table goods;     -- InnoDB не поддерживает операцию