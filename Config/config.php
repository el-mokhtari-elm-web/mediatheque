<?php

define ("ACCUEIL", "/media-library");
define ("A_PROPOS", "/media-library/View/a_propos_page.php");
define ("CONTACT", "/media-library/View/contact_page.php");
define ("COVID", "/media-library/View/covid_page.php");

define ("BOOKING", "/media-library/View/library_page.php");
define ("BOOK_PAGE", "/media-library/View/book_page.php");

define ("LOGIN", "/media-library/View/login_page.php");
define ("REGISTER", "/media-library/View/register_page.php");

define ("RGPD", "/media-library/View/rgpd_page.php");
define ("RGPD_FORM", "/media-library/View/rgpd_form.php");

define ("ADMIN", "/media-library/Admin/admin.php");

define ("BOOTSTRAP", "/media-library/node_modules/bootstrap/dist/css/bootstrap.min.css");
define ("STYLES_GLOBAL", "/media-library/css/styles-global.css");


define ("INDEX_JS", "/media-library/index.js");
define ("LIBRARY_JS", "/media-library/js/library.js");
define ("LOGIN_JS", "/media-library/js/loginpage.js");
define ("REGISTER_JS", "/media-library/js/registerpage.js");
define ("ADMIN_JS", "/media-library/js/admin.js");
define ("BOOKING_JS", "/media-library/js/booking.js");
define ("JQUERY", "/media-library/node_modules/jquery/dist/jquery.min.js");
define ("BOOTSTRAP_JS", "/media-library/node_modules/bootstrap/dist/js/bootstrap.min.js");
define ("BOOTSTRAP_MODAL", "/media-library/node_modules/bootstrap/js/dist/modal.js");


define ("SVG", "/media-library/assets/svg");
define ("PNG", "/media-library/assets/png");
define ("COVER_PAGES", "/media-library/cover_pages_lib/");
define ("IMG_PATH", $_SERVER['DOCUMENT_ROOT']);



//////////////// *******CONNEXION DATABASE********* //////////////// 
////////////////////////////////////////////////////////////////////

/* 

DO start your SERVER mysql and after starting your SERVER mysql enter this command :

sudo mysql -u elmokhtari -p      
the password of bdd is :            #*Yousss77*#

AFTER this command enter this command :

USE media_library; 

*/

// Infos to connect in database named :           media_library

// dbname = media_library
// user = elmokhtari
// password = #*Yousss77*#

define("DSN", 'mysql:host=127.0.0.1; dbname=media_library');
define("DB_USER", "elmokhtari");
define("DB_PASS", "#*Yousss77*#");

////////////////////////////////////////////////////////////////////
//////////////// *******CONNEXION DATABASE********* ////////////////