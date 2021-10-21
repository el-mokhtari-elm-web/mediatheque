<?php

$book = []; 

function cleanEntry ($entry) {
    return trim(htmlspecialchars($entry));
}

function returnEntry ($entry) {
    for ($i = 0; $i < count($entry); $i++) {
        return $entry['id'];
    }
}

$dbName = new \PDO(DSN , DB_USER, DB_PASS); 
$newBookManager = new media_library\Bookmanager($dbName);

if (isset($_POST['submit']) && $_POST['submit'] === "Reserver") {

    $rentInfos = array_map('cleanEntry', $_POST);
    array_pop($rentInfos);

    $rentInfos['user_id'] = (int)$_SESSION['userId'];
    $rentInfos['book_id'] = (int)$_POST['book_id'];

    $books = $newBookManager->getBooks();
    $booksId = array_map('returnEntry', $books); 

        if (in_array($rentInfos['book_id'], $booksId) && is_numeric($rentInfos['book_id'])) {
            $userId = $rentInfos['user_id']; 
            $bookId = $rentInfos['book_id'];
                $newBookManager->insertRental($userId, $bookId); 

                        return;
                        
        } else {
           return;
        }

} else if (isset($_POST['submit']) && $_POST['submit'] === "Confirmer") {

    $rentInfos['user_id'] = (int)$_SESSION['userId'];
    $rentInfos['book_id'] = (int)$_GET['id'];

    $books = $newBookManager->getBooks();
    $booksId = array_map('returnEntry', $books);

    if (in_array($rentInfos['book_id'], $booksId) && is_numeric($rentInfos['book_id'])) {
        $userId = $rentInfos['user_id']; 
        $bookId = $rentInfos['book_id'];
            $insertRental = $newBookManager->insertRental($userId, $bookId); 

            if ($insertRental === true) {

                $currentBook = $newBookManager->getBookById((int)$bookId);
                return;

            }
    } else {
       return;
    }

}

