<?php

namespace Models;

class Toy
{
    private $name;
    private $age;
    private $price;

    /**
     * @param $name
     * @param $age
     * @param $price
     */
    public function __construct($name, $age, $price)
    {
        $this->name = $name;
        $this->age = $age;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function __toString(): string {
        return "name: ".$this->name.", age: ".$this->age."+, price: ".$this->price;
    }


}