<?php

// IN THIS all messages errors or succes taked in GET method for informations in user 

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

if (isset($_GET['msg-status-book'])) { 
    if ($_GET['msg-status-book'] === "success-insertion-book") {
        $msg = nl2br("L'insertion de ce nouveau livre à été éffectué avec succès dans la médiathèque \r\n");
        $msg.= $_GET['cover-page'];
    } else if ($_GET['msg-status-book'] === "error-insertion-book") {
          $msg = "Ce livre éxiste déjà";
        } else if ($_GET['msg-status-book'] === "empty") {
            $msg = "Les champs sont vides.";
          } else if ($_GET['msg-status-book'] === "incomplete") {
              $msg = "Tous les champs doivent être remplis correctement.";
            }   else if ($_GET['msg-status-book'] === "incorrect") {$msg = "Un des champs ne possède pas la valeur ou le nombre de caractères attendus.";} 
                else if ($_GET['msg-status-book'] === "unknown") {$msg = "Une erreur est survenu.";}
                else if ($_GET['msg-status-book'] === "book-exist") {$msg = "Ce livre éxiste déjà dans la médiathèque.";}
                else if ($_GET['msg-status-book'] === "rent-success") {$msg = "Vous avez loué ce livre, il vous attend à la médiathèque.";}
                else if ($_GET['msg-status-book'] === "rent-not") {$msg = "Ce livre à déjà été loué";}
                else if ($_GET['msg-status-book'] === "rent-finish") {$msg = "Ce livre à été remis à la médiathèque";}
}

