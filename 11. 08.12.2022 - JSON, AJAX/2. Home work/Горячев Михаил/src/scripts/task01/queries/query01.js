// обработка страницы query01

// загрузка страницыы
window.addEventListener('load', () => {

    // загрузка и вывод данных
    getData(dataToTable);

    // установка обработчика на форму
    document.querySelector('#formId').addEventListener('submit', (e) => {
        e.preventDefault();
        getData(dataToTable);
    });
});


// получить данные
function getData(callback) {

    let data = new FormData(document.querySelector('#formId'));
    data.set('queryName', 'query01');

    let options = {
        'method': 'post',
        body: data
    };

    fetch('http://localhost:8080/data/task01/queries.php', options)
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
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Адрес</th>
                    <th>Год рождения</th>
                    <th>Паспорт</th>
                </tr>
            </thead>
            <tbody>
                ${data.reduce((p, c) => p +
                `<tr>
                    <td>${c.id}</td>
                    <td>${c.last_name}</td>
                    <td>${c.first_name}</td>
                    <td>${c.patronymic}</td>
                    <td>${c.address}</td>
                    <td>${c.year_of_birth}</td>
                    <td>${c.passport}</td>
                </tr>`
        , '')}
            </tbody>
       </table> 
       `;
}