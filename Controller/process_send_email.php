<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../vendor/phpmailer/phpmailer/src/Exception.php');
require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once('../vendor/phpmailer/phpmailer/src/SMTP.php');

$mail = new PHPMailer(true);

if (isset($_POST['submit-email'])) {

    $msg_success = "";
    $success = true;

    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['sujet']) || empty($_POST['message'])) {
        $msg_succes = "Tout les champs sont obligatoires";
        return;

    }   else {

            try {
                //********Server settings*********//

                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                //Enable verbose debug output
                $mail->isSMTP();                                        //Send using SMTP
                $mail->Host = "smtp.gmail.com";                         //Set the SMTP server to send through
                $mail->SMTPAuth = "true";                               //Enable SMTP authentication
                $mail->Username = 'contact.elmweb@gmail.com';           //SMTP username
                $mail->Password = '#*Yousss77*#';                       //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
                $mail->Port = 465;                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //**********Recipients************//

                $mail->addAddress($mail->Username);                     //Add a recipient
                //$mail->addAddress('ellen@example.com');               //Name is optional
                $mail->addReplyTo($mail->Username);
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //**********Attachments***********//

                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //***********Content**************//

                $mail->isHTML(false);   
                
                $mail->setFrom(trim($_POST['email']));                  //Set email format to HTML
                $mail->Subject = trim($_POST['sujet']);
                $mail->Body = trim($_POST['message']);
                $mail->AltBody = trim($_POST['message']); 
                $mail->send();

                $msg_success = "Votre message à bien été reçu";

            }   catch (Exception $e) {
                    $msg_success = "Une erreur est survenu, echec de l'envoi";
                    $success = false;
                    return $success;
                }

        }
}


                      
