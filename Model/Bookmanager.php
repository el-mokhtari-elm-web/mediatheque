<?php 
namespace media_library;

class Bookmanager extends Dbconnect {

public $_genres = ["decouverte", "education", "fantastique", "histoire", "poesie", "romance", "sciences-fiction", "sport", "thriller"];

private function convertFileSize($fileSize) {
    if ($fileSize >= 1024) { 
        $fileSize = number_format($fileSize / 1024, 2). ' KB'; 
    }   else {
            return $fileSize;
        }
    return $fileSize;
}

/*-----------------------------------------------------------FILE CHECKED---------------------------------------------------------------*/

public function verifiedBook(Book $book) {
    $newBook = $book->getBook();

    $bookTitle = $newBook['book_title'];
    $author = $newBook['author'];

    $stmt = self::$_instance_db->prepare("SELECT * FROM books WHERE book_title = :bookTitle AND author = :author");
        $stmt->bindParam(':bookTitle', $bookTitle);
        $stmt->bindParam(':author', $author);

        $stmt->execute();
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC); 

        if (count($row) > 0) { 
            header('Location: ' .ADMIN. '?msg-status-book=book-exist');
            exit;
        }   else {
                if ($this->insertBook($book)) {
                    return true;
                }
            }
}

/*-----------------------------------------------------------FILE CHECKED---------------------------------------------------------------*/



    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/
    
    private function getFileIdByFileName($thisFileName, $fileSize) {
        $stmt = self::$_instance_db->prepare("SELECT id FROM files WHERE this_filename = :thisFileName AND file_size = :fileSize");
            $stmt->bindParam(':thisFileName', $thisFileName, \PDO::PARAM_STR);
            $stmt->bindParam(':fileSize', $fileSize, \PDO::PARAM_STR);
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    return $row;
    }

        public function getBooks() {
            $stmt = self::$_instance_db->prepare("SELECT files.this_filename, books.* FROM books INNER JOIN files ON books.this_file_id = files.id ORDER BY books.genre");   
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                        return $row;
        }

        public function getBooksByGenre($genre) {
            $stmt = self::$_instance_db->prepare("SELECT files.this_filename, books.* FROM books INNER JOIN files ON books.this_file_id = files.id WHERE books.genre = :genre");
                $stmt->bindParam(':genre', $genre, \PDO::PARAM_STR);    
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            return $row;
        }
    
    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/    
    
    
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    
    private function insertFile($thisFileName, $fileSize) {  

        $stmt = self::$_instance_db->prepare("INSERT INTO files (this_filename, file_size) VALUES (:thisFileName, :fileSize)");
    
            $stmt->bindParam(':thisFileName', $thisFileName, \PDO::PARAM_STR); 
    
            $fileSize = $this->convertFileSize($fileSize);
            $stmt->bindParam(':fileSize', $fileSize, \PDO::PARAM_STR);  
    
                if (!$stmt->execute()) {
    
                    $errors = $stmt->errorInfo();
    
                    if ($errors[1] === 1366) {
                        $codeError = "incorrect";
                    } else {
                        $codeError = "unknown";
                    }

                    return $codeError;
    
                }   else {
                        return true;
                    }
    }

    public function insertBook(Book $book) {  
        $newBook = $book->getBook();

        $stmt = self::$_instance_db->prepare("INSERT INTO books (this_file_id, book_title, synopsis, genre, author, release_date, statut) VALUES (:thisFileId, :bookTitle, :synopsis, :genre, :author, :releaseDate, :statut)");

            $bookTitle = $newBook['book_title'];
            $stmt->bindParam(':bookTitle', $bookTitle, \PDO::PARAM_STR); 

            $synopsis = $newBook['synopsis'];
            $stmt->bindParam(':synopsis', $synopsis, \PDO::PARAM_STR); 

            if (in_array($newBook['genre'], $this->_genres) && $newBook['genre'] !== NULL) {
                $stmt->bindParam(':genre', $newBook['genre'], \PDO::PARAM_STR); 
            } else {
                return;
            }

            $author = $newBook['author'];
            $stmt->bindParam(':author', $author, \PDO::PARAM_STR); 

            $releaseDate = $newBook['release_date'];
            $stmt->bindParam(':releaseDate', $releaseDate); 

            $statut = true;
            $stmt->bindParam(':statut', $statut, \PDO::PARAM_BOOL);

            $insertFile = $this->insertFile($newBook['this_filename'], $newBook['file_size']); 

            $fileSize = $this->convertFileSize((int)$newBook['file_size']);
            $thisFileId = $this->getFileIdByFileName($newBook['this_filename'], $fileSize); 
            
            $thisFileId = (int)$thisFileId[0]['id']; 

            $stmt->bindParam(':thisFileId', $thisFileId, \PDO::PARAM_INT);

            if ($insertFile === true) {
                $stmt->execute();
                return true;
            }
                else {
                    $errors = $stmt->errorInfo();

                    if ($errors[1] === 1366) {
                        $codeError = "incorrect";
                    } else {
                        $codeError = "unknown";
                    }

                    header('Location: ' .ADMIN.'?msg-status-book='.$codeError);
                    exit;

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