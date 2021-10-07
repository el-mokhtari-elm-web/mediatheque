<?php

if (!isset($_SESSION) && !isset($_SESSION['sessionId'])) {
    require_once("../Config/config.php");
    header('Location: ' .LOGIN);
    exit;
}

if (isset($_POST["logout"])) {
    if (isset($_SESSION['uniqId'])) {
            session_regenerate_id();
            session_destroy();

            header('Location: ' .LOGIN);
            exit;
    } else {
        header('Location: ' .LOGIN);
        exit;
      }
}





