<?php
    // получить данные от клиента
    $name = $_POST['name'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];
    
    // отправка данных клиенту
    echo "<p>Сервер получил:</p>".
         "<ul><li>name: $name</li><li>age: $age</li><li>salary: $salary</li></ul>";
    
    // вот тут подготовим данные
    $test = rand(-100, 100);
    $age += 2;
    $salary *= 1.5;
    
    // продолжим отправку
    echo "<p>Сервер сформировал:</p>".
         "<ul><li>name: $name</li><li>age: $age</li><li>salary: $salary</li><li>test: $test</li></ul>";
    

