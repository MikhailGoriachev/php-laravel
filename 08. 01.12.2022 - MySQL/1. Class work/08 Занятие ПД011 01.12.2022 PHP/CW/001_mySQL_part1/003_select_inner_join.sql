use db;

/* 
select   списокПолей
from     списокТаблиц (есть inner join, left join, right join)
where    условияВыбора
group by списокПолейГруппировки
having   условиеГруппировки
order by имяПоля desc
limit    начальноеСмещение, КоличествоЗаписей
         !! начальноеСмещение - начинается с 1 


inner join        или cross join
left outer join   или left join
right outer join  или right join

Стандартный набор агрегатных функций:
count(поле)   -- количество непустых полей (т.е. не содержащих null)
count(distinct поля) -- количество непустых уникальных полей (т.е. не содержащих null)
min(поле), max(поле), sum(поле), 
avg(поле) - среднее
*/

select 
   MIN(price) as minPrice,
   MAX(price) as maxPrice,
   SUM(amount) as sumAmount,  
   AVG(price) as avgPrice,
   COUNT(price) as cntPrice,
   COUNT(distinct price) as cntUniquePrice
from
	goods;
  
use library;
select
    books.id
    , authors.`name`
    , categories.category
    , books.title
    , books.`year`
from
    books join authors on books.idAuthor = authors.id
          join categories on books.idCategory = categories.id
limit 1, 5;    