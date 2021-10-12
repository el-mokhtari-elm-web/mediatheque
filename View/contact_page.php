<?php

session_start();

  require_once("../Config/config.php");
  require_once("header_page.php");
  require_once("../Controller/process_logout.php");
?>

    <body class="bg-section-register">

        <?php
            require_once("home_menu.php");
            require_once("modal_cookies.php");
        ?>

        <section class="d-flex row justify-content-center align-items-center section-contact">
          <aside class="container w-75 px-2 contact">
              <aside class="row bloc-contact">
                  <aside class="col-md-3 mb-5 bloc-contact-infos">
                      <div class="contact-infos">
                          <img src="../assets/svg/contact.svg" class="img-contact" alt="image"/>
                          <h2>Contactez nous</h2>
                          <h4>Et nous vous répondons !</h4>
                      </div>
                  </aside>

                  <form id="login-form" class="col-md-9 py-2 mb-5 contact-form" action="" method="post" name="form_contact">
                      <div class="form-group py-2">
                          <label class="control-label col-sm-8 m-auto col-10" for="firstname">Nom  
                              <input type="text" class="form-control" id="firstname" placeholder="Jacques" name="firstname">
                          </label>
                      </div>

                      <div class="form-group py-2">
                          <label class="control-label col-sm-8 m-auto col-10" for="lastname">Prénom       
                              <input type="text" class="form-control" id="lastname" placeholder="Dupont" name="lastname">
                          </label> 
                      </div>

                      <div class="form-group py-2">
                          <label class="control-label col-sm-8 m-auto col-10" for="email">Adresse mail
                              <input type="email" class="form-control" id="email" placeholder="jacques@gmail.com" name="email">
                          </label>
                      </div>

                      <div class="form-group py-2">
                          <label class="control-label col-sm-8 m-auto col-10" for="email">Sujet
                              <input type="text" class="form-control" id="email" placeholder="titre" name="sujet">
                          </label>
                      </div>

                      <div class="form-group py-2">
                          <label class="control-label col-sm-8 m-auto col-10" for="message">Votre message <?php if (isset($succes)) : ?><span id="msg-status" class="<?php if ($succes === true) { echo "succes"; } else { echo "failure"; } ?>"><?php if (isset($msg_succes)) { echo $msg_succes; } ?></span><?php endif; ?>
                              <textarea class="form-control" rows="4" id="message" name="message"></textarea>
                          </label>
                      </div>

                      <div class="form-group">        
                          <div class="col-sm-offset-2 col-sm-10 m-auto contact-submit">
                              <input type="submit" id="submit" class="d-block w-50 mt-1 mb-3 py-3 mx-auto btn btn-info btn-md submit" value="Envoyer" name="submit">
                          </div>
                      </div>
                  </form>
              </aside>
          </aside>
        </section>

        <?php require_once("footer_min.php"); ?>

        <script type="text/javascript" src="<?php echo BOOTSTRAP_JS; ?>" defer></script>

        <script>
            (function(){  
                window.addEventListener("DOMContentLoaded", function() {
                    var navBarToggler = document.getElementById("navbar-toggler");
                    var navBarResponsiv = document.getElementById("navbarResponsive");
                    var msgStatus = document.getElementById("msg-status");

                    if (msgStatus != null) {
                        (msgStatus.className === "succes" ? msgStatus.style.color = "green" : msgStatus.style.color = "red");

                        setTimeout(() => {
                        msgStatus.style.color = "transparent";
                        msgStatus.style.transitionProperty = "color";
                        msgStatus.style.transitionDelay = "0";
                        msgStatus.style.transitionDuration = "3.25s";
                            msgStatus.addEventListener("transitionend", function() {
                                msgStatus.style.display = "none";
                            });
                    }, 3500);
                    }
                });   
            })()
        </script>

        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo JQUERY; ?>"></script>
        <script src="<?php echo BOOTSTRAP_JS; ?>"></script>
        <script src="<?php echo INDEX_JS; ?>"></script>

    </body>

</html>