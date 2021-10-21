<?php

    require_once("../Controller/process_errors.php"); 
    require_once("../Config/config.php");
    require_once("../Model/Dbconnect.php");
    require_once("../Model/Usermanager.php");
    require_once("../Model/Bookmanager.php");

    $dbName = new \PDO(DSN , DB_USER, DB_PASS);
    $dbConnect = new media_library\Dbconnect($dbName);
    $newUserManager = new media_library\Usermanager($dbName);
    $newBookManager = new media_library\Bookmanager($dbName);

    $users = $newUserManager->getUsers(); 
    $userConnected = $newUserManager->getUserById($_SESSION['userId']);  
    $usersActif = $newUserManager->getUserActifs();
    $booksNotAvailable = $newBookManager->getBooksNotAvailable();

    if (isset($_POST['update_by_admin'])) {
        $userIdConnected = (int)$userConnected[0]['id']; 
        $fullNameUserConnected = $userConnected[0]['firstname']. ' - ' .$userConnected[0]['lastname']; 
        $statutInjected = $_POST['statut_injected']; 
        $toUserId = (int)$_POST['user_id']; 

        $newUserManager->updateStatutUser($userIdConnected, $fullNameUserConnected, $statutInjected, $toUserId);
        $users = $newUserManager->getUsers();
    } 

    if (isset($_POST['update_book_statut'])) {
      $bookId = (int)$_POST['book_id'];
      return $newBookManager->updateStatutBookAfterRent($bookId);
    }

    $booksRented = $newBookManager->getBookRent(); 

?>                       

<div class="container">
      <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb mb-5 bg-info px-3 rounded">
              <ol class="breadcrumb menu-admin">
                <li class="breadcrumb-item"><h5 class="font-weight-bold p-0 m-0 accueil-admin">Bienvenue sur Votre espace d'administration</h5></li>
                <li class="logout"><form name="logout" method="post"><input type="hidden" name="hidden"><input type="submit" name="logout" value="Déconnexion"></form></li>
              </ol>
            </nav>
            <!-- /Breadcrumb -->

            <span id="msg-status" class="<?php if (isset($_GET['msg-status-book'])) {echo $_GET['msg-status-book'];} else if (isset($_GET['msg-status-user'])) {echo $_GET['msg-status-user'];} else {echo "message";} ?>"><?php echo $msg; ?></span>
    
            <div class="row gutters-sm">

                  <div class="col-md-4 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-column align-items-evenly justify-content-evenly text-center">

                              <picture><img src="<?php echo SVG.'/user.svg' ?>" alt="admin" width="100px"></picture>

                              <div class="mt-3">
                                  <h5><span class="d-inline-block mx-3"><?php echo $userConnected[0]['firstname']; ?></span><span class="d-inline-block"><?php echo $userConnected[0]['lastname']; ?></span></h5>
                                  <p class="text-dark mb-1"><span class="text-muted small mr-2">role :</span><?php echo $userConnected[0]['type_user']; ?></p>
                              </div>
                              
                              <aside class="d-flex flex-inline justify-content-evenly align-items-center flex-wrap my-3">
                                  <a href="#"><span class="d-flex text-secondary">github</span></a>
                                  <p class="mb-0"><a href="#"><picture class="d-flex mr-3 icon-inline"><img src="<?php echo SVG.'/github.svg' ?>" alt="admin" width="35px"></picture></a></p>
                              </aside>

                              <aside class="d-flex flex-column justify-content-evenly align-items-evenly">
                                  <p class="text-dark small"><span class="text-muted">Email : </span><span><?php echo $userConnected[0]['email_user']; ?></span></p>
                                  <p class="text-dark small mb-1"><span class="text-muted">Date de naissance : </span><span><?php echo $dbConnect->dateToFrench($userConnected[0]['date_of_birth'], 'l d F Y'); ?></span></p>
                              </aside>

                          </div>
                        </div>
                      </div>

                      <div class="d-block mt-5 card">
                          <div class="card-body">
                            <h6 class="d-block mx-auto text-center mb-3 text-info">Statistiques</h6>
                              <li class="d-flex align-items-center small mb-1"><span class="d-block small text-success text-right px-3">Nombre d'utilisateurs actifs :</span><?php echo $usersActif[0]['count_users_actifs']; ?></li>
                              <li class="d-flex align-items-center small mb-1"><span class="d-block small text-success text-right px-3">Abonnés non actifs :</span><?php echo count($users) - (int)$usersActif[0]['count_users_actifs']; ?></li>
                              <li class="d-flex align-items-center small mb-1"><span class="d-block small text-success text-right px-3">Nombre de livres sortis :</span><?php echo $booksNotAvailable[0]['books_not_available']; ?></li>
                          </div>
                      </div>
                  </div>
            
                  <div class="col-md-8 py-3 position-relative">
                    <h3 class="text-info my-0">Liste des inscriptions</h3>
              
                    <div class="d-flex justify-content-between text-success text-left">
                      <div class="d-flex text-success"><span class="position-relative">⬌</span></div>
                      <div class="d-flex text-success"><span class="position-relative">⬍</span></div>
                    </div>

                    <div class="card mb-5 border-info table-users">
                      <table id="table-users" class="table small">
                        <thead>
                          <tr>
                            <th scope="col"></th>                        
                            <th scope="col">ID</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Enregistrement</th>
                            <th scope="col">Radiation</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Type</th>
                            <th scope="col"></th>

                          </tr>
                        </thead>

                        <tbody>
                          <?php 
                            foreach ($users as $key => $user) : 
                              if ($user['type_user'] === $_typeUser[3]) :
                                $currentUser = $newUserManager->getUserRegistrationByUserId($user['id']); 
                          ?>

                            <tr class="row-user">
                                <td scope="row"><input class="d-inline-block form-check-input mx-auto selected-row-employe" type="checkbox" name="selected-row-employe" <?php if ($user['type_user'] === "administrateur") {echo "disabled";} ?>></td>
                                <th scope="row"><?php echo $user['id']; ?></th>
                                <td><?php echo $user['firstname']; ?></td>

                                <td><?php echo $user['lastname']; ?></td>

                                <td><?php echo $dbConnect->dateToFrench($user['registration_date'], 'l d F Y'); ?></td>

                                <td><?php echo $user['termination_date']; ?></td>

                                <td>
                                  <select class="py-1 px-2 border border-none rounded <?php if ($user['statut_user'] === "actif") {echo "border-success";} else {echo "border-warning";} ?> statut-selected" name="statut_selected">
                                      <?php
                                        if ($user['type_user'] === "administrateur") : 
                                      ?>

                                          <option value="<?php echo $user['statut_user']; ?>"><?php echo $user['statut_user']; ?></option> 

                                      <?php
                                      else :
                                          for ($i = 0; $i < count($_statutUser); $i++) :   
                                      ?>

                                        <option value="<?php echo $_statutUser[$i]; ?>"<?php if ($user['statut_user'] === $_statutUser[$i]) {echo "selected";} ?>><?php if ($user['statut_user'] === "actif") {echo $user['statut_user']; break;} else if ($currentUser[0]['by_user_id'] !== NULL) {echo $user['statut_user']; break;} else { echo $_statutUser[$i]; } ?></option>  
                                        
                                      <?php
                                            if ($user['statut_user'] === "non actif" && isset($user['termination_date'])) { break; }
                                          endfor;
                                        endif;
                                      ?>
                                  </select>
                                </td>

                                <td><?php echo $user['type_user']; ?></td>

                                <td class="cell-update">
                                  <form method="post" name="form-update"><input type="hidden" class="statut-injected" name="statut_injected" value="<?php echo $user['statut_user']; ?>"><input type="hidden" class="update" name="user_id" value="<?php echo $user['id']; ?>"><label class="d-block block-update-by-admin"><input type="submit" name="update_by_admin" class="update-by-admin" value="" disabled></label></form>
                                </td>
                            </tr>
                            <?php
                              endif;
                            endforeach;
                            ?>
                        </tbody>
                      </table>
                    </div>


                    <div class="col-md-12 py-3 position-relative">
                      <h3 class="text-info my-0">Livres en attente de retour</h3>
                
                      <div class="d-flex justify-content-between text-success text-left">
                        <div class="d-flex text-success"><span class="position-relative">⬌</span></div>
                        <div class="d-flex text-success"><span class="position-relative">⬍</span></div>
                      </div>

                      <div class="card mb-5 table-users">
                        <table id="table-users" class="table small">
                          <thead>
                            <tr>
                                <th scope="col"></th>                        
                                <th scope="col">Date reception</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Livre</th>
                                <th class="small" scope="col">Réceptionner</th>
                                <th scope="col">Mettre à jour</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php
                              foreach ($booksRented as $key => $bookRented) : 
                                $dateRental = $newBookManager->getDateRental((int)$bookRented['book_id']); 
                            ?>
                              <tr class="row-user">
                                  <td scope="row"><input class="d-inline-block form-check-input mx-auto selected-row-book" type="checkbox" name="selected-row-book"></td>
                                  <th scope="row"><?php echo $dbConnect->dateToFrench($dateRental[0]['rental_start'], 'l d F Y'); ?></th>
                                  <td><?php echo $bookRented['firstname']; ?></td>
                                  <td><?php echo $bookRented['lastname']; ?></td>
                                  <td class="<?php if ($bookRented['statut'] !== 1) { echo 'bg-danger'; } else {echo 'bg-success';} ?>"><?php if ($bookRented['statut'] !== 1) { echo $_statutBook[0]; } else {echo $_statutBook[1];} ?></td>
                                  <td><?php echo $bookRented['book_title']; ?></td>

                                  <td>
                                    <select class="py-1 px-2 border border-none rounded statut-rent" name="statut_rent">
                                        <option value="<?php echo 0; ?>" <?php if ($i === $bookRented['statut']) {echo "selected";} ?>><?php if ($i === (int)$bookRented['statut']) { echo "receptionner"; } ?></option>  
                                    </select>
                                  </td>

                                  <td class="cell-update">
                                      <form method="post" name="statut-book"><input type="hidden" name="book_id" value="<?php echo $bookRented['book_id']; ?>"><input type="hidden" class="statut-injected" name="statut_injected" value=""><label class="d-block block-update-by-admin"><input type="submit" name="update_book_statut" class="update-by-admin" value="" disabled></label></form>
                                  </td>
                              </tr>
                              <?php
                                  endforeach;;
                              ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
      </div>
</div> 