<?php
class Recipe{
    private $id;
    private $name;
    private $ingredients;
    private $instructions;
    private $nutritionInfo;
    public function __construct($id, $name, $ingredients, $instructions, $nutritionInfo){
        $this->id = $id;
        $this->name = $name;
        $this->ingredients = $ingredients;
        $this->instructions = $instructions;
        $this->nutritionInfo = $nutritionInfo;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getIngredients(){
        return $this->ingredients;
    }
    public function getInstructions(){
        return $this->instructions;
    }
    public function getNutritionInfo(){
        return $this->nutritionInfo;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setIngredients($ingredients){
        $this->ingredients = $ingredients;
    }
    public function setInstructions($instructions){
        $this->instructions = $instructions;
    }
    public function setNutritionInfo($nutritionInfo){
        $this->nutritionInfo = $nutritionInfo;
    }
}

?>
