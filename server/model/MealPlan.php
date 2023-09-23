<?php
class MealPlan{
    private $id;
    private $name;
    private $items;
    private $date;
    private $recipe;
    public function __construct($id, $name, $items, $date, $recipe){
        $this->id = $id;
        $this->name = $name;
        $this->items = $items;
        $this->date = $date;
        $this->recipe = $recipe;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getItems(){
        return $this->items;
    }
    public function getDate(){
        return $this->date;
    }
    public function getRecipe(){
        return $this->recipe;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setItems($items){
        $this->items = $items;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setRecipe($recipe){
        $this->recipe = $recipe;
    }
}
?>