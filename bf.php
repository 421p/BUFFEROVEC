<?php

//$value = (string)$_GET['value'];
$lk = (string)$_GET['lk'];
$login = (string)$_GET['login'];
$for_log = (string)$_GET['loginfo'];

require 'src/bd.php';


$qr = mysql_query("SELECT * FROM secret");

$SECRET_KEY = mysql_result($qr,0);

$cur_time = date("H:i:s");

$em = md5($SECRET_KEY);
$in_buffer = (float)file_get_contents('value.jk');

function getRandomWord($len = 10) {
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

if(!empty($_GET['lk']) && !empty($_GET['login']) && !empty($_GET['loginfo']))
{
    if($lk == $em)
    {
        
        
        if($for_log[0] == '-')
        {
            $in_buffer += (float)$for_log;
            file_put_contents('value.jk', $in_buffer);
            $for_log = trim($for_log, "-"); file_put_contents('logs/log.mda', "($cur_time) User $login removed $for_log UAH from buffer. Now we have $in_buffer UAH in the buffer." . PHP_EOL, FILE_APPEND);
            echo $in_buffer;
        } 
        
        elseif($for_log == 'get')
        {
            echo $in_buffer;
        }
        
        else {
            $in_buffer += (float)$for_log;
            file_put_contents('value.jk', $in_buffer);
            file_put_contents('logs/log.mda', "($cur_time) User $login added $for_log UAH to buffer. Now we have $in_buffer UAH in the buffer." . PHP_EOL, FILE_APPEND);
            echo $in_buffer;
        }
        
    } else {
        echo "pishov zvidsilya";
    }
} else {
    echo "DENIED.";
}

$new_key = getRandomWord(16);
$new_key_query = "UPDATE secret SET meaning = '$new_key' WHERE meaning = '$SECRET_KEY' AND meaning = '$SECRET_KEY'";
$new_key_result = mysql_query($new_key_query);


?>