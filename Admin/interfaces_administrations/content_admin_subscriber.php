<?php

require_once("../Config/config.php");
$dbName = new \PDO(DSN , DB_USER, DB_PASS);
    
	require_once("../Model/Dbconnect.php");
	require_once("../Model/Usermanager.php");
	require_once("../Model/Bookmanager.php");

	$dbConnect = new media_library\Dbconnect($dbName);
	$newUserManager = new media_library\Usermanager($dbName);
	$newBookManager = new media_library\Bookmanager($dbName);

	$users = $newUserManager->getUsers(); 
	$user = $newUserManager->getUserById($_SESSION['userId']);

	$userId = (int)$_SESSION['userId'];
	$getBooksRentedByUser = $newBookManager->getBooksRentedByUser($userId); 
	$getCountBooksByUser = $newBookManager->getCountBooksByUser($userId);  

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
								<p class="text-dark small mb-1"><span class="text-muted">Date de naissance : </span><span><?php echo $dbConnect->dateToFrench($user[0]['date_of_birth'], 'l, d F Y'); ?></span></p>
							</aside>
						</div>
					</div>
					</div>

					<div class="d-block mt-5 card">
						<div class="card-body">
							<h6 class="d-block mx-auto text-center mb-3 text-info">Statistiques</h6>
							<div>
							<span class="d-block small font-weight-bold mb-2">Nombre de livres emprunté</span>
							<ul class="d-flex flex-wrap flex-row justify-content-between align-items-center px-0">
								<li class="d-flex align-items-center small"><span class="d-flex small text-success mr-2"><?php echo $getCountBooksByUser[0]['count_books']; ?></li>
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
								<th scope="col">ID</th>
								<th scope="col">titre</th>
								<th scope="col">reserver le</th>
								<th scope="col">genre</th>
								<th scope="col">auteur</th>
								<th scope="col">jour -</th>
								<th scope="col"></th>
							</tr>
							</thead>

							<tbody>
								<?php
									foreach ($getBooksRentedByUser as $key => $book) : 
								?>

									<tr class="row-user">
									<th scope="row"><?php echo $book['id']; ?></th>
									<td><?php echo $book['book_title']; ?></td>                      
									<td><?php echo $dbConnect->dateToFrench($book['rental_start'], 'l d F Y'); ?></td>
									<td><?php echo $book['genre']; ?></td>
									<td><?php echo $book['author']; ?></td>
									<td><?php echo ""; ?>3</td>
									</tr>

								<?php
									endforeach;
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
								<th scope="col">ID</th>
								<th scope="col">titre</th>
								<th scope="col">reserver le</th>
								<th scope="col">genre</th>
								<th scope="col">jour -</th>
								<th scope="col"></th>
							</tr>
							</thead>

							<tbody>
								<?php
									foreach ($getBooksRentedByUser as $key => $book) : 
								?>

									<tr class="row-user">
									<th scope="row"><?php echo $book['id']; ?></th>
									<td><?php echo $book['book_title']; ?></td>                      
									<td><?php echo $dbConnect->dateToFrench($book['rental_start'], 'l d F Y'); ?></td>
									<td><?php echo $book['genre']; ?></td>
									<?php echo $book['author']; ?>
									<td><?php echo ""; ?>3</td>
									</tr>

								<?php
									endforeach;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> 



					





