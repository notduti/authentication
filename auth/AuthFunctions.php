<?php

    include_once __DIR__ . "/../dao/loginDAO.php";

    function createUser(String $username, String $password) : ?User {

        try {

            $user = new User($username, null, null, null, 0, 0);
            $rc = LoginDAO::insert($user);

            $salt = createSalt();

            $crypterdPassword = crypt($password, $salt);

            $user->setSalt($salt);
            $user->setHashedPassword($crypterdPassword);

            LoginDAO::update($user);

            return $user;
        }
        catch(Exception $e) {

            return null;
        }
    }

    function createSalt(): String {

        return substr(md5(rand()), 0, 8);
    }

    function isValid(User $user, ?String $username, ?String $password) {

        $cryptedPassword = crypt($password, $user->getSalt());

        if((strcmp($user->getUserId(), $username) == 0) && 
            (strcmp($cryptedPassword, $user->getHashedPassword()) == 0)) 
            return true;

        else return false;
    }

    function invalidUser() {

        echo("<p style='color:red'>invalid user</p>");
    }

?>