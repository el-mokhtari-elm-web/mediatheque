<?php

session_start();
    require_once("../Config/config.php");

    require_once("header_page.php");

?>

    <body class="position-relative px-5">

    <?php
        require_once("home_menu.php");
    ?>

        <h1 class="d-block w-50 mx-auto my-5 text-info text-center title-page">Infos Coronarirus</h1>

        <section class="d-flex-inline row flex-wrap py-2 justify-content-center flex-wrap rounded align-items-center section-book-page">

            <aside class="container w-100 py-1 px-4 rounded d-flex justify-content-center align-items-center flex-wrap flex-row-reverse page-book">
                <p class="bg-info px-5 py-3 rounded">Cette page est en construction pour le Dossier Projet</p>
            </aside>

        </section>

        <script type="text/javascript" src="<?php echo JQUERY; ?>"></script>
        <script type="text/javascript" src="<?php echo BOOTSTRAP_JS; ?>"></script>

    </body>

</html>