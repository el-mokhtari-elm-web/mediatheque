<?php

session_start();

require_once("../Config/config.php");

$infosUser = [];

if (isset($_POST['submit'])) {

    $email = htmlspecialchars($_POST["email"]);
    $passUser = htmlspecialchars($_POST["pass_user"]);

    $infosUser['email'] = $_POST["email"];
    $infosUser['pass_user'] = $_POST["pass_user"];

    if (empty($email) && empty($passUser)) {
        header('Location: ' .LOGIN. '?message=empty');
        exit;
    } else if ((strlen($email) > 30 || strlen($passUser) > 30) OR (strlen($email) < 7 || strlen($passUser) < 7)) {
        header('Location: ' .LOGIN. '?message=incomplete');
        exit;
      } else {
            $_SESSION["sessionId"] = session_id();
            echo $_SESSION["sessionId"]; 

            require_once("../controller/process_login.php"); 

            if ($validateCheck === true) {
                header('Location: ' .ADMIN);
                exit;
            } else {
                header('Location: ' .LOGIN.'?message=unconnected');
                exit;
            }
        }
} 




