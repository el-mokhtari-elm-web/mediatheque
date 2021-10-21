<?php 
namespace media_library;

class Bookmanager extends Dbconnect {

// array for control value enter by user for check all entry before insertion in bdd.
public $_genres = ["decouverte", "education", "fantastique", "histoire", "poesie", "romance", "sciences-fiction", "sport", "thriller"];

private function convertFileSize($fileSize) { // for converting bytes in string humanly understandable 
    if ($fileSize >= 1024) { 
        $fileSize = number_format($fileSize / 1024, 2). ' KB'; 
    }   else {
            return $fileSize;
        }
    return $fileSize;
}

/*-----------------------------------------------------------FILE CHECKED---------------------------------------------------------------*/

public function verifiedBook(Book $book) { // check book is not in bbd before insertion
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
            $stmt = self::$_instance_db->prepare("SELECT files.this_filename, books.* FROM books INNER JOIN files ON books.this_file_id = files.id");   
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                        return $row;
        }

        public function getBooksNotAvailable() { // count of books not availables
            $stmt = self::$_instance_db->prepare("SELECT count(id) AS books_not_available FROM books WHERE statut = 0");   
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                        return $row;
        }

        public function getBookRent() { // all book not availables
            $stmt = self::$_instance_db->prepare("SELECT book_rentals.*, users.*, books.* FROM book_rentals INNER JOIN users ON users.id = book_rentals.user_id INNER JOIN books ON books.id = book_rentals.book_id AND books.statut = 0 ORDER BY book_rentals.user_id");       
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            return $row;
        }

        public function getDateRental($bookId) { // date start
            $stmt = self::$_instance_db->prepare("SELECT book_rentals.rental_start FROM book_rentals INNER JOIN books ON books.id = book_rentals.book_id WHERE book_rentals.book_id = :bookId");   
            $stmt->bindParam(':bookId', $bookId, \PDO::PARAM_INT);     
            $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                        return $row;
        }

        public function getBookById($id) {
            $stmt = self::$_instance_db->prepare("SELECT files.this_filename, books.* FROM books INNER JOIN files ON books.this_file_id = files.id WHERE books.id = :id"); 
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);  
                    if ($stmt->execute()) {
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            return $row;
                    } else {
                        return false;
                    }
        }

        public function getBooksByGenre($genre) {
            $stmt = self::$_instance_db->prepare("SELECT files.this_filename, books.* FROM books INNER JOIN files ON books.this_file_id = files.id WHERE books.genre = :genre");
                $stmt->bindParam(':genre', $genre, \PDO::PARAM_STR);    
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            return $row;
        }
        
        public function getBooksRentedByUser($userId) {
            $stmt = self::$_instance_db->prepare("SELECT book_rentals.rental_start, books.* FROM book_rentals INNER JOIN books ON books.id = book_rentals.book_id WHERE book_rentals.user_id = :userId AND books.statut = 0");
                $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);    
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            return $row;
        }

        public function getCountBooksByUser($userId) {
            $stmt = self::$_instance_db->prepare("SELECT count(book_rentals.book_id) AS count_books FROM book_rentals INNER JOIN books ON book_rentals.book_id = books.id INNER JOIN users ON users.id = book_rentals.user_id WHERE book_rentals.user_id = :userId");
                $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);    
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            return $row;
        }
    
    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/    
    
    
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    
    private function insertFile($thisFileName, $fileSize) { // use in method after in line 179

        $stmt = self::$_instance_db->prepare("INSERT INTO files (this_filename, file_size) VALUES (:thisFileName, :fileSize)");
    
            $stmt->bindParam(':thisFileName', $thisFileName, \PDO::PARAM_STR); 
    
            $fileSize = $this->convertFileSize($fileSize);
            $stmt->bindParam(':fileSize', $fileSize, \PDO::PARAM_STR);  
    
                if (!$stmt->execute()) { // this bloc for log msg to recupered in development futur
    
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

            $insertFile = $this->insertFile($newBook['this_filename'], $newBook['file_size']); // insertFile in this line

            $fileSize = $this->convertFileSize((int)$newBook['file_size']);
            $thisFileId = $this->getFileIdByFileName($newBook['this_filename'], $fileSize); 
            
            $thisFileId = (int)$thisFileId[0]['id']; 

            $stmt->bindParam(':thisFileId', $thisFileId, \PDO::PARAM_INT);

            if ($insertFile === true) { // if insertFile success = insertBook;
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

    public function insertRental($userId, $bookId) {  

        $stmt = self::$_instance_db->prepare("INSERT INTO book_rentals (user_id, book_id, rental_start) VALUES (:userId, :bookId, :rentalStart)");
    
            $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT); 
            $stmt->bindParam(':bookId', $bookId, \PDO::PARAM_INT);

            $date = new \DATETIME();
            $rentalStart = $date->format("Y-m-d H:i:s");
            $stmt->bindParam(':rentalStart', $rentalStart);  

            $currentBook = $this->getBookById($bookId); 
    
            if ((int)$currentBook[0]['statut'] === 1) {
                if (!$stmt->execute()) {
    
                    $errors = $stmt->errorInfo();
    
                    if ($errors[1] === 1366) {
                        $codeError = "incorrect";
                    } else {
                        $codeError = "unknown";
                    }

                    return $codeError;
    
                }   else {
                        $this->updateStatutBook($bookId);
                        return;
                    }
            }   else {
                    return;
                }
    }
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    


    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/

    private function updateStatutBook($bookId) { // this method use in library books for user on check his book for rent
        
        $stmt = self::$_instance_db->prepare("UPDATE books SET statut = :statut WHERE id = :bookId");
            
            $stmt->bindParam(':bookId', $bookId, \PDO::PARAM_INT);

            $statut = 0; // false = not-disponible 
            $stmt->bindParam(':statut', $statut, \PDO::PARAM_BOOL);

                $stmt->execute();

                return;
    }

    public function updateStatutBookAfterRent($bookId) { // this method use by employe after rent for check return of the book
        
        $stmt = self::$_instance_db->prepare("UPDATE books SET statut = :statut WHERE id = :bookId");
            
            $stmt->bindParam(':bookId', $bookId, \PDO::PARAM_INT);

            $statut = 1; // true = disponible 
            $stmt->bindParam(':statut', $statut, \PDO::PARAM_BOOL);

                if ($stmt->execute()) {
                    $stmt = self::$_instance_db->prepare('DELETE FROM book_rentals WHERE book_id = :bookId');
                        $stmt->bindParam(':bookId', $bookId, \PDO::PARAM_INT);

                            $stmt->execute();
                            header('Location: ' .ADMIN.'?msg-status-book=rent-finish');
                            exit;
                }
    }

    // IN registration by default the statut of book = 1 (disponible)

    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/



    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/
    
    public function deleteBook($id) { 
        $stmt = self::$_instance_db->prepare('DELETE FROM books WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

            if ($stmt->execute()) {
                $stmt = self::$_instance_db->prepare('DELETE FROM files WHERE book_id = :id');
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
                    $stmt->execute();
            }
    }
    
    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/

}