<?php
class ShoppingListItem{
    private $id;
    private $item;
    private $category;
    private $quantity;
    private $status;
    private $userID;
    public function __construct($id, $item, $category, $quantity, $status, $userID){
        $this->id = $id;
        $this->item = $item;
        $this->category = $category;
        $this->quantity = $quantity;
        $this->status = $status;
        $this->userID = $userID;
    }
    public function getId(){
        return $this->id;
    }
    public function getItem(){
        return $this->item;
    }
    public function getCategory(){
        return $this->category;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getUserID(){
        return $this->userID;
    }
    public function setItem($item){
        $this->item = $item;
    }
    public function setCategory($category){
        $this->category = $category;
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

    public function setUserID($userID){
        $this->userID = $userID;
    }
}
?>