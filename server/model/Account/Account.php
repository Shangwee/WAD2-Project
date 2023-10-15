<?php

Class Account{
    private $userid
    private $username;
    private $hashed;

    public function __construct($uid,$un,$h){
        $this -> userid=$uid;
        $this->username=$un;
        $this->hashed=$h;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of hashed
     */ 
    public function getHashed()
    {
        return $this->hashed;
    }

    /**
     * Set the value of hashed
     *
     * @return  self
     */ 
    public function setHashed($hashed)
    {
        $this->hashed = $hashed;

        return $this;
    }

    /**
     * Get the value of securitykeyword
     */ 
    public function getUserId()
    {
        return $this->userid;
    }

    /**
     * Set the value of securitykeyword
     *
     * @return  self
     */ 
    public function setUserId($userid)
    {
        $this->userid = $userid;

        return $this;
    }
}
?>