<?php

require 'src/mailer.php';
require 'src/bd.php';



?>

<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8"> 
 <title> Reg</title>
<link href="css/style.css" media="screen" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
	</head>
	<body>
<div class="container mregister">
<div id="login">
 <h1>Регистрация</h1>
<form action="register.php" id="registerform" method="post" name="registerform">
<p><label for="email">E-mail<br>
<input class="input" id="email" name="email" size="32"type="email" value=""></label></p>
<p><label for="username">Имя пользователя<br>
<input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
<p><label for="password">Пароль<br>
<input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
	  <p class="regtext">Уже зарегистрированы? <a href= "login.php">Введите имя пользователя</a>!</p>
 </form>
</div>
</div>
<footer>
 </footer>
 <?php
 

	
if(isset($_POST["register"]))
{
	
    if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) 
    {
        $email=$_POST['email'];
        $username=$_POST['username'];
        $for_user_password=$_POST['password'];
        
        $password = crypt($_POST['password'], $email);
        $query=mysql_query("SELECT * FROM users WHERE login='$username'");
        $numrows=mysql_num_rows($query);
        
        
        if($numrows==0)
        {
            $sql="INSERT INTO users
            (email, login, password)
            VALUES('$email', '$username', '$password')";
            $result=mysql_query($sql);
            
            echo "Account is successfully created!";
            
            gmail_send($email, $username, $for_user_password);
        } else 
        {
            echo "Login zanyat.";
        }
    }
}
?>
</body>
</html>