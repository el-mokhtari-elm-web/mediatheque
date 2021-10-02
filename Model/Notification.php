<?php
namespace media_library;

class Notification {

private $_notification = []; 
private $_post_id = ""; 
private $_content_response = "";

    public function __construct($notification, $postId, $contentResponse) {
        $this->setNotification($notification);
        $this->setPostId($postId);
        $this->setContentResponse($contentResponse);
    }

    public function setNotification($notification) {
        $this->_notification = $notification;
    }

    public function setPostId($postId) {
        $this->_post_id = $postId;
    }

    public function setContentResponse($contentResponse) {
        $this->_content_response = $contentResponse;
    }

    public function getNotification() {
        return $this->_notification;
    }
    
    public function getPostId() {
        return $this->_post_id;
    }

    public function getNotification() {
        return $this->_notification;
    }

}