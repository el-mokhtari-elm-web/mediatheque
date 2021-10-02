<?php
  session_start();
  
  require_once("../Config/config.php");
  
  require_once("header_page.php");
  require_once("../Controller/process_logout.php");

  $msgEmpty = "Les deux champs sont obligatoires";
  $msgIncomplete = "Les deux champs doivent avoir entre 12 et 30 charactères";
  $msgUnknown = "Utilisateur non reconnu";
  $userExist = "Cet utilisateur éxiste déjà, connectez vous.";
  $userInsert = "Insertion éffectué avec succès, vous pouvez vous connectez.";
?>

    <body>


    </body>

</html>