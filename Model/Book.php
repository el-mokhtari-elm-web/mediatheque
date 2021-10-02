<?php
namespace media_library;

class Book {

private $_book = [];
private $_user_id = "";
private $_cms_id = "";


    public function __construct($book, $userId, $cmsId) {
        $this->setbook($book);
        $this->setUserId($userId);
        $this->setcmsId($cmsId);
    }


    public function setbook($book) {
        $this->_book = $book;
    }


    public function setUserId($userId) {
        $this->_user_id = $userId;
    }


    public function setcmsId($cmsId) {
        $this->_cms_id = $cmsId;
    }


    public function getbook() {
        return $this->_book;
    }


    public function getUserId() {
        return $this->_user_id;
    }
    

    public function getcmsId() {
        return $this->_cms_id;
    }

}