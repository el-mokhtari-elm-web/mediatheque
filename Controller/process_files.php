<?php

$book = []; 

function cleanEntry ($entry) {
    return trim(htmlspecialchars($entry));
}

if (isset($_POST['submit_form_books'])) {

    if (empty($_POST['book_title']) || empty($_POST['synopsis']) || empty($_POST['genre']) || empty($_POST['author']) || empty($_POST['release_date'])) {
        header('Location: ' .ADMIN. '?msg-status-book=empty'); 
        exit; 
    } else if ((strlen($_POST['book_title']) > 35 || strlen($_POST['synopsis']) > 750) || strlen($_POST['genre']) > 30 || (strlen($_POST['author']) > 30 || strlen($_POST['release_date']) > 10) OR (strlen($_POST['book_title']) < 2 || strlen($_POST['synopsis']) < 100 || strlen($_POST['genre']) < 3 || strlen($_POST['author']) < 2 || strlen($_POST['release_date']) < 10)) {
        header('Location: ' .ADMIN. '?msg-status-book=incomplete');
        exit;
      } else {

        $book = array_map('cleanEntry', $_POST);
        array_pop($book); // delete submit entry
        $book['this_filename'] = $_FILES['book_img']['name'][0];
        $book['file_size'] = $_FILES['book_img']['size'][0];

        $newBook = new media_library\Book($book);
        $newBookManager = new media_library\Bookmanager($dbName);

        $newFileManager = new media_library\Filemanager();

        $insertBookAndFileInBdd = $newBookManager->verifiedBook($newBook);

        if ($insertBookAndFileInBdd === true) {
            $insertFileInDocument = $newFileManager->checkFile($_FILES);
            $msgStatus = $newFileManager->getMsgStatus(); 
        }

        if (isset($msgStatus['SUCCESS'])) {
            header('Location: ' .ADMIN. '?msg-status-book=success-insertion-book&cover-page='.$msgStatus['SUCCESS']); 
            exit;
        } else if (isset($msgStatus['ERROR'])) {
            header('Location: ' .ADMIN. '?msg-status-book=error-insertion-book'); 
            exit;
        }

    }
}