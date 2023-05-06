use db;

/* 
	Модификация таблицы
    alter table имяТаблицы преобразование;
    
    преобразование:
    rename новоеИмя                    - переименовать таблицы
    add имяПоля типПоля first          - вставка столбца первым
    add имяПоля типПоля after имяПоля  - вставка столбца после указанного столбца
    change староеИмяПоля новоеИмяПоля типПоля опцииПоля
           опцииПоля - auto_increment, null, ...
           
*/

alter table goods
      change price cost int not null default 0;
      
      
 alter table goods
      change cost price decimal(15, 2) not null default 0;
           