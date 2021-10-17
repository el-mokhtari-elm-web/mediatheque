<?php
 
require_once("../Controller/process_errors.php"); 

if (isset($msg) && $msg !== "") {
    $msg .= '<a class="d-inline-block px-2 font-weight-bold text-center text-danger" href="admin.php">X</a>';
}

    require_once("../Config/config.php"); 
    require_once("../Model/Dbconnect.php");
    $dbName = new \PDO(DSN , DB_USER, DB_PASS);

    require_once("../Model/Usermanager.php"); 
    require_once("../Model/Book.php");
    require_once("../Model/Bookmanager.php");
    require_once("../Model/Filemanager.php");
    require_once("../Controller/process_files.php"); 
    
    $newUserManager = new media_library\Usermanager($dbName); 
    $newBookManager = new media_library\Bookmanager($dbName); 
    $genres = $newBookManager->_genres;

    $users = $newUserManager->getUsers();  
    $userConnected = $newUserManager->getUserById($_SESSION['userId']); 

  if (isset($_POST['update_by_admin'])) {

      $userIdConnected = (int)$userConnected[0]['id']; 
      $fullNameUserConnected = $userConnected[0]['firstname']. ' - ' .$userConnected[0]['lastname']; 
      $statutInjected = $_POST['statut_injected']; 
      $toUserId = (int)$_POST['user_id']; 

      $newUserManager->updateStatutUser($userIdConnected, $fullNameUserConnected, $statutInjected, $toUserId);
      $userConnected = $newUserManager->getUserById($_SESSION['userId']);
      $users = $newUserManager->getUsers();

  } else if (isset($_POST['delete_by_admin'])) {

      $newUserManager->deleteUser((int)$_POST['get_id_user'], $_POST['statut_injected']);
      $users = $newUserManager->getUsers();
      $userConnected = $newUserManager->getUserById($_SESSION['userId']);

  }
?>                       

<div class="container">
    <div class="main-body">

          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb mb-4 bg-info px-3 rounded">
            <ol class="breadcrumb menu-admin">
              <li class="breadcrumb-item"><h5 class="font-weight-bold p-0 m-0 accueil-admin">Bienvenue sur Votre espace d'administration</h5></li>
              <li class="logout"><form name="logout" method="post"><input type="hidden" name="hidden"><input type="submit" name="logout" value="Déconnexion"></form></li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->

          <span id="msg-status" class="<?php if (isset($_GET['msg-status-book'])) {echo $_GET['msg-status-book'];} else if (isset($_GET['msg-status-user'])) {echo $_GET['msg-status-user'];} else {echo "message";} ?>"><?php echo $msg; ?></span>

          <div class="row gutters-sm my-5">
            
            <div class="col-md-4 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-evenly justify-content-evenly text-center">

                        <picture><img src="<?php echo SVG.'/user.svg' ?>" alt="admin" width="100px"></picture>

                        <div class="mt-3">
                            <h5><span class="d-inline-block mr-3"><?php echo $userConnected[0]['firstname']; ?></span><span class="d-inline-block"><?php echo $userConnected[0]['lastname']; ?></span></h5>
                            <p class="text-dark mb-1"><span class="text-muted small mr-2">role :</span><?php echo $userConnected[0]['type_user']; ?></p>
                        </div>
                        
                        <aside class="d-flex flex-inline justify-content-evenly align-items-center flex-wrap my-3">
                            <a href="#"><span class="d-flex text-secondary">github</span></a>
                            <p class="mb-0"><a href="#"><picture class="d-flex mr-3 icon-inline"><img src="<?php echo SVG.'/github.svg' ?>" alt="admin" width="35px"></picture></a></p>
                        </aside>

                        <aside class="d-flex flex-column justify-content-evenly align-items-evenly">
                            <p class="text-dark small"><span class="text-muted">Email : </span><span><?php echo $userConnected[0]['email_user']; ?></span></p>
                            <p class="text-dark small mb-1"><span class="text-muted">Date de naissance : </span><span><?php echo $userConnected[0]['date_of_birth']; ?></span></p>
                        </aside>

                    </div>
                  </div>
                </div>

                <form class="d-block card mt-3 mb-1 px-3 pt-3 pb-2" method="post" name="form-books" enctype="multipart/form-data">
                    <h3 class="text-info">Ajouter un livre</h3>

                    <div class="form-group">
                        <label for="book-title">Titre</label>
                        <input type="text" class="form-control" id="book-title" name="book_title" placeholder="da vinci code">
                    </div>

                    <div class="custom-file mt-4">
                      <span class="small">Page de couverture</span>
                        <label class="custom-file-label" for="img-book">Choisir
                            <input type="file" id="img-book" class="custom-file-input my-1" name="book_img[]" value="tutos">
                        </label>
                        <div id="infos-download" class="d-block card px-3 py-1"></div>
                    </div>

                    <div class="form-group">
                        <label for="release-date" class="mt-3">Date de parution</label>
                        <input type="date" class="form-control" id="release-date" name="release_date" placeholder="date">
                    </div>

                    <div class="form-group py-2 mt-4">
                          <label class="control-label col-sm-12 col-12" for="synopsis">Description  
                              <textarea class="form-control" rows="4" id="synopsis" name="synopsis"></textarea>
                          </label>
                    </div>

                    <div class="form-group">
                        <label for="author" class="mt-3">Auteur</label>
                        <input type="text" class="form-control" id="author" name="author" placeholder="dan brown">
                    </div>

                    <div class="input-group mt-5 mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="genre">Genres</label>
                      </div>
                      
                      <select class="custom-select w-50 border-info rounded" id="genre" name="genre">

                          <?php
                              for($i = 0; $i < count($genres); $i++) :
                          ?>

                              <option value="<?php echo $genres[$i]; ?>"><?php echo $genres[$i]; ?></option> 

                          <?php
                              endfor;
                          ?>

                      </select>
                    </div>

                    <input type="submit" class="d-block btn btn-secondary w-100 mx-auto mt-5 mb-1 py-3 px-5" name="submit_form_books" value="envoyer">
                </form>
            </div>
            
            <div class="col-md-8 mb-5 pb-5 position-relative"><h3 class="text-info my-0">Liste des utilisateurs</h3>
            
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
                        <th scope="col">Prenom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Enregistrement</th>
                        <th scope="col">Radiation</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Type</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php 
                        foreach ($users as $key => $user) : 
                      ?>

                        <tr class="row-user">
                          <td scope="row"><input class="d-inline-block form-check-input mx-auto selected-row" type="checkbox" name="selected-row" <?php if ($user['type_user'] === "administrateur") {echo "disabled";} ?>></td>
                          <th scope="row"><?php echo $user['id']; ?></th>
                          <td><?php echo $user['firstname']; ?></td>

                          <td><?php echo $user['lastname']; ?></td>
                          
                          <td><?php echo $user['registration_date']; ?></td>

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

                                    <option value="<?php echo $_statutUser[$i]; ?>"<?php if ($user['statut_user'] === $_statutUser[$i]) {echo "selected";} ?>><?php echo $_statutUser[$i]; ?></option>  
                                    
                                  <?php
                                      endfor;
                                    endif;
                                  ?>
                              </select>
                            </td>

                            <td>
                                <select class="py-1 px-2 border border-none rounded type-selected" name="type_selected">
                                  <?php
                                    if ($user['type_user'] === "administrateur") : 
                                  ?>

                                      <option value="<?php echo $user['type_user']; ?>"><?php echo $user['type_user']; ?></option> 

                                  <?php
                                  else :                               
                                      for ($i = 2; $i < count($_typeUser)+2; $i++) :
                                    ?>

                                      <option value="<?php echo $_typeUser[$i]; ?>"
                                        <?php
                                          $currentUser = $newUserManager->getUserById($user['id']);
                                            if (isset($_POST['update_by_admin'])) { 
                                                if ($currentUser[0]['type_user'] !== $_POST['type_injected']) {
                                                    $typeUser = $_POST['type_injected']; 
                                                    $newUserManager->updateTypeUser($userIdConnected, $toUserId, $typeUser);
                                                    if ($currentUser[0]['type_user'] === $_typeUser[$i] && $currentUser[0] === (int)$_POST['user_id']) {echo "selected";}
                                                }
                                            }
                                            if ($currentUser[0]['type_user'] === $_typeUser[$i]) {echo "selected";} 
                                        ?>>
                                      
                                      <?php echo $_typeUser[$i]; ?>
                                      </option>   
                                      
                                    <?php
                                      endfor;
                                    endif;
                                    ?>
                                </select>
                            </td>

                            <td class="cell-update">
                              <form method="post" name="form-update"><input type="hidden" class="type-injected" name="type_injected" value=""><input type="hidden" class="statut-injected" name="statut_injected" value=""><input type="hidden" class="update" name="user_id" value="<?php echo $user['id']; ?>"><label class="d-block block-update-by-admin"><input type="submit" name="update_by_admin" class="update-by-admin" value="" disabled></label></form>
                            </td>

                            <td class="cell-delete">
                              <form method="post" name="form-delete"><input type="hidden" name="get_id_user" value="<?php echo $user['id']; ?>"><input type="hidden" name="statut_injected" value="non actif"><label id="<?php if (isset($user['termination_date'])) {echo $user['id'];} ?>" class="d-block block-delete-by-admin"><input type="submit" name="delete_by_admin" class="delete-by-admin" value="" disabled></label></form>
                            </td>
                        </tr>

                        <?php
                          endforeach;
                        ?>

                    </tbody>
                  </table>
                </div>





                      <div class="d-block border-warning card p-3">
                        <h4 class="col-lg-10 col-12 mx-auto text-info my-2 pb-4 text-center">Ajouter un utilisateur</h4>

                        <form id="form_register" class="form-user-in-admin" action="../Controller/process_register.php" method="post" name="form_register">
                            <aside class="d-inline-block form-group pb-3">
                                <label for="firstname" class="d-inline-block">Prenom
                                    <input type="text" id="firstname" class="form-control" name="firstname" placeholder="maxense" />
                                </label>

                                <label for="lastname" class="d-inline-block">Nom
                                    <input type="text" id="lastname" class="form-control" name="lastname" placeholder="albert" />
                                </label>
                            </aside>

                            <aside class="form-group pb-3">
                                <label for="email" class="mr-3">Email
                                  <input type="email" id="email" class="form-control" name="email" placeholder="maxense@gmail.fr" />
                                </label>

                                <label for="date_of_birth" class="mr-3">Date de naissance
                                  <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" />
                                </label>

                                <label for="postal_code">Code postal
                                  <input type="text" id="postal_code" class="form-control" name="postal_code" placeholder="59600" />
                                </label>
                            </aside>

                            <aside class="form-group pb-3">
                                <label for="adress">Adresse</label>
                                <input type="text" id="adress" class="form-control" name="adress" placeholder="22, rue de l'espérance bloc Saturn" />
                            </aside>

                            <hr class="my-1" />

                            <aside class="d-flex flex-row justify-content-center align-items-center mb-1 py-3">
                                <div class="d-flex form-group col-md-5">
                                    <label for="pass_user" class="d-inline">Mot de passe
                                        <input type="password" id="pass_user" class="form-control" name="pass_user" />
                                    </label>
                                </div>

                                <div class="d-flex form-check form-check-inline">
                                    <label class="form-check-label" for="employe">employé
                                        <input class="form-check-input" type="radio" name="type_user" id="employe" value="employe">
                                    </label>
                                </div>
                                
                                <div class="d-flex form-check form-check-inline">
                                    <label class="form-check-label" for="abonne">abonné
                                        <input class="form-check-input" type="radio" name="type_user" id="abonne" value="user_subscriber">
                                    </label>
                                </div>
                            </aside>

                            <aside>
                                <input type="hidden" name="administrateur_id" value="<?php echo $_SESSION['userId']; ?>">
                                <input type="submit" class="d-block col-lg-4 col-12 m-auto btn btn-primary py-3 submit-register" name="submit" value="Envoyer">
                            </aside>
                        </form>
                      </div>
                        





              <div class="row gutters-sm mt-4">
                  <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                      <div class="card-body">
                        <h6 class="d-block mx-auto text-center mb-3 text-info">Statistiques globales</h6>

                        <li class="d-flex align-items-center small mb-1"><span class="d-flex small text-success mr-2">Nombre total d'utilisateurs inscrits :</span><?php //echo count($users); ?></li>

                        <span class="small">Utilisateurs <span class="text-success mr-3">Premium</span><?php //echo $usersPremium[0]['users_premium']; ?> / 50</span>
                        <div class="progress mb-2">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: <?php //echo ($usersPremium[0]['users_premium']*2); ?>%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="50"></div>
                        </div>

                        <div><h5 class="d-inline-block small mb-4 mr-2">Utilisateurs Freemium</h5><span class="small"><?php //echo count($users) - $usersPremium[0]['users_premium']; ?></span></div>

                        <li class="d-flex align-items-center small"><span class="d-flex small text-success mr-2">Nombre total de posts :</span><?php //echo $sumPosts[0]['all_posts']; ?></li>
                    
                        <li class="d-flex align-items-center small"><span class="d-flex small text-success mr-2">Nombre total de réponses :</span><?php //echo $sumResponses[0]['all_responses']; ?></li>

                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                      <div class="card-body">
                        <h6 class="d-block mx-auto text-center mb-3 text-info">Statistiques avancées</h6>

                        <div>
                          <span class="d-block small font-weight-bold mb-2">Nombre de posts par cms</span>
                          <ul class="d-flex flex-wrap flex-row justify-content-between align-items-center px-0">

                          <?php
                           // foreach ($postsOfAllCms as $key => $postsOfCms) :
                          ?>

                            <li class="d-flex align-items-center small"><span class="d-flex small text-success mr-2"><?php //echo $postsOfCms['cms_name'] ?></span><?php //echo $postsOfCms['count_posts'] ?></li>

                          <?php
                            //endforeach;
                          ?>

                          </ul>
                        </div>

                        <div>
                          <span class="d-block small font-weight-bold mb-2">Nombre de réponses par cms</span>
                          <ul class="d-flex flex-wrap flex-row justify-content-between align-items-center px-0">

                          <?php
                            //foreach ($responsesOfAllCms as $key => $responsesOfCms) :
                          ?>

                            <li class="d-flex align-items-center small"><span class="d-flex small text-success mr-2"><?php //echo $responsesOfCms['cms_name'] ?></span><?php //echo $responsesOfCms['count_responses'] ?></li>

                          <?php
                            //endforeach;
                          ?>

                          </ul>
                        </div>

                        <div>
                          <span class="d-block small font-weight-bold mb-2">Utilisateurs par cms</span>
                          <ul class="d-flex flex-wrap flex-row justify-content-between align-items-center px-0">

                          <?php
                            //foreach ($cmsByUsers as $key => $cmsByUser) :
                          ?>

                            <li class="d-flex align-items-center small"><span class="d-flex small text-success mr-2"><?php //echo $cmsByUser['cms_name'] ?></span><?php //echo $cmsByUser['count_users'] ?></li>

                          <?php
                            //endforeach;
                          ?>

                          </ul>
                        </div>

                      </div>
                    </div>
                  </div>
              </div>

            </div>
          </div>

        </div>
    </div> 
