<?php

require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';


function gmail_send($to_mail, $to_nick, $pass)
{
$text = 
'<html>' .
' <head></head>' .
' <body>' .
'  Dear <b>' .$to_nick. '</b>, your account has been registered!' . '<br>' .
'  <b>login: </b>' . $to_nick . '<br>' .
'<b>password: </b>'. $pass . '<br>' .
' </body>' .
'</html>';

    
$transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com')
    ->setPort(587)
    ->setEncryption('tls')
    ->setUsername('')
    ->setPassword('');

$mailer = Swift_Mailer::newInstance($transporter);

$message = Swift_Message::newInstance('Registration succeed!')
  ->setFrom(array('noreply@veryveryesy.es' => 'Alan Shebanov'))
  ->setTo(array($to_mail => $to_nick))
  ->setBody($text, 'text/html');

$mailer->send($message);
}