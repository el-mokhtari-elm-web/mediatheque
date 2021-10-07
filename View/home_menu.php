  <!-- Navigation -->
  <nav id="nav-height" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-3">
    <div class="container">
          <h1 class="m-auto text-center"><a class="navbar-brand" href="<?php echo ACCUEIL; ?>">Médiathèque Chapelle Curreaux</a></h1>

          <button id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="d-flex flex-row justify-content-center align-items-center collapse navbar-collapse all-navs" id="navbarResponsive">
            <ul class="navbar-nav ml-auto nav-principal text-center">
                <li class="nav-item home" id="<?php if ($_SERVER["REQUEST_URI"] === ACCUEIL.'/') { echo 'active'; } ?>">
                  <a class="nav-link" href="<?php echo ACCUEIL; ?>">&#8962;</a>
                </li>
                <li class="nav-item <?php if ($_SERVER["REQUEST_URI"] === A_PROPOS) { echo 'active'; } ?>">
                  <a class="nav-link" href="<?php echo A_PROPOS; ?>">A propos</a>
                </li>
                <li class="nav-item <?php if ($_SERVER["REQUEST_URI"] === CONTACT) { echo 'active'; } ?>">
                  <a class="nav-link" href="<?php echo CONTACT; ?>">Contact</a>
                </li>
                                <li class="nav-item <?php if ($_SERVER["REQUEST_URI"] === CONTACT) { echo 'active'; } ?>">
                  <a class="nav-link" href="<?php echo CONTACT; ?>">Infos coronavirus</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto nav-login-connex">

                <?php
                  if (!isset($_SESSION['uniqId'])) :
                ?>

                <li class="nav-item <?php if ($_SERVER["REQUEST_URI"] === LOGIN) { echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo LOGIN; ?>">Connexion</a>
                </li>

                <li class="nav-item <?php if ($_SERVER["REQUEST_URI"] === REGISTER) { echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo REGISTER; ?>">S'inscrire</a>
                </li>

                <?php
                  endif;
                ?>
                

                <?php
                  if ((isset($_SESSION['uniqId'])) && ($_SERVER["REQUEST_URI"] !== ADMIN)) :
                ?>

                <li class="nav-item">
                  <form class="nav-link btn-logout" method="post" name="logout"><input type="hidden" name="hidden"><input type="submit" name="logout" value=""></form>
                </li>

                <?php
                  endif;
                  if (isset($_SESSION['uniqId'])) :
                ?>

                <li class="nav-item">
                  <a class="nav-link icone-login" href="<?php echo ADMIN; ?>"><picture><img title="mon espace" width="21px" height="21px" src="<?php echo SVG.'/login.svg'; ?>"></picture><div></div></a>
                </li>

                <?php
                  endif;
                ?>

            </ul>


          </div>
    </div>
</nav>
<!-- Navigation -->





