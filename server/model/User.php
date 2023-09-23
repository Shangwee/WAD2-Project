<?php 
class User{
    private $name;
    private $email;
    private $password;
    private $shoppingList;
    private $foodInventory;
    private $recipeList;
    private $mealPlan;
    public function __construct($name, $email, $password, $shoppingList, $foodInventory, $recipeList, $mealPlan){
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->shoppingList = $shoppingList;
        $this->foodInventory = $foodInventory;
        $this->recipeList = $recipeList;
        $this->mealPlan = $mealPlan;
    }
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getShoppingList(){
        return $this->shoppingList;
    }
    public function getFoodInventory(){
        return $this->foodInventory;
    }
    public function getRecipeList(){
        return $this->recipeList;
    }
    public function getMealPlan(){
        return $this->mealPlan;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setShoppingList($shoppingList){
        $this->shoppingList = $shoppingList;
    }
    public function setFoodInventory($foodInventory){
        $this->foodInventory = $foodInventory;
    }
    public function setRecipeList($recipeList){
        $this->recipeList = $recipeList;
    }
    public function setMealPlan($mealPlan){
        $this->mealPlan = $mealPlan;
    }
}

?>