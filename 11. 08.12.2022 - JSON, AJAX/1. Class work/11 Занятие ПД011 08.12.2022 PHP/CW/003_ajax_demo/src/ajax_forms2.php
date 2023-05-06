<?php
    // получить данные от клиента
    $name=$_POST['name2'];
    $age=$_POST['age2'];
    $salary=$_POST['salary'];
    
    echo "<h3>Получено: </h3><ul><li>$name</li><li>$age</li><li>$salary</li></ul>";
    
    if($name == "john" && $age >= 18 && $age <= 141 && $salary > 12000){
        echo '<h3 style="color: blue;">Сервер для form2 сообщает: данные корректны</h3>';
    } else{
        echo '<h3 style="color: red;">Сервер для form2 сообщает: данные не корректны</h3>';
    }
    

