<?php
namespace media_library;

class User {

private $_user = [];
private $_emailUser = "";
private $_passUser = "";


    public function __construct($user, $emailUser, $passUser) {
        $this->setUser($user);
        $this->setEmailUser($emailUser);
        $this->setPassUser($passUser);
    }


    public function setUser($user) {
        $this->_user = $user;
    }


    public function setEmailUser($emailUser) {
        $this->_emailUser = $emailUser;
    }


    public function setPassUser($passUser) {
        $this->_passUser = $passUser;
    }


    public function getUser() {
        return $this->_user;
    }


    public function getEmailUser() {
        return $this->_emailUser;
    }
    

    public function getPassUser() {
        return $this->_passUser;
    }

}