<?php
  //session_start();

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

        <!-- Page Footer -->
          <?php
              require_once("View/footer_page.php"); 
          ?>

        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo JQUERY; ?>"></script>
        <script src="<?php echo BOOTSTRAP_JS; ?>"></script>
        <script src="<?php echo INDEX_JS; ?>"></script>

    </body>

</html>
