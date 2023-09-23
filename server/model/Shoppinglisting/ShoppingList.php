<?php
class ShoppingList{
    private $id;
    private $items;
    public function __construct($id, $name, $items){
        $this->id = $id;
        $this->items = $items;
    }
    public function getId(){
        return $this->id;
    }
    public function getItems(){
        return $this->items;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setItems($items){
        $this->items = $items;
    }
}

?>