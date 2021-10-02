<?php 
namespace media_library;

class Postmanager extends Dbconnect {

    
/*-----------------------------------------------------------USER CHECKED---------------------------------------------------------------*/

    public function getPostChecked(Post $newPost) {
        $titlePost = $newPost->getTitlePost();
        $cmsId = $newPost->getCmsId();
        $stmt = self::$_instance_db->prepare("SELECT title_post, cms_id FROM posts WHERE title_post = :titlePost AND cms_id = :cmsId");
        $stmt->bindParam(':titlePost', $titlePost);
        $stmt->bindParam(':cmsId', $cmsId, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
        if (count($row) < 1) {
            $this->insertPost($newPost); 
            //header('Location: ' .FORUM);
            exit;
        } else {
            //header('Location: ' .FORUM);
            exit;
          }
    }

/*-----------------------------------------------------------USER CHECKED---------------------------------------------------------------*/



    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/
    


    /*-----------------------------------------------------FUNCTIONS FOR GET------------------------------------------------------------*/    
    
    
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    
        private function insertPost(Post $post) {  
            $newPost = $post->getPost();
            $titlePost = $post->getTitlePost();
            $cmsId = $post->getCmsId(); 

            $stmt = self::$_instance_db->prepare("INSERT INTO posts (title_post, content_post, user_id, lastname, cms_id, nbr_responses, statut_post, date_post) VALUES (:titlePost, :contentPost, :userId, :lastName, :cmsId, :nbrResponses, :statutPost, :datePost)");

                $stmt->bindParam(':titlePost', $titlePost);
                    
                $contentPost = $this->testTextEntry($newPost['content_post']);
                $stmt->bindParam(':contentPost', $contentPost); 

                $userId = $newPost['user_id'];
                $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);

                $underStmt = self::$_instance_db->prepare("SELECT lastname FROM users WHERE id = :userId");
                    $underStmt->bindParam(':userId', $userId, \PDO::PARAM_STR);
                    $underStmt->execute();  
                    $row = $underStmt->fetchAll(\PDO::FETCH_ASSOC); 
                    $lastName = $row[0]['lastname'];

                $stmt->bindParam(':lastName', $lastName, \PDO::PARAM_STR);

                $stmt->bindParam(':cmsId', $cmsId, \PDO::PARAM_INT);

                $nbrResponses = 0;
                $stmt->bindParam(':nbrResponses', $nbrResponses, \PDO::PARAM_INT);

                $statutPost = 0;
                $stmt->bindParam(':statutPost', $statutPost, \PDO::PARAM_BOOL);
     
                $datePost = Date('Y-m-d');
                $stmt->bindParam(':datePost', $datePost);

                $stmt->execute();
        }
    
    /*----------------------------------------------------FUNCTIONS FOR INSERT----------------------------------------------------------*/
    
    

    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/

    public function updateStatutPost($idPost, $statutPost) { 
        $stmt = self::$_instance_db->prepare("UPDATE posts SET statut_post = :statutPost WHERE id = :idPost");
        $stmt->bindParam(':idPost', $idPost, \PDO::PARAM_INT); 
        $stmt->bindParam(':statutPost', $statutPost, \PDO::PARAM_BOOL); 
            $stmt->execute();
    }

    /*----------------------------------------------------FUNCTIONS FOR UPDATE----------------------------------------------------------*/

    

    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/
    
        public function deletePost($id) {    
            $stmt = self::$_instance_db->prepare('DELETE from posts WHERE id = :id');
                $stmt->bindParam(':id', $id);

                if ($stmt->execute()) {
                    deleteResponses($postId);
                }
        }

    /*----------------------------------------------------FUNCTIONS FOR DELETE----------------------------------------------------------*/
    
    
    }
    


