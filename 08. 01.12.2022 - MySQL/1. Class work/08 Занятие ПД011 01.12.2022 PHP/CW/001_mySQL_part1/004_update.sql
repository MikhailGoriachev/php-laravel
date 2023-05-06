-- схема db становится текущей
use db;

/* 
  обновление записей
  update имяТаблицы
      set поле1 = значение1, поле2 = значение2, ...
  where
      условияВыбораЗаписей
  limit количество;
  
  Выключение безопасного режима update/delete без предложения where:
  Edit -> Preferences... -> SQL Editor -> checkbox Safe Update
      
  условия выбора записей: 
      < <= = != <> >= >
      between value1 and value2
      in (списокЗначений)
      not in (списокЗначений)
      is null
      is not null
      like SQLшаблон            SQLшаблон: % - любое к-во любых символов, _ один символ       
      not like SQLшаблон
      
      regexp выражение       !! регулярное выражение !!
      not regexp выражение
      
      логические операции not and or xor
      x      y      not x   not y   x and y   x or y   x xor y
      false  false  true    true    false     false    false -- т.к. x == y
      false  true   true    false   false     true     true  -- т.к. x != y
      true   false  false   true    false     true     true  -- т.к. x != y
      true   true   false   false   true      true     false -- т.к. x == y
      
      xor дает true если операнды не равны друг другу
      
*/
use db;
update goods
    set price = price + 20
 where              -- отключить safe mode в prefernces 
    price < 500
limit 1;  -- ограничение выполняемых обновлений, в д.с. только первая запись, удовлетворяющая
          -- условию будет обновлена
          