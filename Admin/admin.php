<?php
session_start();
  
    require_once("../Config/config.php");

    if (!isset($_SESSION['uniqId'])) {
        header('Location: ' .ACCUEIL);
        exit;
    }

    require_once("../View/header_page.php");
    require_once("../controller/process_logout.php");
?>

    <body>

        <?php
            require_once("../View/home_menu.php");
        ?>

        <?php
        //if (isset($_SESSION["uniqId"]) && $_SESSION["level"] === 1) {
            require_once("interfaces_administrations/content_admin.php");
       // } else if (isset($_SESSION["uniqId"]) && $_SESSION["level"] === 2) {
            //require_once("interfaces_administrations/content_admin_editor.php");
       // } else if (isset($_SESSION["uniqId"]) && $_SESSION["level"] === 3) {
            //require_once("interfaces_administrations/content_admin_subscriber.php");
       // }
        ?>

        <script src="<?php echo JQUERY; ?>"></script>
        <script src="<?php echo BOOTSTRAP_JS; ?>"></script>
        <script src="<?php echo INDEX_JS; ?>"></script>
        <script src="<?php echo ADMIN_JS; ?>"></script>

    </body>

</html>