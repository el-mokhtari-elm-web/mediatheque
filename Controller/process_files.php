<?php

$book = [];

function cleanEntry ($entry) {
    return trim(htmlspecialchars($entry));
}
 
require_once("../Model/Filemanager.php");

$newFileManager = new media_library\Filemanager();

if (isset($_POST['submit_form_books'])) {

    if (empty($_POST['book_title']) || empty($_POST['synopsis']) || empty($_POST['genre']) || empty($_POST['author']) || empty($_POST['release_date'])) {
        header('Location: ' .ADMIN. '?msg-status-img=empty'); 
        exit; 
    } else if ((strlen($_POST['book_title']) > 30 || strlen($_POST['synopsis']) > 750) || strlen($_POST['genre']) > 30 || (strlen($_POST['author']) > 30 || strlen($_POST['release_date']) > 10) OR (strlen($_POST['book_title']) < 2 || strlen($_POST['synopsis']) < 100 || strlen($_POST['genre']) < 3 || strlen($_POST['author']) < 2 || strlen($_POST['release_date']) < 10)) {
        header('Location: ' .ADMIN. '?msg-status-img=incomplete');
        exit;
      } else {

        $book = array_map('cleanEntry', $_POST);
        array_pop($book);

        $insertFileInDocument = $newFileManager->checkFile($_FILES);
        $msgStatus = $newFileManager->getMsgStatus(); 

        if (isset($msgStatus['SUCCESS'])) {
            header('Location: ' .ADMIN. '?msg-status-img=success-insertion-book&cover-page='.$msgStatus['SUCCESS']); 
            exit;
        } else if (isset($msgStatus['ERROR'])) {
            header('Location: ' .ADMIN. '?msg-status-img=error-insertion-book'); 
            exit;
        }

    }
}