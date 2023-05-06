<?php
    $rand = rand(-100, 100);
    $name = "Василий";
    $surname = 'Чебышев';
    
    // данные сформированные сервером в формате JSON
//    $data = json_encode([        // кодирование пар ключ - значение
//        "title"=>"Сервер передает:", // в JSON-формат
//        "name"=>$name,
//        "age"=>27,
//        "salary"=>15000,
//        "random"=>$rand]
//    );
//    echo json_encode($data);

    // как в коде сформировать ассоциативный массив
    $data = [];
    $data["title"] = "Сервер передает:";
    $data["name"] = $name.' '.$surname;
    $data["age"] = 28;
    $data["salary"] = 15000;
    $data["random"] = $rand;

    // в поток вывода поместить строку
    echo json_encode($data);
    
    
    

