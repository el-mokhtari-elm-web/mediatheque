<?php
namespace media_library;

class Post {

private $_post = [];
private $_title_post = "";
private $_cms_id = "";


    public function __construct($post, $title_post, $cmsId) {
        $this->setPost($post);
        $this->setTitlePost($title_post);
        $this->setCmsId($cmsId);
    }


    public function setPost($post) {
        $this->_post = $post;
    }


    public function setTitlePost($title_post) {
        $this->_title_post = $title_post;
    }


    public function setCmsId($cmsId) {
        $this->_cms_id = $cmsId;
    }


    public function getPost() {
        return $this->_post;
    }


    public function getTitlePost() {
        return $this->_title_post;
    }
    

    public function getCmsId() {
        return $this->_cms_id;
    }

}