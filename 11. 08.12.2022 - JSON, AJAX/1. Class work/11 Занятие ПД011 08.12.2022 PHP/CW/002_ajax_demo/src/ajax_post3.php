<?php

    // прием данных от клиента
    $name = $_POST['name'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];

    $rand = rand(-100, 100);

    // данные сформированные сервером в формате JSON
    $data = json_encode([            // кодирование пар ключ - значение
        "title"=>"Сервер передает:", // в JSON-формат
        "name"=>"Василиса Премудрая",
        "age"=>$age /= 2,
        "salary"=>$salary*1.3,
        "random"=>$rand]
    ); 

    echo $data;
    
    
    

