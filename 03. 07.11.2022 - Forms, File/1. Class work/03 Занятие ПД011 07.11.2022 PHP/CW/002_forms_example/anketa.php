<!DOCTYPE html>
<!-- пример формы с обработкой -->
<html lang="ru">
<head>
	<meta charset="utf-8">
    <title>Форма с обработкой</title>
    <link href="styles.css" rel="stylesheet" />
</head>

<body>
    <h3>Обработка анкеты абитуриента</h3>

    <?php
    if(isset($_POST['firstname']) && isset($_POST['eduform']) &&
        isset($_POST['courses']) && isset($_POST['comment'])) {

        // строка ввода
        $name = htmlentities($_POST['firstname']);

        // радиокнопка
        $eduform = $_POST['eduform'];

        // парсинг чек-боксов, если он не установлен то его просто нет в $_POST, $_GET
        $hostel = isset($_POST['hostel']);
        $prof = isset($_POST['prof']);
        $feed = isset($_POST['feed']);

        $comment = htmlentities($_POST['comment']);

        // так просто получаем массив, точнее ссылку на массив
        $courses = $_POST['courses'];

        $department = $_POST['department'];

        $output ="
            <ul>
            <li>Вас зовут: <b>$name</b></li>
            <li>Форма обучения: <b>$eduform</b></li>
            <li>Требуется общежитие: <b> " . ($hostel? 'да':'нет') . "</b></li>
            <li>Требуется профилакторий: <b>" . ($prof? 'да':'нет') . "</b></li>
            <li>Требуется бесплатное питание: <b>" . ($feed? 'да':'нет') . "</b></li>
        
            <li>Выбранные курсы:
            <ul>";

        foreach($courses as $course)
            $output.="<li><b>" . htmlentities($course) . "</b></li>";

        // операция .=
        $output .= "
            </ul></li>
            <li>Факультет: <b>$department</b></li>
            <li>Комментарий: <i>$comment</i></li>
            </ul>";
        echo $output;
    } else {
        echo "<h3 style='color: red'>Не все поля заполнены корректно</h3>";
    }
    ?>
    <br/>
    <a href="index.php">На ввод данных</a>
</body>
</html>
