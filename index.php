<?php
  session_start();

  require_once("Config/config.php");
  require_once("View/header_page.php");

  if ($_SERVER["REQUEST_URI"] === ACCUEIL.'/') {
    require("Controller/process_logout.php");
  }
  
  require_once("Controller/process_cookies.php");
?>

    <body>

        <!-- Navigation -->
          <?php 
              require_once("View/home_menu.php");
          ?>

          <?php
            require_once("View/home_page.php");
            require_once("View/modal_cookies.php");
          ?>

          <?php
            require_once("View/footer_min.php");
          ?>



    </body>

</html>
