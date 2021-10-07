<?php
session_start();

  require_once("../Config/config.php");
  require_once("header_page.php");
  require_once("../Controller/process_logout.php");

  $msg = ""; 

  if (isset($_GET['msg-status'])) {
      if ($_GET['msg-status'] === "succes-registration") {$msg = "Inscription éffectué avec succès, en attente de validation par un modérateur.";}
  }
?>

    <body class="bg-section-register">

        <?php
            require_once("home_menu.php");
            require_once("modal_cookies.php");
        ?>

        <section class="d-flex column justify-content-center align-items-center section-register">
                <aside class="container w-75 pt-1 pb-3 px-5 rounded register">

                  <h4 class="col-lg-10 col-12 mx-auto mt-1 pb-2 text-center">Fiche d'inscription</h4>

                        <form id="form_register" action="../Controller/process_register.php" method="post" name="form_register">
                            <aside class="d-inline-block form-group pb-3">
                                <label for="firstname" class="d-inline-block">Firstname
                                    <input type="text" id="firstname" class="form-control" name="firstname" placeholder="maxense" />
                                </label>

                                <label for="lastname" class="d-inline-block">Lastname
                                    <input type="text" id="lastname" class="form-control" name="lastname" placeholder="albert" />
                                </label>
                            </aside>

                            <aside class="form-group pb-3">
                                <label for="email" class="mr-3">Email
                                  <input type="email" id="email" class="form-control" name="email" placeholder="maxense@gmail.fr" />
                                </label>

                                <label for="date_of_birth" class="mr-3">Date de naissance
                                  <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" />
                                </label>

                                <label for="postal_code">Code postal
                                  <input type="text" id="postal_code" class="form-control" name="postal_code" placeholder="59600" />
                                </label>
                            </aside>

                            <aside class="form-group pb-3">
                                <label for="adress">Adresse</label>
                                <input type="text" id="adress" class="form-control" name="adress" placeholder="22, rue de l'espérance bloc Saturn" />
                            </aside>

                            <hr class="my-1" />

                            <aside class="row mb-4 pb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pass_user">Mot de passe</label>
                                        <input type="password" id="pass_user" class="form-control" name="pass_user" />
                                    </div>
                                </div>

                                <span id="msg-status" class="<?php echo $_GET['msg-status']; ?>"><?php echo $msg; ?></span>
                                
                                <div class="col-md-6">
                                    <dl class="small text-muted pl-4 mb-0">
                                      <dt class="small text-muted mb-2">Conditions de validation du mot de passe:</dt>
                                      <dd>Entre 10 et 20 caractères</dd>
                                      <dd>Comprenant (Majuscules, chiffres, caractères spéciaux)</dd>
                                    </dl>
                                </div>
                            </aside>

                            <aside>
                                <input type="hidden" name="type_user" value="user_subscriber">
                                <input type="submit" class="d-block col-lg-4 col-12 m-auto btn btn-primary py-3 submit-register" name="submit" value="Envoyer">
                                <span class="d-block col-lg-4 col-12 my-1 mx-auto text-center submit-register">Vous avez un compte ? <a href="<?php echo LOGIN; ?>" class="ml-3">Par ici</a></span> 
                            </aside>
                        </form>
                        
                </aside>
        </section>

        <?php
            require_once("footer_min.php"); 
        ?>

        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo JQUERY; ?>"></script>
        <script src="<?php echo BOOTSTRAP_JS; ?>"></script>
        <script src="<?php echo INDEX_JS; ?>"></script>
        <script src="<?php echo REGISTER_JS; ?>"></script>

    </body>

</html>
