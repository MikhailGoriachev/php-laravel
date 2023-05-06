// обработка страницы query01

// загрузка страницыы
window.addEventListener('load', () => {

    // загрузка и вывод данных
    getData(dataToTable);
});


// получить данные
function getData(callback) {

    let data = new FormData();
    data.set('queryName', 'query07');

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
                    <th>Год рождения</th>
                    <th>Количество студентов</th>
                </tr>
            </thead>
            <tbody>
                ${data.reduce((p, c) => p +
                `<tr>
                    <td>${c.year_of_birth}</td>
                    <td>${c.amount}</td>
                </tr>`
        , '')}
            </tbody>    
       </table> 
       `;
}