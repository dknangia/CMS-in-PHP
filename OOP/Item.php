<?php 

class Item{
    public $name  = "Default value"; 
    public $description  = "Default Description"; 

    public function __construct(string $name = null, $description) {
        $this->name = $name;
        $this->description = $description;
    }

    public function sayHello()
    {
      echo "Hello there!";
    }

    public function getName()
    {
        return $this->name;
    }
}