<?php

class Item
{
   public $name;
   protected $code = 12345;

   public function getListingDescription()
   {
      return "Item : ". $this->name;
   }
}
