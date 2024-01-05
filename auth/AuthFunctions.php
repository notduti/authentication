<?php

    include_once __DIR__ . "/../dao/loginDAO.php";

    function createToken(User $user) : String {

        do{
            $token = substr(md5(rand()), 0);

        } while(isTokenNew($token));
        
        $validFrom = time();
        $expire = $validFrom + (60 * 30);
        
        //Caricarli sul db (abbiamo tutti i parametri, fare le set)

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

        setCookie($token);
    }

    function invalidUser() {

        echo("<p style='color:red'>invalid user</p>");
        //usare jquery per cambiare lo sfondo
    }

    function isValid(User $user, ?String $username, ?String $password) {

        $cryptedPassword = crypt($password, $user->getSalt());

        if((strcmp($user->getUserId(), $username) == 0) && 
            (strcmp($cryptedPassword, $user->getHashedPassword()) == 0)) 
            return true;

        else return false;
    }

    function createSalt(): String {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

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

?>