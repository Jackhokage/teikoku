<?php
/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Definir constante para la dirección de correo electrónico de recepción
define('RECEIVING_EMAIL_ADDRESS', 'cmd.newteikoku@gmail.com');

// Validación de datos
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

require_once '../assets/vendor/php-email-form/php-email-form.php';

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = RECEIVING_EMAIL_ADDRESS;
$contact->from_name = $name;
$contact->from_email = $email;
$contact->subject = $subject;

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
    'host' => 'cmd.newteikoku@gmail.com',
    'username' => 'new Teikoku',
    'password' => 'comunidadnt2000',
    'port' => '587'
);
*/

$contact->add_message($name, 'From');
$contact->add_message($email, 'Email');
$contact->add_message($message, 'Message', 10);

try {
    echo $contact->send();
} catch (Exception $e) {
    echo 'Error al enviar el correo electrónico: ' . $e->getMessage();
}
?>
