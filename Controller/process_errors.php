<?php

$msg = "";

if (isset($_GET['msg-status-user'])) { 
    if ($_GET['msg-status-user'] === "success-insertion-user") {
        $msg = "L'enregistrement de ce nouvel utilisateur à été éffectué avec succès";
      } else if ($_GET['msg-status-user'] === "empty") {
          $msg = "Les champs sont vides.";
        } else if ($_GET['msg-status-user'] === "incomplete") {
            $msg = "Tous les champs doivent être remplis correctement.";
          } else if ($_GET['msg-status-user'] === "incorrect") {$msg = "Un des champs ne possède pas la valeur ou le nombre de caractères attendus.";} 
            else if ($_GET['msg-status-user'] === "unknown") {$msg = "Une erreur est survenu.";}
            else if ($_GET['msg-status-user'] === "user-exist") {$msg = "Cet utilisateur éxiste déjà.";}
}

if (isset($_GET['msg-status-img'])) { 
    if ($_GET['msg-status-img'] === "success-insertion-book") {
        $msg = nl2br("L'insertion de ce nouveau livre à été éffectué avec succès dans la médiathèque \r\n");
        $msg.= $_GET['cover-page'];
    } else if ($_GET['msg-status-img'] === "error-insertion-book") {
          $msg = "Ce livre éxiste déjà";
        } else if ($_GET['msg-status-img'] === "empty") {
            $msg = "Les champs sont vides.";
          } else if ($_GET['msg-status-img'] === "incomplete") {
              $msg = "Tous les champs doivent être remplis correctement.";
            }   else if ($_GET['msg-status-img'] === "incorrect") {$msg = "Un des champs ne possède pas la valeur ou le nombre de caractères attendus.";} 
                else if ($_GET['msg-status-img'] === "unknown") {$msg = "Une erreur est survenu.";}
}

