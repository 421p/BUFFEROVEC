<?php

require 'src/mailer.php';
require 'src/bd.php';



$qr = mysql_query("SELECT * FROM secret");

$SECRET_KEY = mysql_result($qr,0);


//===================LOGIN?============================

$login = $_GET['login'];
$oldpassword = base64_decode($_GET['password']);

if(!empty($_GET['login']) && !empty($_GET['password']))
{
    $query = "SELECT email FROM `users` WHERE login='$login'";
    $result = mysql_query($query) or die(mysql_error());
    $khm = mysql_result($result, 0);
    
    $password = crypt($oldpassword, $khm);
    
    $query = "SELECT email FROM `users` WHERE login='$login' and password='$password'";
    
    $result = mysql_query($query) or die(mysql_error());
    
    $count = mysql_num_rows($result);
    
    if($count == 1)
    {
    echo md5($SECRET_KEY);
    
    //gmail_send($email, $login, $oldpassword);

}
else
{
    echo "DENIED";
}
} else {
    echo "DENIED";
}

?>

