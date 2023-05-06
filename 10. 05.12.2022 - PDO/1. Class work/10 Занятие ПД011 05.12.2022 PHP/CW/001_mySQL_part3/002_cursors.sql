/*
MySQL: курсоры
CURSOR - CURrent Set Of Rows

Курсор представляет собой структуру управления, которая позволяет обрабатывать 
записи в базе данных. Курсоры используются для обработки отдельных строк, 
возвращаемых в ответ на запросы системой базы данных. 
Курсор включает строки в набор результатов, чтобы последовательно их обработать.

В процедурах SQL курсор позволяет определить результирующий набор (набор строк данных) 
и выполнить сложную логику построчно. Используя те же механизмы, процедура SQL также 
может определить набор результатов и вернуть его непосредственно вызывающему агенту 
или в клиентское приложение.

MySQL хранимые процедуры поддерживают курсоры. Синтаксис тот же, что и для встроенного SQL. 
Курсоры имеют следующие свойства:

Asensitive: сервер может или не может создавать копию таблицы результатов;
Read only: не обновляемые;
Nonscrollable: обработка может производиться только в одном направлении, при этом пропуск 
               строк не допускается.
Чтобы использовать курсор в процедурах MySQL, нужно сделать следующее:

Объявить курсор;
Открыть курсор;
Извлечь данные в переменные;
Закрыть курсор;

Объявление курсора
Следующий оператор объявляет курсор и связывает его с оператором SELECT. 
Он извлекает строки, которые будут перемещаться с помощью курсора:

DECLARE имя_курсора CURSOR FOR оператор_select;

Открытие курсора
После объявления мы открываем объявленный курсор:
OPEN имя_курсора;

Выборка данных в переменные
FETCH выбирает строки для оператора SELECT, связанного с указанным курсором (который должен быть открыт), 
и перемещает указатель курсора. Если строка существует, то выбранные столбцы сохраняются в указанных переменных. 
Число столбцов извлекаемых SELECT должно соответствовать количеству выходных переменных, указанных в FETCH:

FETCH [[NEXT] FROM] имя_курсора INTO имя_переменной [,имя_переменной] ...;

Закрытие курсора
Этот оператор закрывает ранее открытый курсор. Если курсор не открыт, 
возникает ошибка:
CLOSE имя_курсора;

*/
use db;
DELIMITER $$

drop procedure if exists my_procedure_cursors;
CREATE PROCEDURE my_procedure_cursors(INOUT return_val INT)
BEGIN
    -- начальное значене переменных - 0 соответствующего типа
    DECLARE a, b INT; 
    declare sum int;
    DECLARE cur_1 CURSOR FOR SELECT price FROM goods;
    
    -- обработка события "NOT FOUND", возникающего при достижения 
    -- конца набора данных, в данном случае когда курсор дошел 
    -- до конца таблицы
    -- в обработчике: b = 1 (уствновить b в 1)
    DECLARE CONTINUE HANDLER FOR NOT FOUND 
       SET b := 1;
    
    OPEN cur_1;  
    -- открыть курсор
    REPEAT                        -- цикл для обход курсора
        FETCH cur_1 INTO a;       -- читаем из курсора очередную порцию 
        SET return_val := return_val + a;
    UNTIL b = 1                   -- условия выхода 
    END REPEAT;
    
    CLOSE cur_1;                  -- закрыть курсор
END;
$$  -- DELIMITER ;

set @r = 0;
call db.my_procedure_cursors(@r);
select @r as sumPrise;

-- --------------------------------------------------------------------------------

-- пример https://riptutorial.com/ru/mysql/example/15257/%D0%BA%D1%83%D1%80%D1%81%D0%BE%D1%80%D1%8B

-- Курсоры позволяют повторять результаты запроса по очереди. Команда DECLARE используется 
-- для инициализации курсора и связывания его с конкретным SQL-запросом:

-- DECLARE student CURSOR FOR SELECT name FROM studend;

-- Предположим, мы продаем продукты некоторых типов и хотим подсчитать, какое количество продуктов 
-- каждого типа существует.
create schema store default character set utf8;
use store;

-- Наши данные:

CREATE TABLE products
(
  id   INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  type VARCHAR(50)      NOT NULL,
  name VARCHAR(255)     NOT NULL

);
CREATE TABLE product_types
(
  name VARCHAR(50) NOT NULL PRIMARY KEY
);
CREATE TABLE product_type_counts
(
  type  VARCHAR(50)      NOT NULL PRIMARY KEY,
  count INT UNSIGNED NOT NULL DEFAULT 0
);

INSERT INTO product_types (name) VALUES
  ('dress'),
  ('food');

INSERT INTO products (type, name) VALUES
  ('dress', 'T-shirt'),
  ('dress', 'Trousers'),
  ('food', 'Apple'),
  ('food', 'Tomatoes'),
  ('food', 'Meat');

-- Мы можем решить задачу с помощью хранимой процедуры с помощью курсора:

DELIMITER //
DROP PROCEDURE IF EXISTS product_count//
CREATE PROCEDURE product_count()
  BEGIN
    DECLARE p_type VARCHAR(255);
    DECLARE p_count INT UNSIGNED;
    DECLARE done INT DEFAULT 0;        -- флаг завершения
    
    DECLARE product CURSOR FOR
      SELECT
        type,    -- тип товара
        COUNT(*) -- количество товара
      FROM 
        products
      GROUP BY 
        type;
        
    -- обработчик события - ошибка "Конец данных", "нет данных", "Not found"     
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

    -- очистка таблицы
    TRUNCATE product_type_counts;

    -- открыть курсор 
    OPEN product;
    
    REPEAT
      FETCH product  INTO p_type, p_count;
      
      IF NOT done THEN
        INSERT INTO 
          product_type_counts
        SET
          type  = p_type,
          count = p_count;
      END IF;
    UNTIL done  -- цикл, пока done == 0 
    END REPEAT;
    
    CLOSE product;
  END //
DELIMITER ;

-- вызвать процедуру с помощью:
CALL product_count();

/*
Результат будет в таблице product_type_count :

type   | count
----------------
dress  |   2
food   |   3
Хотя это хороший пример CURSOR , обратите внимание на то, что процедура 
может быть заменена таким запросом

INSERT INTO product_type_counts
        (type, count)
    SELECT type, COUNT(*)
        FROM products
        GROUP BY type;
Это будет работать намного быстрее.
*/