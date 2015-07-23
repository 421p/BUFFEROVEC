<!DOCTYPE html>
	<html lang="en">
	<head>
	    
<?php
    require 'src/mailer.php';
    require 'src/bd.php';
    
?>

<?php session_start(); ?>

<?php

if(isset($_SESSION["user_going_crazy"]))
{

header("Location: intro.php");
}

if(isset($_POST["login"])){
    
    if(!empty($_POST['username']) && !empty($_POST['password'])) 
    {
        
        $username=$_POST['username'];
        
        $query = "SELECT email FROM `users` WHERE login='$username'";
        $result = mysql_query($query) or die(mysql_error());
        $khm = mysql_result($result, 0);
        
        $password=crypt($_POST['password'], $khm);
        $query = mysql_query("SELECT * FROM users WHERE login='$username' AND password='$password'");
        $numrows=mysql_num_rows($query);
        
        if($numrows!=0)
        {
            while($row=mysql_fetch_assoc($query))
            {
            	$dbusername=$row['login'];
                $dbpassword=$row['password'];
            }
            
            if($username == $dbusername && $password == $dbpassword)
            {
            	 $_SESSION['user_going_crazy']=$username;	 
                /* Перенаправление браузера */
               header("Location: intro.php");
            }
        } else {
        	$message = "Invalid username or password!";
        	
        	echo  "Invalid username or password!";
         }
        	} else {
            $message = "All fields are required!";
    }
}
?>

<meta charset="utf-8">
<title> Login </title>
<link href="css/style.css" media="screen" rel="stylesheet">
<link href= 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head> 
<body>
<div class="container mlogin">
    <div id="login">
        <h1>Вход</h1>
        <form action="" id="loginform" method="post"name="loginform">
            <p><label for="username">Имя опльзователя<br>
                <input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
            <p><label for="password">Пароль<br>
                <input class="input" id="password" name="password"size="20" type="password" value=""></label></p> 
            <p class="submit"><input class="button" name="login"type= "submit" value="Log In"></p>
            <p class="regtext">Еще не зарегистрированы?<a href= "register.php">Регистрация</a>!</p>
        </form>
        </div>
</div>
<footer>
</footer>



</body>
</html>