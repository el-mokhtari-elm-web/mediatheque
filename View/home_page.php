    <?php
        require_once("Config/config.php");
        $dbName = new \PDO(DSN , DB_USER, DB_PASS);
        
        require_once("model/Dbconnect.php");
    ?>
    
    <section class="d-flex align-items-center bg_screen">

        <aside class="d-flex flex-row flex-wrap align-items-center justify-content-around home-buttons">
            <a href="<?php echo LOGIN; ?>" class="d-block btn col-lg-5 col-12 py-3 px-5 btn-success my-4 rounded-pill connexion">Se connecter</a>
            <a href="<?php echo REGISTER; ?>" class="d-block btn col-lg-5 col-12 py-3 px-5 btn-primary my-4 rounded-pill registration">S'inscrire</a>
        </aside>

    </section>