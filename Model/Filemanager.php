<?php
namespace media_library;

class Filemanager {

private $_msgStatus = [];
private $_msgSucces = "";
private $_msgError = "";

private $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.svg'];

private $charsValide = ['1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 
                        'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 
                        't', 'v', 'u', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                        'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'V', 'U', 
                        'X', 'Y', 'Z', '-', '_', '.']; 

private function checkFileName($fileName) { // check entry
    if (strlen($fileName) < 30) {
        for ($i = 0; $i < strlen($fileName); $i++) { 
            if (!in_array($fileName[$i], $this->charsValide)) {
                $this->_msgError = "Choisir uniquement des caractères alphanumériques, tiret ou underscore";
                $this->_msgStatus['ERROR'] = $this->_msgError;
                    return false;
            }
        } 
        
        return $fileName; // CHECK
                    
    }   else {
            $this->_msgError = "Pas plus de 30 caractères autorisés";
            $this->_msgStatus['ERROR'] = $this->_msgError;
                return false;
        }
}


    public function getMsgStatus() {
        return $this->_msgStatus;  // Return array of potentialy errors
    }                     

    public function checkFile($file) {
        foreach ($file['book_img']['error'] as $key => $error) {

            if ($error !== 0) {

                return false; // retour erreur dans $this->_msgStatus

            }   else if (((in_array(substr($file['book_img']['name'][$key], -4), $this->extensions)) OR (in_array(substr($file['book_img']['name'][$key], -5), $this->extensions)))) {

                    $fileName = basename($file['book_img']['name'][$key]);
                    $currentPath = $file['book_img']['tmp_name'][$key];

                    if ((is_file($currentPath)) && ($this->checkFileName($fileName) != false)) {
                        $fileCheck = IMG_PATH.COVER_PAGES.$fileName; 
                    }   else {
                            return $this->getMsgStatus(); 
                        }

                    if (!file_exists($fileCheck) && $file['book_img']['size'][$key] < 700000) {
                                
                            move_uploaded_file($currentPath, $fileCheck); // bloc move tmp in directory and generation msg errors or succes in array

                                $this->_msgSucces = "page de couverture inserer avec succès";
                                $this->_msgStatus['SUCCESS'] = $this->_msgSucces;
                                $this->_msgStatus['TMP_NAME'] = $file['book_img']['tmp_name'][$key];
                                $this->_msgStatus['FILE'] = $fileCheck;

                                $this->getMsgStatus();
                                
                                return true;

                    }   else {
                            $this->_msgError = "Cette page de couverture éxiste déjà !";
                            $this->_msgStatus['ERROR'] = $this->_msgError;
                                return $this->getMsgStatus(); // retour erreur dans $this->_msgStatus
                        }
                }
        }
    }

}