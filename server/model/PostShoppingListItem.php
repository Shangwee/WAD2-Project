<?php
class PostShoppingListItem{
    private $id;
    private $item;
    private $category;
    private $quantity;
    private $userID;
    public function __construct($id, $item, $category,$quantity, $userID){
        $this->id = $id;
        $this->item = $item;
        $this->category = $category;
        $this->quantity = $quantity;
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
    public function getUserID(){
        return $this->userID;
    }
    public function setItem($item){
        $this->item = $item;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setCategory($category){
        $this->category = $category;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function setUserID($userID){
        $this->userID = $userID;
    }
}
?>