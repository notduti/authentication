<?php

    include_once __DIR__ . "/../dao/loginDAO.php";

    function readCookie(): bool {

        $token = $_COOKIE['token'];

        $user = LoginDAO::readByToken($token);
        if($user == null) return false;

        if($user->getExpire() > time() && $user->getValidFrom() <= time())
            return true;

        else return false;
    }

    function createToken(User $user) : String {

        do{
            $token = substr(md5(rand()), 0);

        } while(!isTokenNew($token));
        
        $validFrom = time();
        $expire = $validFrom + (60 * 30);
        
        $user->setToken($token);
        $user->setValidFrom($validFrom);
        $user->setExpire($expire);

        LoginDAO::update($user);

        return $token;
    }

    function isTokenNew(?String $token): bool {

        $user = LoginDAO::readByToken($token);
        if($user == null) return true;
        else return false;
    }

    function sendToken(?String $token): void {

        setcookie('token', $token);
    }

?>