<?php
session_start();

require_once("../Config/config.php");

if (!isset($_SESSION['uniqId'])) {
    header('Location: ' .LOGIN.'?user=unconnected'); 
    exit;
}

require_once("header_page.php");
require_once("../Controller/process_logout.php");
?>

    <body class="position-relative px-5">

        <?php
            require_once("home_menu.php");
        ?>

        <button class="d-inline-block w-auto position-absolute py-2 px-3 btn btn-secondary btn-back"><a class="text-light" href="<?php echo BOOKING; ?>"><- Retour</a></button>

        <h1 class="d-block w-50 mx-auto my-5 text-info text-center title-page">Fiche détails du livre</h1>

        <section class="d-flex row flex-wrap py-2 justify-content-center rounded align-items-center section-book-page">

            <aside class="container w-75 py-1 px-4 rounded page-book">
                <div class="row page-infos-book">

                    <div class="col-xs-12 details-book">

                        <h2 class="mb-3 titre-book"><?php echo 'Titre'; ?></h2>    
                        
                        <p class="infos-book mb-3">statistiques<span class="small nbr-rent">emprunté (300 fois)</span></p>
            
                        <h2 class="d-inline-block genre">drame</h2>

                        <div class="d-inline-block w-100 mt-3 block-resume-book">
                            <p class="d-inline-block w-75 px-1 resume-book">
                                dskughvsiughfsouhfqouhfoqehfeoqisuhfiqseuhgfqouhfoqeheiorhjfpiqeljfoqghjlifhjqlefhqhlqerHFLEHFESIIHLFILQEHJFQDJBFDKFGQZFGQEFYUEQRGFEQGFJQESGFDSHVFDSVFIDHGVUFDVHDSKFHDVKDSHVDSFK
                                dskughvsiughfsouhfqouhfoqehfeoqisuhfiqseuhgfqouhfoqeheiorhjfpiqeljfoqghjlifhjqlefhqhlqerHFLEHFESIIHLFILQEHJFQDJBFDKFGQZFGQEFYUEQRGFEQGFJQESGFDSHVFDSVFIDHGVUFDVHDSKFHDVKDSHVDSFK
                            </p>
                        </div>

                        <div class="rent-book">
                            <div class="d-flex flex-fill justify-content-between align-items-center">
                                <button class="d-block w-25 mx-auto mt-2 py-2 btn btn-success btn-check-rent" id="launch-modal" data-toggle="modal" data-target="#modal-rent-conditions">reserver</button>
                            </div>    
                        </div>                                        
                    </div>                              
            
                    <div class="d-flex justify-content-left">
                        <h4 class="d-inline-block auteur">auteur : <span>Dawud</span></h4>
                    </div>		
                </div>

                <?php
                    require_once("../View/modal_rent_conditions.php");
                ?>
            </aside>
        </section>

        <script type="text/javascript" src="<?php echo BOOTSTRAP_JS; ?>"></script>
        <script type="text/javascript" src="<?php echo JQUERY; ?>"></script>
        <script type="text/javascript" src="<?php echo INDEX_JS; ?>"></script>

    </body>

</html>