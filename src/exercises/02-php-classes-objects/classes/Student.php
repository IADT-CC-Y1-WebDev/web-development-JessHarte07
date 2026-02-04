<?php

class Student {
    private $name;
    private $number;

    public function __construct($name, $number) {
        $this->name = $name;
        $this->number = $number;
    }

    // Getter methods
    public function getName() {
        return $this->name;
    }

    public function getNumber() {
        return $this->number;
    }
}

?>