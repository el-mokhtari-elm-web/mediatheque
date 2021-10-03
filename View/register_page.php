<?php

session_start();

  require_once("../Config/config.php");
  require_once("header_page.php");
  require_once("../Controller/process_logout.php");
?>

    <body class="d-flex column justify-content-center pt-1 align-items-center bg-section-register">
        <section class="d-flex column justify-content-center align-items-center section-register">
            <aside class="container w-75 pt-1 pb-2 px-5 rounded register">
              <h4 class="col-lg-10 col-12 mx-auto mt-1 pb-3 text-center">Fiche d'inscription</h4>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6 pb-3">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" id="firstname" class="form-control" placeholder="Brown" />
                                </div>
                                <div class="form-group col-md-6 pb-3">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" id="lastname" class="form-control" placeholder="Asher" />
                                </div>
                            </div>
                            <div class="form-group pb-3">
                                <label for="inputEmail4" class="mr-3">Email
                                  <input type="email" class="form-control" id="inputEmail4" placeholder="brown@asher.me" />
                                </label>

                                <label for="inputZip5" class="mr-3">Date de naissance
                                  <input type="date" class="form-control" id="inputZip5" placeholder="98232" />
                                </label>

                                <label for="inputZip5">Code postal
                                  <input type="text" class="form-control" id="inputZip5" placeholder="98232" />
                                </label>

                            </div>
                            <div class="form-group pb-3">
                                <label for="inputAddress5">Address</label>
                                <input type="text" class="form-control" id="inputAddress5" placeholder="P.O. Box 464, 5975 Eget Avenue" />
                            </div>
                            <hr class="my-1" />
                            <div class="row mb-4 pb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword4">Old Password</label>
                                        <input type="password" class="form-control" id="inputPassword5" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword5">New Password</label>
                                        <input type="password" class="form-control" id="inputPassword5" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword6">Confirm Password</label>
                                        <input type="password" class="form-control" id="inputPassword6" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">Password requirements</p>
                                    <p class="small text-muted mb-2">To create a new password, you have to meet all of the following requirements:</p>
                                    <ul class="small text-muted pl-4 mb-0">
                                        <li>Minimum 8 character</li>
                                        <li>At least one special character</li>
                                        <li>At least one number</li>
                                        <li>Can’t be the same as a previous password</li>
                                    </ul>
                                </div>
                            </div>
                            <aside>
                                <input type="submit" class="d-block col-lg-4 col-12 m-auto btn btn-primary py-3" value="Envoyer">
                                <span class="d-block col-lg-4 col-12 my-2 mx-auto text-center">Vous avez un compte ? <a href="<?php echo LOGIN; ?>" class="ml-3">Par ici</a></span> 
                            </aside>
                        </form>
                        
                    </aside>
            </section>
    </body>

</html>