<?php
namespace media_library;

class Book {

private $_book = [];

    public function __construct($book) {
        $this->setBook($book);
    }

    public function setBook($book) {
        $this->_book = $book;
    }

    public function getBook() {
        return $this->_book;
    }

}