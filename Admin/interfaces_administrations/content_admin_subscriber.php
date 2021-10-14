<?php

require_once("../Config/config.php");
$dbName = new \PDO(DSN , DB_USER, DB_PASS);
    
  require_once("../Model/Dbconnect.php");
  require_once("../Model/Usermanager.php");

  $newUserManager = new media_library\Usermanager($dbName);

  $users = $newUserManager->getUsers(); 
  $user = $newUserManager->getUserById($_SESSION['userId']);

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
          <nav aria-label="breadcrumb" class="main-breadcrumb mb-0 bg-info px-3 rounded">
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
                            <h5><span class="d-inline-block mx-3"><?php echo $user[0]['firstname']; ?></span><span class="d-inline-block"><?php echo $user[0]['lastname']; ?></span></h5>
                            <p class="text-dark mb-1"><span class="text-muted small mr-2">role :</span><?php echo $user[0]['type_user']; ?></p>
                        </div>
                        
                        <aside class="d-flex flex-inline justify-content-evenly align-items-center flex-wrap my-3">
                            <a href="#"><span class="d-flex text-secondary">github</span></a>
                            <p class="mb-0"><a href="#"><picture class="d-flex mr-3 icon-inline"><img src="<?php echo SVG.'/github.svg' ?>" alt="admin" width="35px"></picture></a></p>
                        </aside>

                        <aside class="d-flex flex-column justify-content-evenly align-items-evenly">
                            <p class="text-dark small"><span class="text-muted">Email : </span><span><?php echo $user[0]['email_user']; ?></span></p>
                            <p class="text-dark small mb-1"><span class="text-muted">Date de naissance : </span><span><?php echo $user[0]['date_of_birth']; ?></span></p>
                        </aside>

                    </div>
                  </div>
                </div>




                    <div class="d-block mt-5 card">
                      <div class="card-body">
                        <h6 class="d-block mx-auto text-center mb-3 text-info">Statistiques</h6>

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
            

			
            <div class="col-md-8 py-3 position-relative">
            

            <div class="col-md-12 py-3 position-relative"><h3 class="text-info my-0">Livres en attente de reception</h3>
            
            <div class="d-flex justify-content-between text-success text-left">
              <div class="d-flex text-success"><span class="position-relative">⬌</span></div>
              <div class="d-flex text-success"><span class="position-relative">⬍</span></div>
            </div>

            <div class="card mb-5 table-users">
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





            <div class="col-md-12 py-3 position-relative"><h3 class="text-info my-0">Livres en attente de retour</h3>
            
            <div class="d-flex justify-content-between text-success text-left">
              <div class="d-flex text-success"><span class="position-relative">⬌</span></div>
              <div class="d-flex text-success"><span class="position-relative">⬍</span></div>
            </div>

            <div class="card mb-5 table-users">
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


			<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<h5 class="d-flex align-items-center mb-3">Project Status</h5>
									<p>Web Design</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Website Markup</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>One Page</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Mobile Template</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Backend API</p>
									<div class="progress" style="height: 5px">
										<div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

                  
              </div>

            </div>
          </div>

        </div>
    </div> 



					





