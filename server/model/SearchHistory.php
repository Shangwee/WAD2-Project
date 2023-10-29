<?php

Class SearchHistory{
    private $userid;
    private $search;
    private $cuisine;
    private $timeCreated;

    public function __construct($uid,$s,$c,$t){
        $this -> userid=$uid;
        $this->search=$s;
        $this->cuisine=$c;
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
}
?>