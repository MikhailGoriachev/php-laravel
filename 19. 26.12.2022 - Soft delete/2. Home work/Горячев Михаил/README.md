<h3>Теоретическая часть</h3>
<ul>
    <li>Вычисляемые поля в запросах ORM Eloquent</li>
    <li>Создание связей между моделями <b>1:1</b></li>
    <li>Жадная загрузка по умолчанию в моделях ORM Eloquent</li>
    <li>"Мягкое" удаление в ORM Eloquent</li>
</ul>

<h3>Практическая часть</h3>
<p>
    <b>Задача 1</b>. С использованием фреймворка Laravel создайте приложение для работы с базой данных
    (можно даже с однотабличной, дикое упрощение, очень не рекомендую) для хранения данных по обуви в
    магазине.
</p>

<p>
    Должны храниться как минимум следующие данные: наименование (ботинки, кроссовки и т.д.), уникальный
    код товара (это не поле первичного ключа id), наименование производителя, цена.
</p>

<p>
    Создайте базу данных, миграции, выполните начальное заполнение данными (не менее 10 записей).
    Разработайте модель, контроллеры. Применяйте навигацию, мастер-страницы. Предусмотрите следующие
    действия в приложении:
</p>

<ul>
    <li>
        HomeController
        <ul>
            <li><b>home/index:</b> вывод этого задания</li>
            <li><b>home/about:</b> вывод сведений о разработчике</li>
        </ul>
    </li>
    <li>
        ShoesController
        <ul>
            <li><b>shoes/index:</b> вывод всех записей таблицы обуви</li>
            <li>
                <b>shoes/create:</b> добавляет пару обуви в таблицу, используйте
                форму с валидацией
            </li>
            <li>
                <b>shoes/edit/{code}:</b> редактирует пару обуви, выбор пары по
                коду товара
            </li>
            <li><b>shoes/show:</b> выводит пары обуви заданного наименования</li>
            <li><b>shoes/delete/{code}:</b> "мягкое" удаление пары обуви с заданным кодом товара</li>
        </ul>
    </li>
</ul>
<h3>Дополнительно</h3>
<p>
    Материалы занятия и задачник – в этом же архиве. Запись занятия можно скачать
    <a href="https://cloud.mail.ru/public/Z9D9/KQ6pu1azc" target="_blank">по этой ссылке</a>.
</p>
