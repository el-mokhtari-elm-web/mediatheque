<?php
  session_start();
  
  require_once("../Config/config.php");
  require_once("header_page.php");
  require_once("../Controller/process_logout.php");
?>

    <body>

        <?php
            require_once("home_menu.php");
        ?>

        <div class="container-fluid d-block w-50 m-auto text-center">
            <h2>ELM web services<span class="blinker">.</span></h2>
            <button type="button" class="btn btn-default">Loi et Confidentialité</button>
        </div>

        <div class="container-fluid home-content1">
            <div class="row">
                <div class="col-md-6 content1-left">
                    <h3>Why to use Bootstrap <span class="blinker">?</span></h3>
                    <p>Build responsive, mobile-first projects on the web with the world’s most popular front-end component library.</p>
                </div>
                    
                <div class="col-md-6 content1-right">
                    <p>Bootstrap is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with our Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful plugins built on jQuery.</p>
                </div>
            </div>
        </div>

        <div class="container-fluid home-content2">
            <p><span>News</span> and <span>announcements</span> for all things <span>Bootstrap</span>, including new <span>releases</span> and <span>Bootstrap Themes</span>.</p>
        </div>

        <?php require_once("footer_min.php"); ?>

        <script type="text/javascript" src="<?php echo BOOTSTRAP_JS; ?>" defer></script>

    </body>

</html>