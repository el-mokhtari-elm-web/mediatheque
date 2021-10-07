<?php

session_start();

require_once("../Config/config.php");
$dbName = new \PDO(DSN , DB_USER, DB_PASS);

require_once("../model/Dbconnect.php"); 
require_once("../model/User.php");
require_once("../model/Usermanager.php");

//var_dump($_POST); echo strlen($_POST["date_of_birth"]); exit;

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
        header('Location: ' .REGISTER. '?message=empty'); 
        exit; 
    } else if (((strlen($firstname) > 30 || strlen($lastname) > 30) || strlen($dateOfBirth) > 10 || strlen($postalCode) > 5 || strlen($adress) > 150 || strlen($email) > 50 || strlen($passUser) > 50 || strlen($typeUser) > 15) OR ((strlen($firstname) < 2 || strlen($lastname) < 3 || strlen($dateOfBirth) < 10 || strlen($postalCode) < 5 || strlen($adress) < 10 || strlen($email) < 5 || strlen($passUser) < 10 || strlen($typeUser) < 7))) {
        header('Location: ' .REGISTER. '?message=incomplete');
        exit;
      } else {

            $user = [];
            $user['firstname'] = $firstname;
            $user["lastname"] = $lastname;
            $user['date_of_birth'] = $dateOfBirth;
            $user['postal_code'] = $postalCode;
            $user['adress'] = $adress; 
            $user['type_user'] = $typeUser; 

                $newUser = new media_library\User($user, $email, $passUser);
                $newUserManager = new media_library\Usermanager($dbName);

                $insertUser = $newUserManager->verifiedUser($newUser);

        }
}

