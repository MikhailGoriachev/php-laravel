-- раскомментировать по одному
-- show character set;  -- показать поддерживаемые кодировки
-- show collation;      -- показать возможные типы сортировки
-- show engines;        -- показать возможные движки БД, формат таблиц

/*  
  MyISAM - "родной" формат, быстрее, но не надежный
  InnoDB - надежный, с транзакциями и внешними ключами, но медленнее
*/

-- если в имени пробелы или имя совпадает с ключевым словом - заключаем имя в ``
create database db;    -- создание БД   create database ИмяББ;
use db;                -- выбор БД      use имяБД;

/* 
create table имяТаблицы (
   имяПоля1 тип1 опцииПоля1,
   ...
)  опцииТаблицы;

опцииПоля1 - auto_increment, primary key, default, not null, character set, collate
опцииТаблицы - engine 

*/
-- пример создания таблицы с явным указанием  движка
create table goods (
    id    int primary key auto_increment,
    `name` varchar(80) not null default 'Нет названия',
    amount int not null default 0,
    price decimal(15, 2) not null default 0 
) engine InnoDB;

-- удаление таблицы
-- drop table goods;

show tables from db;               -- показать таблицы в БД
show columns from goods from db;   -- показать поля таблицы в БД 

-- пример просмотра данных в БД world из БД db
use world;          -- перешли в соседнюю БД
describe db.goods;  -- данные о таблице в БД db
use db;             -- вернулись



