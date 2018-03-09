<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/05/15
 * Time: 08:35 PM
 */

require_once 'swiftmailer/lib/swift_required.php';

$nombre   = $_REQUEST['nombre'] ? $_REQUEST['nombre'] : NULL;
$telefono = $_REQUEST['telefono'] ? $_REQUEST['telefono'] : NULL;
$correo   = $_REQUEST['email'] ? $_REQUEST['email'] : NULL;
$asunto        = $_REQUEST['asunto'] ? $_REQUEST['type'] : NULL;
$mensaje = $_REQUEST['mensaje'] ? $_REQUEST['mensaje'] : NULL;

$to = array('castillo8811@gmail.com');
$to[]=$correo;

$subject = 'Contact from Barron London Site. - ' . $asunto;
$body    = 'Barron Longo: <br /><br />';
$body .= '<strong>Name:</strong>' . $nombre .'<br /><br />';
$body .= '<strong>Phone:</strong>' . $telefono. '<br /><br />';
$body .= '<strong>Email:</strong>' . $correo . '<br /><br />';
$body .= '<strong>Message:</strong>' . $mensaje. '<br /><br />';

// Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
    ->setUsername('info@barronlondon.com')
    ->setPassword('Violetta2017*')
;

// Create the Mailer using your created Transport
$mailer  = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance($subject)
    ->setFrom(array('info@barronlondon.com' => 'Info Barron London'))
    ->setTo($to)
    ->setContentType('text/html')
    ->setBody($body);
// Send the message
$result = $mailer->send($message);
$result = TRUE;

if ($result) {
    $respond = array(
        'respond' => TRUE,
        'text'    => 'Your info was sent'
    );
    //Save data
    print json_encode($respond);
} else {
    $respond = array(
        'respond' => FALSE,
        'text'    => 'Ha ocurrido un error al enviar el mail, recargue la p&aacute;gina e intente de nuevo por favor.'
    );
    print json_encode($respond);
}
