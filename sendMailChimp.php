<?php
include('MailChimp.php');

use \DrewM\MailChimp\MailChimp;
$MailChimp = new MailChimp('cdb7835ad1b2ab1057d8b06de4f198ea-us17');
$list_id = 'a3c63b8ef9';

$correo   = $_REQUEST['email'] ? $_REQUEST['email'] : 'castillo8811@gmail.com';

$result = $MailChimp->post("lists/$list_id/members", [
    'email_address' => $correo,
    'status'        => 'subscribed',
]);

if ($MailChimp->success()) {
    $respond = array(
        'respond' => TRUE,
        'text'    => 'Your info was sent'
    );
} else {
    $respond= array(
        'respond'=>false,
        'text'=>$MailChimp->getLastError()
    );
}

print json_encode($respond);
