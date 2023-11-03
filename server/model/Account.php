<?php

Class Account{
    private $userid;
    private $username;
    private $hashed;
    private $email;
    private $date;

    public function __construct($uid,$un,$h,$e,$d){
        $this -> userid=$uid;
        $this->username=$un;
        $this->hashed=$h;
        $this->email=$e;
        $this->date=$d;
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

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }
}
?>