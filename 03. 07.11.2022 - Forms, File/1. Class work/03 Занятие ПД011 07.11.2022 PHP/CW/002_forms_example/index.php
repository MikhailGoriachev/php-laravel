<!DOCTYPE html>
<!-- пример формы с обработкой -->
<html lang="ru">
<head>
	<meta charset="utf-8">
    <title>Форма с обработкой</title>
    <link href="styles.css" rel="stylesheet" />
</head>
<body>
    <h2>Анкета абитуриента</h2>

    <!-- обработка формы - в файле anketa.php -->
    <form action="anketa.php" method="post">
        <label>Введите имя:</label><br>
        <label for="firstname"></label><input type="text" name="firstname" required /><br>

        <p>Форма обучения:<br>
            <label>
                <input type="radio" name="eduform" value="стационарная"/>
                стационарная
            </label><br>
            <label>
                <input type="radio" name="eduform" value="заочная"/>
                заочная
            </label>
        </p>
        <br>

        <label><input type="checkbox" name="hostel" />Требуется общежитие</label>
        <label><input type="checkbox" name="prof" />Требуется профилакторий</label>
        <label><input type="checkbox" name="feed" />Требуется питание</label>

        <p>
            <label>
                Выберите курсы: <br>
                <!-- [] указывают движку php, что передается массив значений -->
                <select name="courses[]" size="7" multiple>
                    <option value="C++">Разработка CGI-скриптов на C++</option>
                    <option value="PHP">Продвинутый PHP</option>
                    <option value="C#">C# для веб-разрабтчика</option>
                    <option value="Python">Python для веб (Django, Flask)</option>
                    <option value="Java">Java Jackarta (EE)</option>
                    <option value="Typescript">TypeScript, основы</option>
                </select>
            </label>
        </p>

        <p>Выберите факультет:<br>
            <select name="department" >
                <option value="РПО">Разработка программного обеспечения</option>
                <option value="Веб">Веб разработка</option>
                <option value="Сети">Сетевая разработка</option>
                <option value="Безопасность">Информационная безопасность</option>
            </select>
        </p>

        <p>Краткий комментарий: <br>
        <textarea name="comment" maxlength="200"></textarea></p>

        <input type="submit" value="Сохранить">
        <input type="reset" value="Отмена">
    </form>
</body>
</html>
