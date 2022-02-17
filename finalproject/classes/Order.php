<?php
class Order
{

    public $firstName = "";
    public $lastName = "";
    public $address = "";
    public $address2 = "";
    public $city = "";
    public $state = "";
    public $zip = "";
    public $creditcard = "";

    public $bookId = "";
    public $price = 0;

    public $last_identity = 0;

    public function saveOrder($conn)
    {
        $sql_order = "INSERT INTO orders (book_id, price)
                        VALUES (:book_id, :price);";

        $sql_inventory_order = "INSERT INTO `book_inventory_order`(`order_id`, `first_name`, `last_name`, `address`, `address2`, `city`, `state`, `zip`, `credit_card`) 
                                VALUES (:order_id, :first_name, :last_name, :address, :address2, :city, :state, :zip, :credit_card)";


        $stmt = $conn->prepare($sql_order);

        $stmt->bindValue(":book_id", $this->bookId, PDO::PARAM_INT);
        $stmt->bindValue(":price", $this->price, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->last_identity =  $conn->lastInsertId();
            if ($this->last_identity > 0) {
                $stmt = null;
                $stmt = $conn->prepare($sql_inventory_order);
                $stmt->bindValue(":order_id", $this->last_identity, PDO::PARAM_INT);
                $stmt->bindValue(":first_name", $this->firstName, PDO::PARAM_STR);
                $stmt->bindValue(":last_name", $this->lastName, PDO::PARAM_STR);
                $stmt->bindValue(":address", $this->address, PDO::PARAM_STR);
                $stmt->bindValue(":address2", $this->address2, PDO::PARAM_STR);
                $stmt->bindValue(":city", $this->city, PDO::PARAM_STR);
                $stmt->bindValue(":state", $this->state, PDO::PARAM_STR);
                $stmt->bindValue(":zip", $this->zip, PDO::PARAM_STR);
                $stmt->bindValue(":credit_card", $this->creditcard, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    if($this->updateInventory($conn)){
                        return $this->last_identity;
                    }
                }
            }
        }
    }


    private function updateInventory($conn)
    {
        $sql = "UPDATE book_inventory
        SET inventory_count = ((SELECT inventory_count FROM book_inventory WHERE book_ID = :book_id) - 1)
        WHERE book_id = :book_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':book_id', $this->bookId, PDO::PARAM_INT);
       return $stmt->execute();
    }        
        
    
}
