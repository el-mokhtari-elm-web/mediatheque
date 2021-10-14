<?php 

namespace media_library;

class Bookmanager extends Dbconnect {


/*-----------------------------------------------------------FILE CHECKED---------------------------------------------------------------*/

public function verifiedBook(Book $newBook) {
    $book = $newBook->getBook();

    $bookTitle = $newBook->getbookTitle();
    $author = $newBook->getAuthor();

    $stmt = self::$_instance_db->prepare("SELECT * FROM books WHERE book_title = :bookTitle AND author = :author");
        $stmt->bindParam(':bookTitle', $bookTitle);
        $stmt->bindParam(':author', $author);

        $stmt->execute();
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC); 

        if (count($row) > 0) { 
            header('Location: ' .ADMIN. '?msg-status-book=book-exist');
            exit;
        }   else {
                $this->insertBook($book, $bookTitle, $author);
            }
}

/*-----------------------------------------------------------FILE CHECKED---------------------------------------------------------------*/



    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/
    
    private function getFileIdByFileName($thisFileName) {
        $stmt = self::$_instance_db->prepare("SELECT id FROM files WHERE this_filename = :thisFileName");
            $stmt->bindParam(':thisFileName', $thisFileName, \PDO::PARAM_STR);
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    return $row;
    }
    
    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/    
    
    
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    
    public function insertBook(Book $book, $bookTitle, $author) {  
        $newBook = $book->getBook();

        $stmt = self::$_instance_db->prepare("INSERT INTO books (this_file_id, book_title, synopsis, genre, author, release_date, statut) VALUES (:thisFileId, :bookTitle, :synopsis, :genre, :author, :dateRelease, :statut)");

            $bookTitle = $newBook['book_title'];
            $stmt->bindParam(':bookTitle', $bookTitle, \PDO::PARAM_STR); 

            $synopsis = $newBook['synopsis'];
            $stmt->bindParam(':synopsis', $synopsis, \PDO::PARAM_STR); 

            $genre = $newBook['genre'];
            $stmt->bindParam(':genre', $genre, \PDO::PARAM_STR); 

            $author = $newBook['author'];
            $stmt->bindParam(':author', $author, \PDO::PARAM_STR); 

            $releaseDate = $newBook['release_date'];
            $stmt->bindParam(':releaseDate', $releaseDate); 

            $statut = 0;
            $stmt->bindParam(':statut', $statut, \PDO::PARAM_BOOL);

            $thisFileId = $this->getFileIdByFileName($thisFileName);
            $thisFileId = (int)$thisFileId[0]['id'];
            $stmt->bindParam(':thisFileId', $thisFileId, \PDO::PARAM_BOOL);

                if (!$stmt->execute()) {
                    $errors = $stmt->errorInfo();

                    if ($errors[1] === 1366) {
                        $codeError = "incorrect";
                    } else {
                        $codeError = "unknown";
                    }

                    header('Location: ' .ADMIN.'?msg-status-book='.$codeError);
                    exit;

                }   else {
                        return true;
                    }
    }

    public function insertFile(array $file) {  

        $stmt = self::$_instance_db->prepare("INSERT INTO files (this_filename, filesize, filepath) VALUES (:thisFileName, :fileSize, :filePath)");

            $thisFileName = $file[''];
            $stmt->bindParam(':thisFileName', $thisFileName, \PDO::PARAM_STR); 

            $filesize = $file[''];
            $stmt->bindParam(':filesize', $filesize, \PDO::PARAM_INT); 

            $filepath = $file[''];
            $stmt->bindParam(':filepath', $filepath, \PDO::PARAM_STR); 

                if (!$stmt->execute()) {

                    $errors = $stmt->errorInfo();

                    if ($errors[1] === 1366) {
                        $codeError = "incorrect";
                    } else {
                        $codeError = "unknown";
                    }

                }   else {
                        return true;
                    }
    }
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    


    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/



    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/



    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/
    
    /*public function deleteBook($id) { 
        $stmt = self::$_instance_db->prepare('DELETE FROM books WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

            if ($stmt->execute()) {
                $stmt = self::$_instance_db->prepare('DELETE FROM files WHERE id = :id');
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
                    $stmt->execute();
            }
    }*/
    
    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/

}