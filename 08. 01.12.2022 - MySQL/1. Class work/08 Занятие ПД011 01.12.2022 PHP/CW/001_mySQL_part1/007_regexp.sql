/* 
REGEXP позволяет задать регулярное выражение, которому должно соответствовать значение 
столбца. В этом плане REGEXP представляет более изощренный и комплексный способ фильтрации, 
нежели оператор LIKE. 

REGEXP имеет похожий синтаксис:

WHERE выражение [NOT] REGEXP регулярное выражение

Регулярное выражение может принимать следующие специальные символы:

^: указывает на начало строки
$: указывает на конец строки
.: соответствует любому одиночному символу
[символы]: соответствует любому одиночному символу из скобок
[начальный_символ-конечный_символ]: соответствует любому одиночному символу из диапазона символов
|: отделяет два шаблона строки, и значение должно соответствовать одну из этих шаблонов

Примеры REGEXP:
    WHERE ProductName REGEXP 'Phone': строка должна содержать "Phone", например, iPhone X, Nokia Phone N, iPhone
    WHERE ProductName REGEXP '^Phone': строка должна начинаться с "Phone", например, Phone 34, PhoneX
    WHERE ProductName REGEXP 'Phone$': строка должна заканчиваться на "Phone", например, iPhone, Nokia Phone
    WHERE ProductName REGEXP 'iPhone [78]';: строка должна содержать либо iPhone 7, либо iPhone 8    
    WHERE ProductName REGEXP 'iPhone [6-8]';: строка должна содержать либо iPhone 6, либо iPhone 7, либо iPhone 8

Например, найдем товары, названия которых содержат либо "Phone", либо "Galaxy":
SELECT 
    * 
FROM 
    Products
WHERE 
    ProductName REGEXP 'Phone|Galaxy';
*/
use library;

 -- выбрать книги по Android 
select
    *
from
    books
where
    title regexp 'Android'; 
 
 -- выбрать учебники по C++ 
select
    books.id
    , authors.`name`
    , books.title
    , categories.category
    , books.`year`
    , books.price
from
    books join authors on books.idAuthor = authors.id
          join categories on books.idCategory = categories.id
 where
     categories.category = 'учебник' 
     and
     books.title regexp 'C\\+\\+'
;    

-- выбрать учебники по C++ или по C# 
select
    books.id
    , authors.`name`
    , books.title
    , categories.category
    , books.`year`
    , books.price
from
    books join authors on books.idAuthor = authors.id
          join categories on books.idCategory = categories.id
 where
     categories.category = 'учебник' 
     and
     books.title regexp 'C[+#]'
; 

-- выбрать книги кроме LINQ, Android, C++ и C# 
select
    books.id
    , authors.`name`
    , books.title
    , categories.category
    , books.`year`
    , books.price
from
    books join authors on books.idAuthor = authors.id
          join categories on books.idCategory = categories.id
 where
     books.title not regexp 'LINQ|Android|C#|C++'
; 