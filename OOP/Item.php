<?php

class Item
{
   private $name;

   private $description;

   public static $count = 0;

   public function __construct()
   {
      static::$count++;
   }
   /**
    * Get the value of name
    */
   public function getName()
   {
      return $this->name;
   }

   /**
    * Set the value of name
    *
    * @return  self
    */
   public function setName($name)
   {
      $this->name = $name;

      return $this;
   }

   /**
    * Get the value of description
    */
   public function getDescription()
   {
      return $this->description;
   }

   /**
    * Set the value of description
    *
    * @return  self
    */
   public function setDescription($description)
   {
      $this->description = $description;

      return $this;
   }

   /**
    * Static method 

    */
   public static function readingCountValue()
   {
      return "Static variable value " . static::$count;
   }
}
