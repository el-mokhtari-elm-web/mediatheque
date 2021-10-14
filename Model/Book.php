<?php
namespace media_library;

class Book {

private $_book = [];
private $_book_title = "";
private $_author = "";


    public function __construct($book, $bookTitle, $author) {
        $this->setBook($book);
        $this->setBookTitle($bookTitle);
        $this->setAuthor($author);
    }


    public function setBook($book) {
        $this->_book = $book;
    }


    public function setBookTitle($bookTitle) {
        $this->_book_title = $bookTitle;
    }


    public function setAuthor($author) {
        $this->_author = $author;
    }


    public function getBook() {
        return $this->_book;
    }


    public function getBookTitle() {
        return $this->_book_title;
    }
    

    public function getAuthor() {
        return $this->_author;
    }

}