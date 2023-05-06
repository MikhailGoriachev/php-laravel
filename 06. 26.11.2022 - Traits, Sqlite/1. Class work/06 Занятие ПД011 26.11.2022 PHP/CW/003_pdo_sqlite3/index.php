<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh"/>
    <title>введение в PDO</title>

    <!-- подключение файла-иконки -->
    <link rel="shortcut icon" href="imgs/broom.png" type="image/x-icon">

    <!-- подключение bootstrap -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- подключение собственных стилей -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
    <h3 class="my-3">Введение в PDO</h3>

    <?php
    // PDO - Php Data/Database Objects

    // открыть в php.ini:
    // extension=curl
    // extension=pdo_sqlite
    // extension=sqlite3

    // подключение к базе данных SQLite3
    //                  драйвер:файл_бд
    $db = new PDO('sqlite:./app_data/books2.db');

    /*
    // Читаем таблицу базы и выводим определённый столбец
    // создание и выполнение запроса
    $st = $db->query('select id from books');

    // выборка данных
    $results = $st->fetchAll();

    echo "<h4 class='m-3'>Вывод столбца таблицы</h4>";
    // обход выбранных данных
    echo "<ul class='list-group'>";
    foreach ($results as $row) {
        echo "<li class='list-group-item'>{$row['id']}</li>";
    }
    echo "</ul>";
    */

    /*
    // Читаем таблицу базы данных и строим таблицу HTML c выводом этих данных
    $query = "
    select 
        *
    from
        books;   
    ";

    // создать и выполнить запрос, прочитать результат
    $st = $db->query($query);
    $results = $st->fetchAll();

    // обход результата
    echo "<h4 class='m-3'>Таблица <u>books</u> без расшифровки полей</h4>
      <table class='table w-50 m-3'>
      <tr><th>id</th><th>idAuthor</th><th>idCategory</th><th>title</th><th>year</th><th>price</th><th>amount</th></tr>";
    foreach ($results as $row) {
        echo "
        <tr>
        <td>{$row['id']}</td>
        <td>{$row['idAuthor']}</td>
        <td>{$row['idCategory']}</td>
        <td>{$row['title']}</td>
        <td>{$row['year']}</td>
        <td>{$row['price']}</td>
        <td>{$row['amount']}</td>
        </tr>";
    }
    echo "</table>";
    */

    // выполненеи запроса в функции
    function viewBooks($db, $caption = "Табличный вывод")
    {
        // Читаем таблицу базы данных и строим HTML-таблицу
        $query = "
        select
            books.id
            , authors.name as author
            , categories.category
            , books.year
            , books.title
            , books.price
            , books.amount
        from
             books join authors on books.idAuthor = authors.id
                   join categories on books.idCategory = categories.id
    ";

        // создать и выполнить запрос, прочитать результат
        $st = $db->query($query);
        $results = $st->fetchAll();

        // обход результата
        echo "<h4 class='m-3'>$caption</h4>
          <table class='table table-bordered w-75'>
          <tr><th>id</th><th>author</th><th>category</th><th>title</th><th>year</th><th>price</th><th>amount</th></tr>";
        foreach ($results as $row) {
            echo "
        <tr>
        <td>{$row['id']}</td>
        <td>{$row['author']}</td>
        <td>{$row['category']}</td>
        <td>{$row['title']}</td>
        <td>{$row['year']}</td>
        <td>{$row['price']}</td>
        <td>{$row['amount']}</td>
        </tr>";
        }
        echo "</table>";
    }

    /*
    // вывод таблицы
    viewBooks($db);

    // скалярный запрос
    $stat = $db->query('select COUNT(id) from books')->fetchColumn();
    echo "<p>Всего записей в таблице books: $stat</p>";
    */

    /*
    // Обновление записи в таблице
    $id = 3;
    $db->exec("UPDATE books SET amount=amount+1  WHERE id = $id;");
    $amount = $db->query("select amount from books where id = $id;")->fetchColumn();
    viewBooks($db, "Увеличили количество книги с id = $id, новое количество: $amount");
    */

    /*
    // Вставка записи в таблицу
    $query = "
    INSERT INTO  books 
        (idAuthor, idCategory, title, year, price, amount) 
    VALUES 
        (1, 1, 'Самоучитель по PHP 7', 2019, 700, 5)";
    $db->exec($query);
    viewBooks($db, "Добавлена книга по PHP");
    */

    /*
    // Удаление записи/записей в таблице
    // удалим записи о книгах, в названиях которых есть строка 'PHP'
    $param = "PHP";
    $query = "
    delete from 
        books 
    WHERE 
        books.title like '% $param %' or 
        books.title like '% $param' or
        books.title like '$param %'; ";

    $db->exec($query);
    viewBooks($db, "Удалена книга/книги по PHP");
    */
    ?>

    <h3>Подготовленные запросы</h3>
    <?php
    // подготовленный запрос
    // $stmt = $db->prepare()  подготовка
    // $stmt->bindParam();     привязка параметра 1
    // ...
    // $stmt->bindParam();     привязка параметра N
    // $stmt->execute()  выполнение запроса

    // Обновление записи в таблице
    $id = 3;
    // пример с анонимными параметрами
    $stmt = $db->prepare("UPDATE books SET amount=amount+1  WHERE id = ?;");
    $stmt->execute([$id]);

    // пример с именованными параметрами
    $stmt = $db->prepare("select amount from books where id = :id;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    $amount = $row['amount'];
    viewBooks($db, "Увеличили количество книги с id = $id, новое количество: $amount");

    $id = 3;
    $stmt = $db->prepare("UPDATE books SET amount=amount+1  WHERE id = :id;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $stmt = $db->prepare("select amount from books where id = :id;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    $amount = $row['amount'];
    viewBooks($db, "Увеличили количество книги с id = $id, новое количество: $amount");

    $author = 'Шилдт Г.';
    $year = 2002;
    selectBooks($db, $author, $year, "Книги автора <b>$author</b> изданные после <b>$year</b>");

    // выборка данных из таблицы с использованием параметров
    function selectBooks($db, $author, $year, $caption){
        // Читаем таблицу базы данных и строим HTML-таблицу
        $sql = "
            select
                books.id
                , authors.name as author
                , categories.category
                , books.year
                , books.title
                , books.price
                , books.amount
            from
                 books join authors on books.idAuthor = authors.id
                       join categories on books.idCategory = categories.id
            where
                authors.name = :author and books.year > :year
        ";

        // создать и выполнить запрос, прочитать результат
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();

        // обход результата
        echo "<h4 class='m-3'>$caption</h4>
          <table class='table table-bordered w-75'>
          <tr><th>id</th><th>author</th><th>category</th><th>title</th><th>year</th><th>price</th><th>amount</th></tr>";
        while ($row = $stmt->fetch()) {
            echo "
                <tr>
                <td>{$row['id']}</td>
                <td>{$row['author']}</td>
                <td>{$row['category']}</td>
                <td>{$row['title']}</td>
                <td>{$row['year']}</td>
                <td>{$row['price']}</td>
                <td>{$row['amount']}</td>
                </tr>";
        }
        echo "</table>";
    }

    ?>
</div>
</body>
</html>
