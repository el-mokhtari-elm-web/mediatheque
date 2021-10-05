<?php
  session_start();
  
  require_once("../Config/config.php");
  require_once("header_page.php");
  require_once("../Controller/process_cookies.php");
  require_once("../Controller/process_logout.php");

  if (isset($_POST['status-cookies'])) {
    $_SESSION['status-cookies'] = $_POST['status-cookies'];
  }
?>

    <body>

        <?php
            require_once("home_menu.php");
        ?>

        <?php
            require_once("rgpd_text.php");
        ?>

          <!-- Bootstrap core JavaScript -->
          <script src="<?php echo JQUERY; ?>"></script>
          <script src="<?php echo BOOTSTRAP_JS; ?>"></script>
          <script src="<?php echo INDEX_JS; ?>"></script>

        <?php
            require_once("footer_min.php"); 
        ?>

    </body>

</html>