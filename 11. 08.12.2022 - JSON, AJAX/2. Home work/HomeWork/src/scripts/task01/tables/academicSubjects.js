// обработка страницы academicSubjects

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
    data.set('tableName', 'academic_subjects');
    
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
                    <th>Название</th>
                </tr>
            </thead>
            <tbody>
                ${data.reduce((p, c) => p +
            `<tr>
                        <td>${c.id}</td>
                        <td>${c.name}</td>
                    </tr>`
        , '')}
            </tbody>
       </table> 
       `;
}