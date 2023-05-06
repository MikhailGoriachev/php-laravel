// обработка страницы query01

// загрузка страницыы
window.addEventListener('load', () => {

    // загрузка и вывод данных
    getData(dataToTable);
});


// получить данные
function getData(callback) {

    let data = new FormData();
    data.set('queryName', 'query05');

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
                    <th>Стоимость экзамена</th>
                </tr>
            </thead>
            <tbody>
                ${data.reduce((p, c) => p +
            `<tr>
                    <td>${c.id}</td>
                    <td>${c.last_name}</td>
                    <td>${c.first_name}</td>
                    <td>${c.patronymic}</td>
                    <td>${c.exam_fee}</td>
                </tr>`
        , '')}
            </tbody>    
       </table> 
       `;
}