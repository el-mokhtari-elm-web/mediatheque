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
            require_once("View/modal_cookies.php");
          ?>

          <?php
            require_once("View/footer_min.php");
            echo "<pre>"; var_dump($_POST); echo "</pre>";
            echo "<pre>"; var_dump($_SESSION); echo "</pre>";
          ?>



    </body>

</html>
