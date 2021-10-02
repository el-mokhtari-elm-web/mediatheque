<?php
namespace media_library;

class File {

private $_msgStatus = [];
private $_msgSucces = "";
private $_msgError = "";

private $extensions = ['.png', '.jpg', '.jpeg'];

private $charsValide = ['1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 
                        'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 
                        't', 'v', 'u', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                        'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'V', 'U', 
                        'X', 'Y', 'Z', '-', '_', '.']; 


    public function getMsgStatus() {
        return $this->_msgStatus;
    }                     


    public function checkFileName($fileName) { 
        if (strlen($fileName) < 21) {
            for ($i = 0; $i < strlen($fileName); $i++) { 
                if (!in_array($fileName[$i], $this->charsValide)) {
                    $this->_msgError = "Choisir uniquement des caractères alphanumériques, tiret ou underscore";
                    $this->_msgStatus['ERROR'] = $this->_msgError;
                    return false;
                }
            }

            return $fileName; // CHECK

        } else {
            $this->_msgError = "Pas plus de 21 caractères autorisés";
            $this->_msgStatus['ERROR'] = $this->_msgError;
            return false;
        }
    }


    public function checkFile($file) {
            foreach ($file['image']['error'] as $key => $error) {

                if ($error !== 0) {

                    return false; // retour erreur dans $this->_msgStatus

                } else if (((in_array(substr($file['image']['name'][$key], -4), $this->extensions)) OR (in_array(substr($file['image']['name'][$key], -5), $this->extensions)))) {

                    $fileName = basename($file['image']['name'][$key]);
                    $currentPath = $file['image']['tmp_name'][$key];

                        if ((is_file($currentPath)) && ($this->checkFileName($fileName) != false)) {
                            $fileCheck = IMG_PATH.$fileName; 
                        } else {
                            return $this->getMsgStatus(); // ici
                        }

                        if (!file_exists($fileCheck)) {
                            //move_uploaded_file($currentPath, $fileCheck);
                            $this->_msgSucces = "Insertion éffectué avec succès";
                            $this->_msgStatus['SUCCES'] = $this->_msgSucces;
                            $this->_msgStatus['TMP_NAME'] = $file['image']['tmp_name'][$key];
                            $this->_msgStatus['FILE'] = $fileCheck;
                            return $this->getMsgStatus();
                        } else {
                            $this->_msgError = "Ce fichier éxiste déjà !";
                            $this->_msgStatus['ERROR'] = $this->_msgError;
                            return $this->getMsgStatus(); // retour erreur dans $this->_msgStatus
                        }
                }
            }
    }

}