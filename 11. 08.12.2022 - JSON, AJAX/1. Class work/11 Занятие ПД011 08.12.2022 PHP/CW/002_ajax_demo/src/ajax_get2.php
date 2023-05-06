<?php
    // получить данные от клиента
    $name = $_GET['name'];
    $age = $_GET['age'];
    $salary = $_GET['salary'];
    
    // отправка данных клиенту
    echo "<p>Сервер получил:</p>".
         "<ul><li>name: $name</li><li>age: $age</li><li>salary: $salary</li></ul>";
    
    // вот тут подготовим данные
    $test = rand(-100, 100);
    $age++;
    $salary *= 1.2;
    
    // продолжим отправку - в поток вывода поместить строку
    echo "<p>Сервер сформировал:</p>".
         "<ul><li>name: $name</li><li>age: $age</li><li>salary: $salary</li><li>test: $test</li></ul>";
    

