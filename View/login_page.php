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

      <section class="d-flex justify-content-center flex-wrap align-items-center section-login">
          <aside class="container col-lg-4 col-12 login">
              <form id="login-form" class="form" action="" method="post">
                  <h3 class="text-center text-dark">Connexion</h3>

                  <div class="form-group my-4">
                      <label for="username" class="d-inline m-auto col-lg-10 text-left text-dark">Email :</label><br>
                      <input type="text" name="username" id="username" class="d-block m-auto form-control col-lg-10 text-center">
                  </div>

                  <div class="form-group my-4">
                      <label for="password" class="d-inline m-auto col-lg-10 text-left text-dark">Mot de passe :</label><br>
                      <input type="text" name="password" id="password" class="d-block m-auto form-control col-lg-10 text-center">
                  </div>
                                
                  <div id="register-link" class="w-25 m-auto mt-3">
                      <a href="<?php echo REGISTER; ?>" class="text-dark">S'enregistrer</a>
                  </div>
              </form>
          </aside>
      </section>

    </body>

</html>