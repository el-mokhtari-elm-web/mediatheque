<?php

$dbName = new \PDO(DSN, DB_USER, DB_PASS);

require_once("../model/Dbconnect.php"); 

require_once("../model/User.php");
require_once("../model/Usermanager.php");

if ((isset($_SESSION["uniqId"]) && ($_SESSION["sessionId"]) === session_id())) {
    $validateCheck = true;
    return $validateCheck;
} else if ($_SESSION["sessionId"] === session_id()) {
    $_SESSION["date"] = Date("d - m - y");

    $grainSaltSession = uniqid();
    $grainSaltPassword = "#AKph780MP5/*5dchhww0?/#lPOO";

        $password = md5($passUser.$grainSaltPassword);

            $newUser = new media_library\User($infosUser, $email, $password);

            $user = new media_library\Usermanager($dbName); 
            $userVerified = $user->getUserChecked($newUser); 
            $_SESSION["userId"] = $userVerified[0]["id"];

            $levelRight = intval($userVerified[0]["level_user"]);
            $statutUser = $userVerified[0]["statut_user"];

            $bigPassWordSession = $grainSaltSession.session_id();
            
                if (($bigPassWordSession === $grainSaltSession.session_id()) && ($levelRight > 0) && (!isset($_SESSION["uniqId"]))) {
                    $_SESSION["uniqId"] = uniqid();
                    $_SESSION["level"] = $levelRight;
                    $_SESSION["statut_user"] = $statutUser;
                    $validateCheck = true;
                } else {
                    $validateCheck = false;
                }
    }

    return $validateCheck;

