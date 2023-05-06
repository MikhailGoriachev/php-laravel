<?php
namespace Models;

    // класс для представления сущности БД - таблицы Planets
    // сущность для planets - имя полей совпадают с именами столбцов
    class Planet {
        private $name;   // название планеты
        private $color;  // цвет планеты

        public function getName() {
            return $this->name;
        }

        public function setName($name): void {
            $this->name = $name;
        }


        public function getColor() {
            return $this->color;
        }

        public function setColor($color): void {
            $this->color = $color;
        }

        public function __toString() {
            return "$this->name: $this->color";
        }
    } // class Planet
?>
