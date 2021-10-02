<?php 
namespace media_library;

class Usermanager extends Dbconnect {


/*-----------------------------------------------------------USER CHECKED---------------------------------------------------------------*/

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
            $stmt = self::$_instance_db->prepare("SELECT * FROM users WHERE email_user NOT IN ('contact.elmweb@gmail.com')");
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    return $row;
        }

        public function getUsersPremium() {
            $stmt = self::$_instance_db->prepare("SELECT count(id) AS users_premium FROM users WHERE cms_premium IS NOT NULL");
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

        public function getCmsByUsers() {
            $stmt = self::$_instance_db->prepare("SELECT count(used_cms.favoris_user_id) AS count_users, cms.cms_name FROM used_cms INNER JOIN cms ON used_cms.cms_id = cms.id GROUP BY cms.cms_name ASC");
                $stmt->execute();
                    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    return $row;
        }

        public function getUsedCms() {
            $stmt = self::$_instance_db->prepare("SELECT * FROM used_cms WHERE cms_id = :cmsId AND favoris_user_id = :favorisUserId");
                $stmt->bindParam(':cmsId', $this->_datas_cms['cms_id']); 
                $stmt->bindParam(':favorisUserId', $this->_datas_cms['favoris_user_id']);
                $stmt->execute();
                    $rowUsedCms = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    return $rowUsedCms;
        }

        private function getUserId($emailUser, $lastName) {
            $stmt = self::$_instance_db->prepare("SELECT id FROM users WHERE email_user = :emailUser AND lastname = :lastName");
            $stmt->bindParam(':emailUser', $emailUser); 
            $stmt->bindParam(':lastName', $lastName);
            $stmt->execute();                  
            $rowUserId = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $rowUserId;
        }
    
    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/    
    
    
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    
        public function insertUser(User $user) {  
            $newUser = $user->getUser();
            $emailUser = $user->getEmailUser();
            $passUser = $user->getPassUser();

            $stmt = self::$_instance_db->prepare("INSERT INTO users (type_user, level_right, lastname, firstname, email_user, pass_user, favoris_cms_id, date_subscribe) VALUES (:typeUser, :levelRight, :lastName, :firstName, :emailUser, :passUser, :favorisCmsId, :dateSubscribe)");

                $typeUser = self::$_typeUser[3][0];
                $stmt->bindParam(':typeUser', $typeUser); 
                
                $levelRight = self::$_typeUser[3][1];
                $stmt->bindParam(':levelRight', $levelRight, \PDO::PARAM_INT); 

                $lastName = $this->testStringEntry($newUser['lastname']);
                $stmt->bindParam(':lastName', $lastName);
                    
                $firstName = $this->testStringEntry($newUser['firstname']);
                $stmt->bindParam(':firstName', $firstName); 

                $emailUser = $this->testStringEntry($emailUser);
                $stmt->bindParam(':emailUser', $emailUser);

                $passUser = $this->testStringEntry($passUser);
                $passUser = md5($passUser."#AKph780MP5/*5dchhww0?/#lPOO");
                $stmt->bindParam(':passUser', $passUser);

            if  (in_array($newUser['favoris_cms'], self::$_cms)) {
                $cmsFavoris = $newUser['favoris_cms'];

                    $stmtTakeId = self::$_instance_db->prepare("SELECT id FROM cms WHERE cms_name = :cmsFavoris"); 
                    $stmtTakeId->bindParam(':cmsFavoris', $cmsFavoris); 
                    $stmtTakeId->execute();                  
                        $rowCmsId = $stmtTakeId->fetchAll(\PDO::FETCH_ASSOC); 
                        $favorisCmsId = $rowCmsId[0]['id']; 

                $stmt->bindParam(':favorisCmsId', $favorisCmsId, \PDO::PARAM_INT); 
                        
            } else {
                return;
              } 

                $dateSubscribe = Date('Y-m-d');
                $stmt->bindParam(':dateSubscribe', $dateSubscribe); 

                    $stmtVerifExist = self::$_instance_db->prepare("SELECT id FROM users WHERE email_user = :emailUser AND lastname = :lastName");
                    $stmtVerifExist->bindParam(':emailUser', $emailUser); 
                    $stmtVerifExist->bindParam(':lastName', $lastName);
                    $stmtVerifExist->execute();                  
                    $rowUserUniq = $stmtVerifExist->fetchAll(\PDO::FETCH_ASSOC); 

                        if (count($rowUserUniq) > 0) {
                            header('Location: ' .LOGIN. '?user=user-exist');
                            exit;
                        } else if ($stmt->execute()) {
                                $userId = $this->getUserId($emailUser, $lastName); 

                                $this->_datas_cms['cms_id'] = (int)$favorisCmsId;
                                $this->_datas_cms['favoris_user_id'] = $userId[0]["id"]; 

                                    $rowUsedCms = $this->getUsedCms(); 

                                    if (count($rowUsedCms) < 1) {
                                        $this->insertUsedCms();
                                            header('Location: ' .LOGIN. '?user=user-insert');
                                            exit;
                                    } else {
                                        return; // voir pour logger les infos vers administrator en cas de passage ici
                                    }
                        }
        }
    
    
        private function insertUsedCms() {
            $stmt = self::$_instance_db->prepare("INSERT INTO used_cms (cms_id, favoris_user_id) VALUES (:cmsId, :favorisUserId)");
                $stmt->bindParam(':cmsId', $this->_datas_cms['cms_id']); 
                $stmt->bindParam(':favorisUserId', $this->_datas_cms['favoris_user_id']);
                $stmt->execute();
        }
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    


    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/

    public function updateStatutUser($userId, $levelRight, $typeUser) { 
        $stmt = self::$_instance_db->prepare("UPDATE users SET level_right = :levelRight, type_user = :typeUser WHERE id = :userId");
            $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
            $stmt->bindParam(':levelRight', $levelRight, \PDO::PARAM_INT);
            $stmt->bindParam(':typeUser', $typeUser, \PDO::PARAM_STR); 
                $stmt->execute();
    }

    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/



    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/
    
        public function deleteUser($id) {    
            $stmt = self::$_instance_db->prepare('DELETE from users WHERE id = :id');
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                    if ($stmt->execute()) {
                        $stmt = self::$_instance_db->prepare('DELETE from used_cms WHERE favoris_user_id = :id');
                            $stmt->bindParam(':id', $id);
                                $stmt->execute();
                    }
        }
    
    }
    
    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/

