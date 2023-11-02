<?php

Class SearchHistory{
    private $userid;
    private $search;
    private $cuisine;
    private $meal;
    private $timeCreated;

    public function __construct($uid,$s,$c,$m,$t){
        $this -> userid=$uid;
        $this->search=$s;
        $this->cuisine=$c;
        $this->meal=$m;
        $this->timeCreated=$t;
    }
    
    /**
     * Get the value of userid
     */ 
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Get the value of search
     */ 
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Get the value of cuisine
     */ 
    public function getCuisine()
    {
        return $this->cuisine;
    }

    /**
     * Get the value of timeCreated
     */ 
    public function getTimeCreated()
    {
        return $this->timeCreated;
    }

    /**
     * Get the value of meal
     */ 
    public function getMeal()
    {
        return $this->meal;
    }
}
?>