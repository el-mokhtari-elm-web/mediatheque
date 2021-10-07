<?php
$typeUsers = [['type_user' => 'administrateur', 'level_right' => 1], ['type_user' => 'editeur', 'level_right' => 2], ['type_user' => 'user_subscriber', 'level_right' => 3]];

$update =   '<picture>
              <svg height="23px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" class="update-admin">
                <g transform="matrix(0.607143,0,0,0.607143,0.785712,0.785712)">
                    <g id="spin">
                        <g>
                          <path d="M25.883,6.086L23.063,8.918C24.953,10.809 26,13.324 26,16C26,21.516 21.516,26 16,26L16,24L12,28L16,32L16,30C23.719,30 30,23.719 30,16C30,12.254 28.539,8.734 25.883,6.086Z"/>
                          <path d="M20,4L16,0L16,2C8.281,2 2,8.281 2,16C2,19.746 3.461,23.266 6.117,25.914L8.937,23.082C7.047,21.191 6,18.676 6,16C6,10.484 10.484,6 16,6L16,8L20,4Z"/>
                        </g>
                    </g>
                </g>
              </svg>
            </picture>';

$delete =   '<picture>
              <svg height="23px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" class="delete-admin">
                  <g transform="matrix(0.0371094,0,0,0.0371094,-199.781,-246)">
                      <g transform="matrix(1,0,0,1,5397.05,6642.53)">
                        <path d="M424,64L336,64L336,48C336,21.533 314.467,0 288,0L224,0C197.533,0 176,21.533 176,48L176,64L88,64C65.944,64 48,81.944 48,104L48,160C48,168.836 55.164,176 64,176L72.744,176L86.567,466.283C87.788,491.919 108.848,512 134.512,512L377.488,512C403.153,512 424.213,491.919 425.433,466.283L439.256,176L448,176C456.836,176 464,168.836 464,160L464,104C464,81.944 446.056,64 424,64ZM208,48C208,39.178 215.178,32 224,32L288,32C296.822,32 304,39.178 304,48L304,64L208,64L208,48ZM80,104C80,99.589 83.589,96 88,96L424,96C428.411,96 432,99.589 432,104L432,144L80,144L80,104ZM393.469,464.761C393.062,473.306 386.042,480 377.488,480L134.512,480C125.957,480 118.937,473.306 118.531,464.761L104.78,176L407.22,176L393.469,464.761Z" style="fill-rule:nonzero;"/>
                      </g>
                      <g transform="matrix(1,0,0,1,5397.05,6636.63)">
                        <path d="M256,448C264.836,448 272,440.836 272,432L272,224C272,215.164 264.836,208 256,208C247.164,208 240,215.164 240,224L240,432C240,440.836 247.163,448 256,448Z" style="fill-rule:nonzero;"/>
                      </g>
                      <g transform="matrix(1,0,0,1,5397.89,6636.63)">
                        <path d="M336,448C344.836,448 352,440.836 352,432L352,224C352,215.164 344.836,208 336,208C327.164,208 320,215.164 320,224L320,432C320,440.836 327.163,448 336,448Z" style="fill-rule:nonzero;"/>
                      </g>
                      <g transform="matrix(1,0,0,1,5396.21,6636.63)">
                        <path d="M176,448C184.836,448 192,440.836 192,432L192,224C192,215.164 184.836,208 176,208C167.164,208 160,215.164 160,224L160,432C160,440.836 167.163,448 176,448Z" style="fill-rule:nonzero;"/>
                      </g>
                  </g>
              </svg>
            </picture>';

require_once("../Config/config.php");
$dbName = new \PDO(DSN , DB_USER, DB_PASS);
    
  require_once("../model/Dbconnect.php");
  require_once("../model/Usermanager.php");

  $newUserManager = new media_library\Usermanager($dbName);

  //$users = $newUserManager->getUsers(); 
  //$user = $newUserManager->getUserById($_SESSION['userId']);

  /*if (isset($_POST['update_admin'])) {
    $newUserManager->updateStatutUser((int)$_POST['user_id'], (int)$typeUsers[1]['level_right'], $_POST['get_type_user']);
    $users = $newUserManager->getUsers();
  } else if (isset($_POST['delete_admin'])) {
    $newUserManager->deleteUser((int)$_POST['get_id_user']);
    $users = $newUserManager->getUsers();
    $cmsByUsers = $newUserManager->getCmsByUsers();
    $usersPremium = $newUserManager->getUsersPremium();
  }*/

?>                       

<div class="container">
    <div class="main-body">

          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb mb-3 bg-info px-3 rounded">
            <ol class="breadcrumb menu-admin">
              <li class="breadcrumb-item"><h5 class="font-weight-bold p-0 m-0 accueil-admin">Bienvenue sur Votre espace d'administration</h5></li>
              <li class="logout"><form name="logout" method="post"><input type="hidden" name="hidden"><input type="submit" name="logout" value="Déconnexion"></form></li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            
            <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-evenly justify-content-evenly text-center">

                        <picture><img src="<?php echo SVG.'/user.svg' ?>" alt="admin" width="100px"></picture>

                        <div class="mt-3">
                            <h5><span class="d-inline-block mr-3">youssef</span><span class="d-inline-block">el mokhtari</span></h5>
                            <p class="text-dark mb-1"><span class="text-muted small mr-2">role :</span>administrateur</p>
                        </div>
                        
                        <aside class="d-flex justify-content-evenly align-items-evenly flex-wrap my-3">
                            <a href="#"><span class="d-flex text-secondary">github</span></a>
                            <p class="mb-0"><a href="#"><picture class="d-flex mr-3 icon-inline"><img src="<?php echo SVG.'/github.svg' ?>" alt="admin" width="35px"></picture></a></p>
                        </aside>

                        <aside class="d-flex flex-column justify-content-evenly align-items-evenly">
                            <p class="text-dark small mr-1">Email : <span>josyasssin@gmail.com</span></p>
                            <p class="text-dark small mb-1">Inscription le : <span>19 nov 2020</span></p>
                        </aside>

                    </div>
                  </div>
                </div>

                <form class="d-block card my-3 px-3 pt-3 pb-4" method="post" name="form-tutos" enctype="multipart/form-data">
                    <h3 class="text-info">Ajouter un livre</h3>

                    <div class="form-group">
                        <label for="title_book">Titre</label>
                        <input type="text" class="form-control" id="title_book" placeholder="titre">
                    </div>

                    <div class="form-group">
                        <label for="author_book">Auteur</label>
                        <input type="text" class="form-control" id="author_book" placeholder="auteur">
                    </div>

                    <div class="custom-file mt-2">
                        <label class="custom-file-label" for="img-book">Choisir une illustration
                            <input type="file" id="img-book" class="custom-file-input my-1" name="img_books[]" value="tutos" multiple="multiple">
                        </label>
                    </div>

                    <input type="submit" class="d-block btn btn-secondary w-100 mx-auto mt-5 mb-1 py-3 px-5" name="submit" value="envoyer">
                </form>

                <div id="infos-download" class="d-block card my-3 px-3 pt-3 pb-4"></div>
            </div>
            
            <div class="col-md-8 py-3 position-relative"><h3 class="text-info my-0">Liste des utilisateurs</h3>
            
                <div class="d-flex justify-content-between text-success text-left">
                  <div class="d-flex text-success"><span class="position-relative">⬌</span></div>
                  <div class="d-flex text-success"><span class="position-relative">⬍</span></div>
                </div>

                <div class="card table-users">
                  <table id="table-users" class="table small">
                    <thead>
                      <tr>
                        <th scope="col"></th>                        
                        <th scope="col">ID</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Premium</th>
                        <th scope="col">Editions</th>
                        <th scope="col">Posts</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php
                      /*foreach ($users as $key => $user) : 
                            $postsForEachUser = $newPostManager->getNbrPostsForEachUser($user['id']);*/
                      ?>

                        <tr class="row-user">
                          <td scope="row"><input class="d-inline-block form-check-input mx-auto selected-row" type="checkbox" name="selected-row" <?php //if ($user['type_user'] == $typeUsers[0]['type_user']) {echo "disabled";} ?>></td>
                          <th scope="row"><?php //echo $user['id']; ?></th>
                          <td><?php //echo $user['lastname']; ?></td>

                          <td><img src="<?php /* if ((int)$user['cms_premium'] === 0) {echo SVG.'/not-ok.svg';} else {echo SVG.'/ok.svg';} */ ?>" height="13px"></td>
                          
                          <td><?php /*echo $user[''];*/ ?>0</td>
                          <td><?php //echo $postsForEachUser[0]['count_posts']; ?></td>
                          <td>
                              <select class="py-1 px-2 border border-none rounded" name="types_users">
                                  <?php                                
                                    //if ($user['type_user'] === $typeUsers[0]['type_user']) :
                                  ?>

                                    <option value="<?php /*echo $typeUsers[0]['type_user']; ?>" <?php if (in_array($user['type_user'], $typeUsers[0])) {echo "selected";} if ($user['type_user'] === $typeUsers[0]['type_user']) {echo "disabled";} ?>><?php echo $typeUsers[0]['type_user'];*/ ?>"></option>  

                                  <?php
                                    //else :
                                        //for ($i = 1; $i < count($typeUsers); $i++) :
                                  ?>

                                    <option value="<?php /*echo $typeUsers[$i]['type_user']; ?>" <?php if (in_array($user['type_user'], $typeUsers[$i])) {echo "selected";} if ($user['type_user'] === $typeUsers[0]['type_user']) {echo "disabled";} ?>><?php echo $typeUsers[$i]['type_user'];*/ ?>"></option>  
                                    
                                  <?php
                                        /*endfor;
                                      endif;
                                    if ($user['type_user'] !== $typeUsers[0]['type_user']) :*/
                                  ?>
                              </select></td>
                          <td>
                            <form method="post" name="form-update"><input type="hidden" name="get_type_user" value="<?php /*echo $user['type_user']; ?>"><input type="hidden" class="update" id="user" name="user_id" value="<?php echo $user['id'];*/ ?>"><label class="d-block block-update-admin"><input type="submit" name="update_admin" class="update-admin" value="" disabled></label></form>
                          </td>
                          <td>
                            <form method="post" name="form-delete"><input type="hidden" name="get_id_user" value="<?php /*echo $user['id']; ?>"><input type="hidden" class="delete" id="user" name="lastname" value="<?php echo $user['lastname'];*/ ?>"><label class="d-block block-delete-admin"><input type="submit" name="delete_admin" class="delete-admin" value="" disabled></label></form>
                          </td>
                        </tr>

                        <?php
                                   // endif;
                          //endforeach;
                        ?>

                    </tbody>
                  </table>
                </div>

                <div class="d-flex justify-content-between text-success text-left">
                  <div class="d-flex text-success"><span class="position-relative">⬌</span></div>
                  <div class="d-flex text-success"><span class="position-relative">⬍</span></div>
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
