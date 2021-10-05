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
    $favorisCms = trim(htmlspecialchars($_POST["favoris_cms"]));

    $email = trim(htmlspecialchars($_POST["email"]));
    $passUser = trim(htmlspecialchars($_POST["pass_user"]));

    if (empty($firstname) && empty($lastname) && empty($favorisCms) && empty($email) && empty($passUser)) {
        header('Location: ' .REGISTER. '?message=empty');
        exit;
    } else if (((strlen($firstname) > 30 || strlen($lastname) > 30) || strlen($favorisCms) > 12 || strlen($email) > 30 || strlen($passUser) > 30) OR ((strlen($firstname) < 2 || strlen($lastname) < 2 || strlen($favorisCms) < 6 || strlen($email) < 7 || strlen($passUser) < 7))) {
        header('Location: ' .REGISTER. '?message=incomplete');
        exit;
      } else {

            $user = [];
            $user['firstname'] = $firstname;
            $user["lastname"] = $lastname;
            $user['favoris_cms'] = $favorisCms;

                $newUser = new elm\User($user, $email, $passUser);
                $newUserManager = new elm\Usermanager($dbName);
                $insertUser = $newUserManager->insertUser($newUser);

        }
}

