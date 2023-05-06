/* 
ввод данных в таблицу 
insert into имяТаблицы (список полей для ввода) 
       values (список значений);
       
insert into имяТаблицы (список полей для ввода) 
       values (список значений1),
       ...
       values (список значенийN);
       
 insert  into имяТаблицы
	   set имяПоля1 = значение1, имяПоля2 = значение2, ...;
 !! для автоинкрементных полей - null или явно заданное значение  
 
 replace into ... - замена данных с существующими id
 
 если id уникальный то replace == insert

*/

-- переход в указанную схему данных
use db;

-- пример на добавление данных
-- подзапросы допустимы в списке значений для вставки
insert into goods (id, name, `amount`, price, id_category)
    values
	(11, 'Погремушка новая', 1, 100, (select id from categories where category = 'игрушки')),
    (12, 'Машинка заводная', 1, 110, (select id from categories where category = 'игрушки')),
    (13, 'Пирамидка пластиковая', 1, 180, (select id from categories where category = 'игрушки')),
    (14, 'Шарик резиновый', 1, 300, (select id from categories where category = 'игрушки'));
       
-- пример на замену данных с существующеми идентфикаторами        
 replace into goods (id, `name`, amount, price, id_category)
    values
	(11, 'Спиннер Класссный', 2, 200, 5),
    (12, 'Альф Милый', 3, 1100, 5),
    (13, 'Котик Миша', 4, 820, 5),
    (14, 'Змейка Маша', 5, 550, 5); 
    
-- пример replace == insert    
replace into goods (id,  `name`, amount, price, id_category)
    values
	(null, 'Погремушка Шар', 1, 100, 1),   -- null - требование уникального id
    (null, 'Машинка Тесла', 3, 110, 1),
    (null, 'Пирамидка Хуфу', 2, 180, 1),
    (null, 'Шарик Розовый', 1, 300, 1);   

-- можно не указывать поля, при условии задания всех данных    
replace into goods values
	(null, 'Погремушка Мяч', 1, 100, 5),   -- null - требование уникального id
    (null, 'Машинка Зайка', 3, 110, 5);  