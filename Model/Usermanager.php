<?php 
namespace media_library;

class Usermanager extends Dbconnect {

protected static $_typeUser = [1 => "administrator", 2 => "employe", 3 => "user_subscriber"]; // property for control before insertion in bdd

/*-----------------------------------------------------------USER CHECKED---------------------------------------------------------------*/

    public function verifiedUser(User $newUser) {
        $emailUser = $newUser->getEmailUser(); 
        $passUser = $newUser->getPassUser(); 

        $user = $newUser->getUser(); 
        $firstname = $user['firstname'];
        $lastname = $user['lastname']; 

        $stmt = self::$_instance_db->prepare("SELECT * FROM users WHERE email_user = :emailUser AND firstname = :firstname AND lastname = :lastname");
            $stmt->bindParam(':emailUser', $emailUser);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
        if (count($row) > 0) {
            return $row;
            header('Location: ' .LOGIN. '?message=user-exist');
            exit;
        } else {
            $this->insertUser($newUser, $emailUser, $passUser);
          }
    }

    public function getUserChecked(User $newUser) {
        $emailUser = $newUser->getEmailUser();
        $passUser = $newUser->getPassUser();
        $stmt = self::$_instance_db->prepare("SELECT * FROM users WHERE email_user = :emailUser AND pass_user = :passUser");
        $stmt->bindParam(':emailUser', $emailUser);
        $stmt->bindParam(':passUser', $passUser);
        $stmt->execute();
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
        if (count($row) < 1) {
            header('Location: ' .LOGIN. '?message=unknown');
            exit;
        } else {
            return $row;
          }
    }

/*-----------------------------------------------------------USER CHECKED---------------------------------------------------------------*/



    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/
    
        public function getUsers() {
            //$stmt = self::$_instance_db->prepare("SELECT * FROM users WHERE email_user NOT IN ('contact.elmweb@gmail.com')");
            $stmt = self::$_instance_db->prepare("SELECT DISTINCT registrations.registration_date, registrations.termination_date, users.* FROM registrations INNER JOIN users ON registrations.to_user_id = users.id");
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    return $row;
        }

        public function getUserById($userId) {
            $stmt = self::$_instance_db->prepare("SELECT * FROM users WHERE id = :userId");
                $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                        return $row;
        }

        public function getUserRegistrationByUserId($userId) {
            $stmt = self::$_instance_db->prepare("SELECT * FROM registrations WHERE to_user_id = :userId");
                $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                        return $row;
        }

        private function getCurrentUser($emailUser, $firstname, $lastname) {
            $stmt = self::$_instance_db->prepare("SELECT id, firstname, lastname, type_user, level_user FROM users WHERE email_user = :emailUser AND firstname = :firstname AND lastname = :lastname");
                $stmt->bindParam(':emailUser', $emailUser, \PDO::PARAM_STR);
                $stmt->bindParam(':firstname', $firstname, \PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $lastname, \PDO::PARAM_STR); 
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                        return $row;
        }

    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/    
    
    
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    
        public function insertUser(User $user, $emailUser, $passUser) {  
            $newUser = $user->getUser();
            $statutUser = "";

            $stmt = self::$_instance_db->prepare("INSERT INTO users (firstname, lastname, email_user, pass_user, type_user, level_user, statut_user, date_of_birth, postal_code, adress) VALUES (:firstname, :lastname, :emailUser, :passUser, :typeUser, :levelUser, :statutUser, :dateOfBirth, :postalCode, :adress)");

                $firstname = $newUser['firstname'];
                $stmt->bindParam(':firstname', $firstname, \PDO::PARAM_STR); 

                $lastname = $newUser['lastname'];
                $stmt->bindParam(':lastname', $lastname, \PDO::PARAM_STR); 

                $stmt->bindParam(':emailUser', $emailUser, \PDO::PARAM_STR);

                $passUser = md5($passUser."#AKph780MP5/*5dchhww0?/#lPOO");
                $stmt->bindParam(':passUser', $passUser, \PDO::PARAM_STR); 

                if (in_array($newUser['type_user'], self::$_typeUser)) {
                    $typeUser = $newUser['type_user']; 
                    $stmt->bindParam(':typeUser', $typeUser, \PDO::PARAM_STR); var_dump($typeUser);
                
                    $levelUser = array_keys(self::$_typeUser, $newUser['type_user']); // array var_dump($levelUser);
                    $stmt->bindParam(':levelUser', $levelUser[0], \PDO::PARAM_INT); // entry var_dump($levelUser[0]); exit;

                    if ((int)$levelUser[0] > 1 && !isset($newUser['administrateur_id'])) {
                        $statutUser = self::$_statutUser[0]; // actif
                    } else { 
                        $statutUser = self::$_statutUser[1]; // non actif
                    } 
                    $stmt->bindParam(':statutUser', $statutUser, \PDO::PARAM_STR); 
                } 

                $dateOfBirth = $newUser['date_of_birth'];
                $stmt->bindParam(':dateOfBirth', $dateOfBirth, \PDO::PARAM_STR); 

                $postalCode = (int)$newUser['postal_code']; 
                $stmt->bindParam(':postalCode', $postalCode, \PDO::PARAM_INT);

                $adress = $newUser['adress'];
                $stmt->bindParam(':adress', $adress, \PDO::PARAM_STR); 
                // voir les logs et le getUserById() qui ne recupere plus l'id en cas de deconnexion
                // array(3) { [0]=> string(5) "00000" [1]=> NULL [2]=> NULL }
                // array(3) { [0]=> string(5) "HY000" [1]=> int(1366) [2]=> string(66) "Incorrect integer value: 'fffdd' for column 'postal_code' at row 1" }
                // array(3) { [0]=> string(5) "42000" [1]=> int(1064) [2]=> string(226) "You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'firstname lastname, email_user, pass_user, type_user, level_user, statut_user, d' at line 1" }
                // exit;
                    if (!$stmt->execute()) {
                        $errors = $stmt->errorInfo();

                        if (!isset($errors)) {
                            header('Location: ' .REGISTER. '?message=unknow');
                            exit;
                        }

                        if ($errors[1] === 1366) {
                            header('Location: ' .REGISTER. '?message=incorrect');
                            exit;
                        } else {
                            header('Location: ' .REGISTER. '?message=unknow');
                            exit;
                        }

                    } else {
                        $currentUser = $this->getCurrentUser($emailUser, $firstname, $lastname);
                        
                        $toUserId = (int)$currentUser[0]['id'];
                        $typeUser = $currentUser[0]['type_user']; 
                        $toFullName = $currentUser[0]['firstname']. ' - ' .$currentUser[0]['lastname'];
                        $terminationDate = "";
                        $levelUser = (int)$currentUser[0]['level_user']; 

                            if ($levelUser > 2 && !isset($newUser['administrateur_id'])) {

                                $this->insertRegistrationByUser($toUserId, $typeUser, $toFullName);

                            } else {

                                $userId = (int)$newUser['administrateur_id'];
                                $registerByUser = $this->getUserById($userId);

                                $byFullName = $registerByUser[0]['firstname']. ' - ' .$registerByUser[0]['lastname'];
                                $byUserId = (int)$registerByUser[0]['id'];

                                echo "<pre>"; var_dump($registerByUser); echo "</pre>";
                                    ////// test
                                    if (isset($newUser['administrateur_id'])) {
                                        echo $newUser['administrateur_id']. " : id"; 
                                        var_dump($newUser['administrateur_id']);
                                    } else { echo "rien"; }
                                    /////// test
                                //exit;
                                $this->insertRegistrationByAdminisrator($byUserId, $toUserId, $typeUser, $registrationDate, $byFullName, $toFullName);
                            
                            }

                            return;
                      }
        }
    
    
        private function insertRegistrationByUser($toUserId, $typeUser, $toFullName) {
            $stmt = self::$_instance_db->prepare("INSERT INTO registrations (to_user_id, recording_type, registration_date, to_full_name) VALUES (:toUserId, :recordingType, :registrationDate, :toFullName)");

            $stmt->bindParam(':toUserId', $toUserId, \PDO::PARAM_INT); echo $toUserId. "<br>";

            $stmt->bindParam(':recordingType', $typeUser, \PDO::PARAM_STR); echo $typeUser. "<br>";

            $registrationDate = Date('Y-m-d');
            $stmt->bindParam(':registrationDate', $registrationDate); echo $registrationDate. "<br>";

            $stmt->bindParam(':toFullName', $toFullName, \PDO::PARAM_STR); echo $toFullName. "<br>";

            if ($stmt->execute()) {
                header('Location: ' .REGISTER. '?msg-status=succes-registration');
                exit;
            } else {
                return;
            }                 
        }
        

        private function insertRegistrationByAdminisrator($byUserId, $toUserId, $typeUser, $registrationDate, $byFullName, $toFullName) {
            $stmt = self::$_instance_db->prepare("INSERT INTO registrations (by_user_id, to_user_id, recording_type, registration_date, by_full_name, to_full_name) VALUES (:byUserId, :toUserId, :recordingType, :registrationDate, :byFullName, :toFullName)");

            $stmt->bindParam(':byUserId', $byUserId, \PDO::PARAM_INT); echo $byUserId. "<br>";

            $stmt->bindParam(':toUserId', $toUserId, \PDO::PARAM_INT); echo $toUserId. "<br>";

            $stmt->bindParam(':recordingType', $typeUser, \PDO::PARAM_STR); echo $typeUser. "<br>";

            $registrationDate = Date('Y-m-d');
            $stmt->bindParam(':registrationDate', $registrationDate); echo $registrationDate. "<br>";

            $stmt->bindParam(':byFullName', $byFullName, \PDO::PARAM_STR); echo $byFullName. "<br>";

            $stmt->bindParam(':toFullName', $toFullName, \PDO::PARAM_STR); echo $toFullName. "<br>";

            if ($stmt->execute()) {
                header('Location: ' .ADMIN. '?msg-status=succes-registration');
                exit;
            } else {
                return;
            }                 
        }
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    


    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/

    public function updateStatutUser($userId, $fullName, $statutUser, $toUserId) { 
        $stmt = self::$_instance_db->prepare("UPDATE registrations SET by_user_id = :userId, by_full_name = :fullName WHERE to_user_id = :toUserId");
            $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
            $stmt->bindParam(':fullName', $fullName, \PDO::PARAM_STR); 
            $stmt->bindParam(':toUserId', $toUserId, \PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $stmt = self::$_instance_db->prepare("UPDATE users SET statut_user = :statutUser WHERE id = :userId");
                        $stmt->bindParam(':statutUser', $statutUser, \PDO::PARAM_STR);
                        $stmt->bindParam(':userId', $toUserId, \PDO::PARAM_INT);
                            $stmt->execute();
                }
    }

    public function updateTypeUser($byUserId, $userId, $typeUser) { 
        $stmt = self::$_instance_db->prepare("UPDATE users SET level_user = :levelUser, type_user = :typeUser WHERE id = :userId");
            
            $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);

            $levelUser = array_keys(self::$_typeUser, $typeUser); 
            $stmt->bindParam(':levelUser', $levelUser[0], \PDO::PARAM_INT); var_dump($levelUser);

            if (in_array($typeUser, self::$_typeUser,)) {
                $stmt->bindParam(':typeUser', $typeUser, \PDO::PARAM_STR); var_dump($typeUser);
            } //exit;

            $stmt->execute();

                if ($stmt->execute() === true) {
                    $byUser = $this->getUserById($byUserId);

                        $stmt = self::$_instance_db->prepare("UPDATE registrations SET by_user_id = :byUserId, recording_type = :typeUser, registration_date = :registrationDate, by_full_name = :byFullName WHERE to_user_id = :toUserId");
                            $stmt->bindParam(':toUserId', $userId, \PDO::PARAM_INT);

                            $stmt->bindParam(':byUserId', $byUserId, \PDO::PARAM_INT);

                            $stmt->bindParam(':typeUser', $typeUser, \PDO::PARAM_STR); 

                            $registrationDate = Date('Y-m-d');
                            $stmt->bindParam(':registrationDate', $registrationDate); 

                            $byFullName = $byUser[0]['firstname']. ' - ' .$byUser[0]['lastname'];
                            $stmt->bindParam(':byFullName', $byFullName, \PDO::PARAM_STR);

                            $stmt->execute();
                }
    }

    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/



    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/
    
        public function deleteUser($userId) {    
            $stmt = self::$_instance_db->prepare("SELECT termination_date FROM registrations WHERE to_user_id = :userId");
                $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
                    $stmt->execute();
                        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
                    
                            if (!isset($row[0]['termination_date'])) {

                                $stmt = self::$_instance_db->prepare("UPDATE registrations SET termination_date = :terminationDate WHERE to_user_id = :userId");
                                    $terminationDate = Date('Y-m-d');
                                        $stmt->bindParam(':terminationDate', $terminationDate);
                                        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
                                            $stmt->execute();
                                            return;
                            } else {
                                $stmt = self::$_instance_db->prepare('DELETE FROM users WHERE id = :userId');
                                    $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
                                    
                                        if ($stmt->execute()) {
                                            $stmt = self::$_instance_db->prepare('DELETE FROM registrations WHERE to_user_id = :userId');
                                                $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
                                                    $stmt->execute();
                                        } else {return;}
                            }
        }
    
    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/

}
