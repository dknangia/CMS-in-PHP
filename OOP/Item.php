<?php 

class Item{
    private $name  = "Default value"; 
    public $description  = "Default Description"; 

    public function __construct(string $name = null, $description) {
        $this->name = $name;
        $this->description = $description;
    }

    private function sayHello()
    {
      echo "Hello from product named \"". $this->name . "\"";
    }

    public function getName()
    {
        return $this->sayHello();
    }
}