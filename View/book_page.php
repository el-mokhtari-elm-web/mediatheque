<?php

session_start();

require_once("../Config/config.php");

if (!isset($_SESSION['uniqId'])) {
    header('Location: ' .LOGIN.'?user=unconnected'); 
    exit;
}

require_once("header_page.php");
require_once("../Controller/process_logout.php");
require_once("../Controller/process_errors.php");
require_once("../Model/Dbconnect.php");
require_once("../Model/Usermanager.php");
require_once("../Model/Bookmanager.php");

$dbName = new \PDO(DSN , DB_USER, DB_PASS);
$newUserManager = new media_library\Usermanager($dbName);
$newBookManager = new media_library\Bookmanager($dbName);

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $book = $newBookManager->getBookById($id);
    $currentBook = $newBookManager->getBookById((int)$id); 
    $registration = $newUserManager->getUserRegistrationByUserId($_SESSION['userId']);
}

?>

    <body class="position-relative px-5">

        <?php
            require_once("home_menu.php");
        ?>

        <button class="d-inline-block w-auto position-absolute py-2 px-3 btn btn-secondary btn-back"><a class="text-light" href="<?php echo BOOKING; ?>"><- Retour</a></button>

        <h1 class="d-block w-50 mx-auto my-5 text-info text-center title-page">Fiche détails du livre</h1>

        <section class="d-flex-inline row flex-wrap py-2 justify-content-center flex-wrap rounded align-items-center section-book-page">

            <aside class="container w-100 py-1 px-4 rounded d-flex justify-content-center align-items-center flex-wrap flex-row-reverse page-book">

                <?php
                    if (count($book) > 0) :
                ?>

                <div class="d-inline">
                    <span class="d-inline-block"><img src="<?php echo COVER_PAGES.'/'.$book[0]['this_filename']; ?>" class=""></span>
                </div>
                
                <div class="row page-infos-book col-lg-8 col-md-6 col-sm-12">

                    <div class="col-xs-12 details-book">

                        <h2 class="mb-3 titre-book"><?php echo $book[0]['book_title']; ?></h2>    
                        
                        <p class="infos-book mb-3">statistiques<span class="small nbr-rent">emprunté (300 fois)</span></p>
            
                        <h2 class="d-inline-block genre"><?php echo $book[0]['genre']; ?></h2>

                        <div class="d-inline-block w-100 mt-3 block-resume-book">
                            <p class="d-inline-block w-75 px-1 resume-book"><?php echo $book[0]['synopsis']; ?></p>
                        </div>

                        <div class="rent-book">
                            <div class="d-flex flex-fill justify-content-between align-items-center">
                                <button class="d-block w-25 mx-auto mt-1 mb-4 py-3 btn btn-success btn-check-rent launch-modal" id="launch-modal" data-toggle="modal" data-target="#modal-rent-conditions" <?php if ((int)$currentBook[0]['statut'] === 0) { echo "disabled"; } else {echo "";} ?>>reserver</button>
                            </div>    
                        </div>                                        
                    </div>                              
            
                    <div class="d-flex flex-row justify-content-left">
                        <h4 class="d-inline-block border border-muted text-muted auteur">auteur : <span class="text-dark"><?php echo $book[0]['author']; ?></span></h4>
                        <h4 class="d-inline-block border border-muted text-muted auteur">Date de parution : <span class="text-dark"><?php echo $book[0]['release_date']; ?></span></h4>
                    </div>		
                </div>

                <?php
                    else :

                        if (headers_sent()) {
                            die("<br><h3>valeur incorrect ⚠</h3><br>Revenir en sécurité vers la <a href='library_page.php'>Médiathèque</a>");
                        }
                            else {
                                exit(header('Location: ' .BOOKING));
                            }
                    endif;

                    require_once("../View/modal_rent_conditions.php");
                ?>
            </aside>
        </section>

        <script type="text/javascript" src="<?php echo BOOTSTRAP_JS; ?>"></script>
        <script type="text/javascript" src="<?php echo JQUERY; ?>"></script>
        <script type="text/javascript" src="<?php echo INDEX_JS; ?>"></script>

    </body>

</html>