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

    <body class="d-flex column justify-content-center pt-1 align-items-center bg-section-register">

      <?php
          require_once("home_menu.php");
          require_once("modal_cookies.php");
      ?>

        <section class="d-flex justify-content-center flex-wrap align-items-center section-login">
            <aside class="container col-lg-6 col-12 login">
                <form id="login-form" class="form" action="../Controller/process_submit.php" method="post">
                    <h3 class="text-center text-dark">Connexion</h3>

                    <div class="form-group my-4">
                        <label for="username" class="d-inline m-auto col-lg-6 text-left text-dark">Email :</label><br>
                        <input type="text" id="username" class="d-block m-auto form-control col-lg-6 text-left" name="email">
                    </div>

                    <div class="form-group my-4">
                        <label for="password" class="d-inline m-auto col-lg-6 text-left text-dark">Mot de passe :</label><br>
                        <input type="text" id="password" class="d-block m-auto form-control col-lg-6 text-left" name="pass_user">
                    </div>

                    <div class="form-group my-4">
                        <input type="submit" class="d-block m-auto w-75 btn btn-info btn-md py-3 submit" value="Connexion" name="submit">
                        <p class="msg-login"><?php if (isset($_GET['message'])) { if ($_GET['message'] === "empty") { echo $msgEmpty; } else if ($_GET['message'] === "unknown") { echo $msgUnknown; } else if ($_GET['message'] === "incomplete") { echo $msgIncomplete; } else {return;} echo '<a class="d-inline-block w-25 mt-3 small text-center msg-login" href="login_page.php">❌</a>'; } ?></p>
                        <p><?php if (isset($_GET['user']) && $_GET['user'] !== "unconnected") { if ($_GET['user'] === "user-insert") { echo $userInsert; } else if ($_GET['user'] === "user-exist") { echo $userExist; } echo '<a class="d-inline-block w-25 mt-3 small text-center msg-login" href="login_page.php">❌</a>'; } ?></p>
                    </div>
                                  
                    <div id="register-link" class="w-25 m-auto text-center mt-3">
                        <a href="<?php echo REGISTER; ?>" class="d-inline-block text-dark">S'enregistrer</a>
                    </div>
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

    </body>

</html>