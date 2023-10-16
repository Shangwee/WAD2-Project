<?php
class ShoppingListItem{
    private $id;
    private $item;
    private $quantity;
    private $status;
    private $shoppingID;
    private $userID;
    public function __construct($id, $item, $quantity, $status, $shoppingID, $userID){
        $this->id = $id;
        $this->item = $item;
        $this->quantity = $quantity;
        $this->status = $status;
        $this->shoppingID = $shoppingID;
        $this->userID = $userID;
    }
    public function getId(){
        return $this->id;
    }
    public function getItem(){
        return $this->item;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getShoppingID(){
        return $this->shoppingID;
    }
    public function getUserID(){
        return $this->userID;
    }
    public function setItem($item){
        $this->item = $item;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function setShoppingID($shoppingID){
        $this->shoppingID = $shoppingID;
    }

    public function setUserID($userID){
        $this->userID = $userID;
    }
}
?>