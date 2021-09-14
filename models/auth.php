<?php


function makeAuthhorization($login, $password)
{

    $sql = 'INSERT INTO `users` (`login`,`password`)VALUES(:login,:password) ';
    $resFromDB= setDbQuery($sql, ['login' => $login, 'password' => $password ,]);
    return $resFromDB ;
}
function auth($login)
{
        $sql = 'SELECT * FROM `users` WHERE login = :login ';
        $query=getDbQuery($sql,['login'=>$login,]);
        $user =  $query->fetch();
        return $user;
}

function  takePassword($login)
{
        $sql = 'SELECT `password` FROM `users` WHERE login = :login  ';
        $query=getDbQuery($sql,['login'=>$login]);
        $user =  $query->fetch();
        return $user;
}



















