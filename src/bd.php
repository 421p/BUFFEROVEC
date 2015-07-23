<?php

$kek = md5(sha1('kek'));

function baza_connect($domain, $db_name, $db_user, $db_pass, $db_loc, $db_port)
{
   
    
    $db = @mysql_connect($db_loc, $db_user, $db_pass);
    if(!$db) 
    {
        printf("ne rabotaet");
        exit();
    }
    
    if(!@mysql_select_db($db_name,$db)) 
    {
        printf("baza ne dostupna");
        exit();
    }
    
    //printf("> BD connected.");
    
    mysql_query('SET NAMES utf8');
}

baza_connect(getenv('IP'), 'buffer_works', getenv('C9_USER'), '', '127.0.0.1', 3306);