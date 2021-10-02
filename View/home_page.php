    <?php
        require_once("Config/config.php");
        $dbName = new \PDO(DSN , DB_USER, DB_PASS);
        
        require_once("model/Dbconnect.php");
        //var_dump($dbName);
    ?>
    
    <div class="d-flex align-items-center bg_screen">

    <aside class="home-buttons d-flex row justify-content-center">
        <input type="button" class="btn btn-primary px-5 py-4 mx-3 my-4 rounded-pill connexion" value="Se connecter">
        <input type="button" class="btn btn-primary px-5 py-4 mx-3 my-4 rounded-pill registration" value="inscrire">
    </aside>

    </div>