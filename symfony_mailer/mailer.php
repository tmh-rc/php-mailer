<?php

use Twig\Environment;
use Symfony\Component\Mime\Email;
use Twig\Loader\FilesystemLoader;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(app_path());
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $to = $_POST['to'] ?? '';
    $subject = $_POST['subject'] ?? '';

    $transport = Transport::fromDsn('gmail+smtp://scm.thetminnhtun@gmail.com:dneicrmrjaizrknq@default');
    $mailer = new Mailer($transport);

    // $email = (new Email())
    //     ->from($_ENV['MAIL_FROM_ADDRESS'])
    //     ->to(new Address($to, $name))
    //     //->cc('cc@example.com')
    //     //->bcc('bcc@example.com')
    //     //->replyTo('fabien@example.com')
    //     //->priority(Email::PRIORITY_HIGH)
    //     ->subject($subject)
    //     // ->text('Sending emails is fun again!');
    //     ->html(fopen('template.html.twig', 'r'));

    $email = (new TemplatedEmail())
        ->from($_ENV['MAIL_FROM_ADDRESS'])
        ->to(new Address($to, $name))
        ->subject($subject)
        // path of the Twig template to render
        ->htmlTemplate('template.html.twig')
        // pass variables (name => value) to the template
        ->context([
            'name' => $name,
            'mail_address' => $to,
        ]);

        // Setup template path
        $loader = new FilesystemLoader(app_path('symfony_mailer/'));
        $twigEnv = new Environment($loader);
        $twigBodyRenderer = new BodyRenderer($twigEnv);
        $twigBodyRenderer->render($email);

    try {
        
        $mailer->send($email);
        $message = 'Message has been sent';
    } catch (TransportExceptionInterface $e) {
        $message = "Message could not be sent. Mailer Error: {$mail->getMessage()}";
    }
}
