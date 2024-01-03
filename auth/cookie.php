<?php

function readCookie() {

    $token = $_COOKIE['token'];
    $user = $UserDAO::readByToken($token);
    if($user->getExpire() > time() && $user->getValidFrom() < time())
        echo("session expired");
}

?>