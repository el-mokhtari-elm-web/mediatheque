<?php
  session_start();

    require_once("../Config/config.php");

    if (!isset($_SESSION['uniqId'])) {
        header('Location: ' .LOGIN.'?user=unconnected'); 
        exit;
    }

    $dbName = new \PDO(DSN , DB_USER, DB_PASS);
    
    require_once("../model/Dbconnect.php");
    require_once("../model/Usermanager.php");

    $newUserManager = new media_library\Usermanager($dbName); 
    $user = $newUserManager->getUserRegistrationByUserId($_SESSION['userId']); 
  
    require_once("header_page.php");

    require_once("../Controller/process_logout.php");
?>

    <body class="pb-3">

        <?php
            require_once("home_menu.php"); 
        ?>

        <div class="d-flex flex-row flex-wrap justify-content-between align-items-top fixed-top px-5 inner-main-header nav-library">  <!-- Inner main header -->                              
            <div class="d-block w-50 col-12 bloc-select-tutos">                             
                <select class="d-inline-block border-info select-tutos">
                    <option selected="selected">CMS</option>
                    <option value="0">Wordpress</option>
                    <option value="1">woocommerce</option>
                    <option value="3">livres-noir</option>
                    <option value="3">virtuemart</option>
                    <option value="3">Prestahop</option>
                </select>

                <select class="d-inline-block border-info select-tutos">
                    <option selected="selected">Catégories</option>
                    <option value="">Page</option>
                    <option value="">Article</option>
                    <option value="">Medias</option>
                    <option value="">Back-end</option>
                </select>
            </div>

            <div class="d-inline-block border-info bloc-search-bar">
                <div class="mx-auto w-75 search-bar ">
                    <input class="d-inline-block search_input" type="text" name="" placeholder=" Search...">
                    <a href="#" class="search_icon"><img src="<?php echo SVG.'/reset.svg'; ?>" height=""></a>
                </div>
            </div>
        </div> <!-- Inner main header -->

        <?php
            if ($user[0]['by_full_name'] === NULL) : 
        ?>

        <div class="d-block mx-auto bg-info m5 p-5 rounded  mt-5 pt-5 h-100 text-center">
            <p class="pt-5 mt-5">Bonjour <?php echo $user[0]['to_full_name']; ?></p>
            <p>En attente de validation...</p>
            <p>Vous ête inscrit depuis le <?php echo $newUserManager->dateToFrench($user[0]['registration_date'],'l j F Y'); ?></p>
            <p class="small text-muted">Vous pouvez consulter l'état de votre inscription simplement en vous connectant</p>
        </div>

        <?php
            else :
        ?>

        <div class="container-fluid container-library">
            <div class="main-body mx-2 pt-2 pb-3">
                <div class="inner-wrapper">
                    
                    <div class="inner-sidebar"> <!-- Inner sidebar -->
                        <div class="inner-sidebar-body p-0"> <!-- Inner sidebar body -->
                            <div class="p-3 h-100" data-simplebar="init">
                                <div class="simplebar-wrapper">
                                    <!--<div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div>-->
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset">
                                                <div class="simplebar-content-wrapper"></div>
                                            </div>
                                        </div>
                                    <!--<div class="simplebar-placeholder" style="width: 234px; height: max-content;"></div>-->
                                </div>

                                <!--<div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 151px; display: block; transform: translate3d(0px, 0px, 0px);"></div></div>-->
                            </div>
                        </div> <!-- /Inner sidebar body -->
                    </div> <!-- /Inner sidebar -->
                    
                    <div class="inner-main "> <!-- Inner main -->


                        <div class="inner-main-body p-2 p-sm-3 show"> <!-- Inner main body -->

                            <?php

                            ?>

<div class="d-flex bg-light flex-wrap col-lg-12 justify-content-left py-3 px-3 block-cards">

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-success">reserver</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block px-2"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-danger" disabled>indisponible</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block px-2"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-success">reverver</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block px-2"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-success">reverver</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block px-2"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-success">reverver</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block px-2"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-success">reverver</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block px-2"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-danger" disabled>indisponible</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block px-2"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-success">reverver</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-9 col-sm-9 mb-5 px-3 bg-light rounded">
        <div class="card h-70 border border-light card-tuto-free">
            <div class="d-flex flex-row justify-content-between align-items-center opacity-25 col-lg-12 card label-free"></div>

            <span class="d-inline-block px-2"><img class="card-img-top" src="<?php echo SVG.'/livres-noir.svg'; ?>" height="110px"></span>
            
            <div class="card-body">
                <h4 class="card-title">Item Two</h4>
                <p class="card-text small font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. dore epsum diramor tariami...<span class="d-inline-block small"><a href="#" class="text-decoration">Voir plus</a></span></p>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center my-0 py-0 card-footer">
                <span class="d-inline-block small text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</span><a class="d-flex small" href="#"><img src="<?php echo SVG.'/play.svg'; ?>" height="39px"></a>
            </div>

            <div class="d-flex flex-fill justify-content-between align-items-center card-footer">
                <button class="d-block w-100 h-auto btn btn-success">reverver</button>
            </div>
        </div>
    </div>

</div>


                        </div> <!-- Inner main body -->

                    </div> <!-- Inner main -->                  
                </div> <!-- Inner wrapper -->

                <div class="modal forum-post" id="threadModal" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
                    <h2 class="text-white">Postez une question</h2>

                    <form class="col-md-12" method="post" name="forum-post">
                        <div>
                            <div class="form-group not-text">
                                <input type="text" class="d-block form-control" placeholder="Titre de la question" name="title_post" />
                            </div>


                            <label for="select-cms-post" class="align-middle w-100 py-auto text-white"><span class="py-2 px-3 mr-2 text-white w-25 rounded  bg-info">Catégorie du forum</span>
                                <select id="select-cms-post" class="custom-select custom-select-sm w-auto ml-2" name="cms_name">
                                    <option value="" selected="selected">Choisir un cms</option>
                                    <option value="wordpress">Wordpress</option>
                                    <option value="woocommerce">woocommerce</option>
                                    <option value="livres-noir">livres-noir</option>
                                    <option value="virtuemart">Virtuemart</option>
                                    <option value="prestashop">Prestashop</option>
                                </select>
                            </label>

                            <div class="form-group">
                                <div class="form-group">
                                    <textarea class="form-control text-post" height="270px" placeholder="Your message" name="content_post"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="hidden">
                            <input type="submit" name="submit" class="btn btn-success px-5 py-3" value="Envoyer">
                        </div>
                                
                        <a class="close-red" href="">❌</a>
                    </form>
                </div> <!-- new thread modal -->

            </div> <!-- main body -->
        </div> <!-- container -->

        <ul class="pagination pagination-sm pagination-circle justify-content-center mt-3 mb-2">
            <li class="page-item disabled">
                <span class="page-link has-icon">❰</span>
            </li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
            <li class="page-item active"><span class="page-link">2</span></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
            <li class="page-item">
                <a class="page-link has-icon" href="javascript:void(0)">❱</a>
            </li>
        </ul>

        <?php
            endif;
        ?>

        <script type="text/javascript" src="<?php echo BOOTSTRAP_JS; ?>"></script>

    </body>

</html>