<?php
class FoodInventoryItem{
    private $id;
    private $item;
    private $quantity;
    private $status;
    private $expiryDate;
    public function __construct($id, $item, $quantity, $status, $expiryDate){
        $this->id = $id;
        $this->item = $item;
        $this->quantity = $quantity;
        $this->status = $status;
        $this->expiryDate = $expiryDate;
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
    public function getExpiryDate(){
        return $this->expiryDate;
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
    public function setExpiryDate($expiryDate){
        $this->expiryDate = $expiryDate;
    }
}
?>