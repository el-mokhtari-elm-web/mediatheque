<?php
  session_start();

  $msg = "";
  $disabled = "";

    require_once("../Config/config.php");
    require_once("../Model/Dbconnect.php");
    require_once("../Model/Usermanager.php");
    require_once("../Model/Bookmanager.php");

    if (!isset($_SESSION['uniqId'])) {
        header('Location: ' .LOGIN.'?user=unconnected'); 
        exit;
    }

    $dbName = new \PDO(DSN , DB_USER, DB_PASS); 

    $newUserManager = new media_library\Usermanager($dbName); 
    $user = $newUserManager->getUserById($_SESSION['userId']);
    $registration = $newUserManager->getUserRegistrationByUserId($_SESSION['userId']); 

    $newBookManager = new media_library\Bookmanager($dbName); 
    $genres = $newBookManager->_genres;

    $allBooks = $newBookManager->getBooks(); 
  
    require_once("header_page.php");

    require_once("../Controller/process_logout.php");
    require_once("../Controller/process_rent.php");
    require_once("../Controller/process_errors.php");

    if (isset($msg) && $msg !== "") {
        $msg .= '<a class="d-inline-block px-2 font-weight-bold text-center text-danger" href="library_page.php">X</a>';
    }

?>

    <body class="pb-3">

        <?php
            require_once("home_menu.php"); 
        ?>

        <div class="d-flex flex-row flex-wrap justify-content-between align-items-top fixed-top px-5 inner-main-header nav-library">  <!-- Inner main header -->                              
            <div class="d-flex flexrow justify-content-center align-items-center w-50 col-12 bloc-select-choice">   
                
                <form action="../Controller/process_request.php" id="form-genres-library" class="input-group border-info" name="form-genres-library">
                    <div class="input-group-prepend">
                        <label class="input-group-text label-choice" for="genre">Genres</label>
                    </div>
                        
                    <select class="custom-select w-50 border-info rounded bloc-choice" id="genre" name="genre">

                            <option id="all-genres" value="all-genres">Tout</option>

                        <?php
                            for($i = 0; $i < count($genres); $i++) :
                        ?>

                            <option value="<?php echo $genres[$i]; ?>"><?php echo $genres[$i]; ?></option> 

                        <?php
                            endfor;
                        ?>

                    </select>
                </form>

            </div>

            <div class="d-inline-block border-info bloc-search-bar">
                <div class="mx-auto w-75 search-bar ">
                    <input class="d-inline-block search_input" type="text" name="" placeholder=" Search...">
                    <a href="#" class="search_icon"><img src="<?php echo SVG.'/reset.svg'; ?>" height=""></a>
                </div>
            </div>
        </div> <!-- Inner main header -->

        <?php
            if ($registration[0]['by_full_name'] === NULL || $user[0]['statut_user'] === "non actif") : 
        ?>

        <div class="d-block mx-auto bg-info m5 p-5 rounded  mt-5 pt-5 h-100 text-center">
            <p class="pt-5 mt-5">Bonjour <?php echo $registration[0]['to_full_name']; ?></p>
            <p>En attente de contrôle ou validation...</p>
            <p>Vous ête inscrit depuis le <?php echo $newUserManager->dateToFrench($registration[0]['registration_date'],'l j F Y'); ?></p>
            <p class="small text-muted">Vous pouvez consulter l'état de votre inscription simplement en vous connectant</p>
        </div>

        <?php
            else :
        ?>

        <div class="container-fluid container-library">
            <div class="main-body mx-2 pt-2 pb-1">             
                <div class="inner-wrapper">
                    
                    <div class="inner-sidebar"> <!-- Inner sidebar -->
                        <div class="inner-sidebar-body p-0"> <!-- Inner sidebar body -->
                            <div class="p-1 h-100" data-simplebar="init">
                                <div class="simplebar-wrapper">
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset">
                                            <div class="simplebar-content-wrapper"></div>
                                                <span id="msg-status" class="<?php if (isset($_GET['msg-status-book'])) {echo $_GET['msg-status-book'];} else {echo "message";} ?>"><?php echo $msg; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /Inner sidebar body -->
                    </div> <!-- /Inner sidebar -->
                    
                    <div class="inner-main "> <!-- Inner main -->

                        <div class="inner-main-body p-2 p-sm-3 show"> <!-- Inner main body -->

                            <div class="d-flex bg-light flex-wrap col-lg-12 col-md-12 justify-content-left py-3 px-3 block-cards">

                                <?php 
                                    foreach ($allBooks as $key => $book) :
                                        $genre = $book['genre'].'-'.$key; 
                                        $statut = (int)$book['statut'];
                                        $bookId = (int)$allBooks[$key]['id'];

                                        $rentalStart = $newBookManager->getDateRental($book['id']); 

                                        $currentBook = $newBookManager->getBookById($book['id']);

                                            foreach ($currentBook as $key => $currentBook) :
                                ?>
                                    
                                    <div id="<?php echo $book['genre'].'-'.$key; ?>" class="col-lg-3 col-md-6 col-sm-6 mb-5 px-3 bg-light rounded bloc-card-book">
                                        <div id="<?php echo $book['id']; ?>" class="card h-70 border border-light card-book">
                                            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

                                            <span id="<?php echo $genre; ?>" class="d-inline-block page-cover"><img id="<?php echo $book['this_filename']; ?>" src="<?php echo COVER_PAGES.'/'.$book['this_filename']; ?>" class="card-img-top src-cover"></span>
                                            
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $book['book_title']; ?></h5>
                                                <p class="card-text small font-weight-bold"><?php echo substr($book['synopsis'], 0, 90). '...'; ?><span class="d-flex mt-2 justify-content-between align-items-center small"><a href="<?php echo BOOK_PAGE.'?id='.$book['id']; ?>">Voir plus</a><a href="#" class="launch-modal-text" id="launch-modal" data-toggle="modal" data-target="#modal-rent-conditions">Lire conditions</a></span></p>
                                            </div>

                                            <div class="d-block w-100 m-0 p-0 card-footer">
                                                <div class="progress">
                                                    <div id="<?php echo 'progress-'.$book['id']; ?>" class="progress-bar" role="progressbar" aria-valuenow="<?php if (count($rentalStart) > 0) { echo $rentalStart[0]['rental_start']; } else { echo "undefined"; } ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                            <form method="post" id="<?php echo $currentBook['id']; ?>" class="d-flex flex-fill justify-content-between align-items-center card-footer" name="form-rent">
                                                <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['userId']; ?>">
                                                <input type="submit" class="<?php echo 'd-block w-100 h-auto available btn'; ?> <?php if ((int)$currentBook['statut'] !== 0) {echo 'btn-success';} else {echo 'btn-danger';} ?> available" name="submit" value="<?php echo "Reserver"; ?>" <?php if (isset($_POST)) { if ((int)$currentBook['statut'] === 0) { echo "disabled"; } else {echo "";} }?>>
                                            </form>

                                        </div>
                                    </div>

                                <?php 
                                            endforeach;
                                    endforeach;
                                ?>

                            </div>

                            <?php
                                require_once("../View/modal_text_conditions.php");
                            ?>

                        </div> <!-- Inner main body -->

                    </div> <!-- Inner main -->  

                </div> <!-- Inner wrapper -->
            </div> <!-- main body -->
        </div> <!-- container -->

        <ul class="pagination pagination-sm pagination-circle justify-content-center mt-2 mb-0">
            <li class="page-item disabled">
                <span class="page-link has-icon">❰</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active"><span class="page-link">2</span></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link has-icon" href="#">❱</a>
            </li>
        </ul>

        <?php
            endif;
        ?>

        <script type="text/javascript" src="<?php echo BOOTSTRAP_JS; ?>"></script>
        <script type="text/javascript" src="<?php echo JQUERY; ?>"></script>
        <script type="text/javascript" src="<?php echo INDEX_JS; ?>"></script>
        <script type="text/javascript" src="<?php echo BOOKING_JS; ?>"></script>

    </body>

</html>