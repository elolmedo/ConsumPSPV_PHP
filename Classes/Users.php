<?php
/**
 * Created by PhpStorm.
 * User: badrom
 * Date: 24/02/17
 * Time: 14:04
 */

class User{

    var $id = 0;
    var $userid = "";
    protected $passwd = "";
    var $firstname = "";
    var $email = "";


    function __construct($nid,$nuserid,$npasswd,$nfisrt,$nemail){

        $this->id       = $nid;
        $this->userid   = $nuserid;
        $this->passwd   = $npasswd;
        $this->firstname    = $nfisrt;
        $this->phone    = $nphone;

    }

    
    //Getters
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return array
     */
    public function getListajugadores()
    {
        return $this->listajugadores;
    }

    //Setters
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

 
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    
}