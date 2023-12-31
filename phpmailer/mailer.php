<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(app_path());
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    $name = $_POST['name'] ?? '';
    $to = $_POST['to'] ?? '';
    $subject = $_POST['subject'] ?? '';

    ob_start();
    include 'template.php';
    $body = ob_get_clean();
    $body = nl2br($body);

    if (empty($to) || empty($subject) || empty($body)) {
        $message = 'To address, subject, body fields are required.';
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = $_ENV['MAIL_HOST']; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = $_ENV['MAIL_FROM_ADDRESS']; //SMTP username
        $mail->Password = $_ENV['MAIL_PASSWORD']; //SMTP password (if gmail, use app password)
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION']; //Enable implicit TLS encryption
        $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_USERNAME']);
        $mail->addAddress($to, $name); //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $message = 'Message has been sent';
    } catch (Exception $e) {
        $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}