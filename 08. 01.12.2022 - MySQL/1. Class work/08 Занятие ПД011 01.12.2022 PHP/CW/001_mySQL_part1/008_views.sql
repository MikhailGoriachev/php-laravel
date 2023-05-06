/*

MySQL: представление, view

Создать VIEW
Синтаксис
Синтаксис для оператора CREATE VIEW в MySQL:

CREATE [OR REPLACE] VIEW view_name AS
 SELECT columns
 FROM tables
 [WHERE conditions];
Параметры или аргументы
OR REPLACE       — необязательный. Если вы не укажете этот атрибут и VIEW уже существует, 
                   оператор CREATE VIEW вернет ошибку.
view_name        — имя VIEW, которое вы хотите создать в MySQL.
WHERE conditions — необязательный. Условия, которые должны быть выполнены для записей, 
                   которые должны быть включены в VIEW.

Обновить VIEW
Вы можете изменить определение VIEW в MySQL, не удаляя его с помощью оператора ALTER VIEW.

Синтаксис
Синтаксис оператора ALTER VIEW в MySQL:

ALTER VIEW view_name AS
 SELECT columns
 FROM table
 WHERE conditions;
 
Удалить VIEW
Когда в MySQL создается VIEW, вы можете удалить его с помощью оператора DROP VIEW.

Синтаксис
Синтаксис оператора DROP VIEW в MySQL:

DROP VIEW [IF EXISTS] view_name;
Параметры или аргументы
view_name — имя представления, которое вы хотите удалить.
IF EXISTS — необязательный. Если вы не укажете этот атрибут и VIEW не существует,
             оператор DROP VIEW выдаст ошибку.

*/
use electric_transport;

-- создание представления
create or replace view electric_transport_view as
select 
    rolling_stock.id
    , `types`.`type`
    , rolling_stock.paxes
    , rolling_stock.marka
    , rolling_stock.`number`
from
    rolling_stock join types on rolling_stock.id_type = `types`.id;    

-- чтение из представления
select
    *
from
     electric_transport_view;  

-- изменение представления    
alter view electric_transport_view as
select 
    rolling_stock.id
    , `types`.`type`
    , rolling_stock.marka
    , rolling_stock.`number`
from
    rolling_stock join `types` on rolling_stock.id_type = `types`.id;  
 
 -- удаление представления
DROP VIEW IF EXISTS electric_transport_view;     