// обработка страницы examiners

// загрузка страницыы
window.addEventListener('load', () => {

    // загрузка и вывод данных
    getData(dataToTable);

    // установка обработчика на кнопку "обновить"
    document.querySelector('#updateBtnId').addEventListener('click', () => getData(dataToTable));
});


// получить данные
function getData(callback) {

    let data = new FormData();
    data.set('tableName', 'exams');

    let options = {
        'method': 'post',
        body: data
    };

    fetch('http://localhost:8080/data/task01/tables.php', options)
        .then((data) => data.json())
        .then((data) => callback(data))
        .catch(_ => document.querySelector('#containerId').innerHTML = `    
            <div class="alert alert-danger w-22rem" role="alert">
                Ошибка загрузки данных
            </div>
        `);
}


// вывод данных в виде таблицы
function dataToTable(data = []) {
    document.querySelector('#containerId').innerHTML = `
        <table class="table">
            <thead> 
                <tr>
                    <th>ID</th>
                    <th>Предмет</th>
                    <th>Экзаменатор</th>
                    <th>Стоимость</th>
                    <th>Студент</th>
                    <th>Адрес студента</th>
                    <th>Паспорт студента</th>
                    <th>Год рождения</th>
                    <th>Дата экзамена</th>
                    <th>Баллы</th>
                    <th class="text-center">
                        <form class="d-inline" action="/src/pages/task01/tables/exams.php" method="post">
                            <button type="submit" class="btn btn-success" name="add" title="Добавить">
                                <i class="bi bi-plus-lg"></i>Добавить...
                            </button>
                        </form>    
                    </th>
                </tr>
            </thead>
            <tbody>
                ${data.reduce((p, c) => p +
                    `<tr>
                        <td>${c.id}</td>
                        <td>${c.academic_subject_name}</td>
                        <td>${c.examiner_last_name} ${c.examiner_first_name[0]}. ${c.examiner_patronymic[0]}.</td>
                        <td>${c.examiner_exam_fee}</td>
                        <td>${c.student_last_name} ${c.student_first_name[0]}. ${c.student_patronymic[0]}.</td>
                        <td>${c.student_address}</td>
                        <td>${c.student_passport}</td>
                        <td>${c.student_year_of_birth}</td>
                        <td>${c.date}</td>
                        <td>${c.score}</td>
                        <td class='text-center'>
                            <form class='d-inline' action='/src/pages/task01/tables/exams.php' method='post'>
                                <button type='submit' class='btn btn-danger' name='delete' value='${c.id}' title='Удалить'>
                                    <i class='bi bi-trash-fill'></i>
                                </button>                        
                            </form>    
                        </td>
                    </tr>`
                    , '')}
            </tbody>
       </table> 
       `;
}