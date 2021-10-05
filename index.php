<?php
  session_start();

  require_once("Config/config.php");
  require_once("View/header_page.php");
  require_once("Controller/process_cookies.php");
?>

    <body>

        <!-- Navigation -->
          <?php 
              require_once("View/home_menu.php");
          ?>

          <?php
            require_once("View/home_page.php");
          ?>

        

          <?php
            require_once("View/footer_min.php");
            echo "<pre>"; var_dump($_POST); echo "</pre>";
            echo "<pre>"; var_dump($_SESSION); echo "</pre>";
          ?>

          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg" id="<?php if (isset($_SESSION['status-cookies'])) {echo "cookieModalButton";} if (!isset($_POST['status-cookies'])) {echo "myModal";} else { $_SESSION['status-cookies'] = $_POST['status-cookies']; echo "cookieModalButton"; } ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content p-2">
                <a type="button" class="close" data-dismiss="modal" id="hide" data-target="#myModal" aria-label="Close">❌</a>
                
                <div class="modal-body cookies-text">Ce site utilise les cookies pour faciliter et ameliorer l'expérience utilisateur.</div>
                    <div class="d-flex modal-footer">

                    <?php 
                        require_once("View/rgpd_form.php");
                    ?>

                      <a href="<?php echo RGPD; ?>" class="d-flex align-self-stretch btn btn-secondary infos-rgpd"><span class="d-block m-auto">En savoir plus</span></a>
                    </div>
                </div>
              </div>
            </div>
          </div>

    </body>

</html>
