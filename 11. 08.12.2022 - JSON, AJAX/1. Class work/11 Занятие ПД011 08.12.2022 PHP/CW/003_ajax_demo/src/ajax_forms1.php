<?php
    // получить поля формы
    $name=$_POST['name'];
    $age=$_POST['age'];
    
    echo "<h3>Получено: </h3><ul><li>$name</li><li>$age</li></ul>";
    
    if($name == "john" && $age >= 18 && $age <= 141){
        echo '<h3 style="color: blue;">Сервер для form1 сообщает: данные корректны</h3>';
    } else{
        echo '<h3 style="color: red;">Сервер для form1 сообщает: данные не корректны</h3>';
    }
?>
