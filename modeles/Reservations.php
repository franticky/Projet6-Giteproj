<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require_once "modeles/gites.php";


class Reservations extends  Gites {

    function reservationGite(){


//Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username = '6303f057d2203d';                     //SMTP username
            $mail->Password = '6ef985f8e00460';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 2525;                                    //TCP port to connect to mailtrap: 2525; but use 587 or 465 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->setLanguage('fr', '../vendor/phpmailer/phpmailer/language/');
                $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            $detailsGite = $this->getGiteByID();
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'test subject';
            $mail->Body    = '<b>contenu du mail
            <p>'.$detailsGite['nom_gite'].'</p>
            </b>';
            $mail->AltBody = 'copie si doesnt work';

            $mail->send();
            echo 'Message sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}