<?php

session_start();

require_once("../Config/config.php");
$dbName = new \PDO(DSN , DB_USER, DB_PASS);

require_once("../model/Dbconnect.php"); 
require_once("../model/User.php");
require_once("../model/Usermanager.php");

if (isset($_POST['submit'])) {

    $firstname = trim(htmlspecialchars($_POST["firstname"]));
    $lastname = trim(htmlspecialchars($_POST["lastname"]));
    $dateOfBirth = trim(htmlspecialchars($_POST["date_of_birth"]));
    $postalCode = trim(htmlspecialchars($_POST["postal_code"]));
    $adress = trim(htmlspecialchars($_POST["adress"]));
    $typeUser = trim(htmlspecialchars($_POST["type_user"])); 

    $email = trim(htmlspecialchars($_POST["email"]));
    $passUser = trim(htmlspecialchars($_POST["pass_user"])); 

    if (empty($firstname) || empty($lastname) || empty($dateOfBirth) || empty($postalCode) || empty($adress) || empty($email) || empty($passUser) || empty($typeUser)) {
        if (!isset($_POST["administrateur_id"])) {
            header('Location: ' .REGISTER. '?msg-status-user=empty'); 
            exit; 
        } else {
            header('Location: ' .ADMIN. '?msg-status-user=empty'); 
            exit;
        }
    } else if (((strlen($firstname) > 30 || strlen($lastname) > 30) || strlen($dateOfBirth) > 10 || (strlen($postalCode) > 5 || !is_numeric($postalCode)) || strlen($adress) > 150 || strlen($email) > 50 || strlen($passUser) > 50 || strlen($typeUser) > 15) OR ((strlen($firstname) < 2 || strlen($lastname) < 3 || strlen($dateOfBirth) < 10 || strlen($postalCode) < 5 || strlen($adress) < 10 || strlen($email) < 5 || strlen($passUser) < 10 || strlen($typeUser) < 7))) {
        if (!isset($_POST["administrateur_id"])) {
            header('Location: ' .REGISTER. '?msg-status-user=incomplete');
            exit;
        } else {
            header('Location: ' .ADMIN. '?msg-status-user=incomplete');
            exit;
        }
      } else {

            $user = [];
            $user['firstname'] = $firstname;
            $user["lastname"] = $lastname;
            $user['date_of_birth'] = $dateOfBirth;
            $user['postal_code'] = $postalCode;
            $user['adress'] = $adress; 
            $user['type_user'] = $typeUser; 
            
            if (isset($_POST["administrateur_id"])) {
                $user['administrateur_id'] = (int)$_POST["administrateur_id"];
            }

                $newUser = new media_library\User($user, $email, $passUser);
                $newUserManager = new media_library\Usermanager($dbName);

                $insertUser = $newUserManager->verifiedUser($newUser); 

        }
}
 



