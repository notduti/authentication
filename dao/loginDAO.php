<?php

include_once __DIR__ . "/../auth/loginModel.php";
include_once "DAO.php";

class LoginDAO extends DAO {
    
    public static function insert(User $user) : int {
        
        try {

            DAO::connect();
            
            $sql = "INSERT INTO loginUser VALUES('" . 
                $user->getUserId() . "', '" . $user->getHashedPassword() . 
                "', '" . $user->getSalt() . "', '" . $user->getToken() .
                "', " . $user->getExpire() . ", " . $user->getValidFrom() . ");";
            $rc = DAO::$connection->exec($sql);

            $lastId = DAO::$connection->lastInsertId();

            return $lastId;
        }
        catch(PDOExcepion $e) {

            $e->getMessage();
            return -1;
        }
    }

    public static function readAll(): ?array {

        DAO::connect();

        $users = array();

        try {

            $sql = "SELECT * FROM loginUser;";
            $result = DAO::$connection->query($sql);
            $rows = $result->fetchAll();

            foreach($rows as $row) {

                $users[] = new User($row["userId"], $row["hashedPassword"],
                    $row["salt"], $row["token"], $row["expire"], $row["validFrom"]);
            }
        }
        catch(PDOExcepion $e) {

            $e->getMessage();
            return null;
        }

        return $users;
    }

    public static function readByUsername(?String $userId): ?User {

        DAO::connect();

        $user = null;

        try {

            $sql = "SELECT * FROM loginUser WHERE userId = '" . $userId . "';";
            $result = DAO::$connection->query($sql);
            
            $row = $result->fetch();
            if(empty($row)) return null;

            $user = new User($row["userId"], $row["hashedPassword"],
                $row["salt"], $row["token"], (int) $row["expire"], (int) $row["validFrom"]);
            
        }
        catch(PDOExcepion $e) {

            $e->getMessage();
            return null;
        }

        return $user;
    }

    public static function readByToken(?String $token): ?User {

        DAO::connect();

        $user = null;

        try {

            $sql = "SELECT * FROM loginUser WHERE token = '" . $token . "';";
            $result = DAO::$connection->query($sql);

            $row = $result->fetch(PDO::FETCH_ASSOC);
            if(empty($row)) return null;

            $user = new User($row["userId"], $row["hashedPassword"],
                $row["salt"], $row["token"], (int) $row["expire"], (int) $row["validFrom"]);
        }
        catch(PDOExcepion $e) {

            $e->getMessage();
            return null;
        }

        return $user;
    }

    public static function read(User $user): ?User {

        DAO::connect();

        $retUser = null;

        try {

            $sql = "SELECT * FROM loginUser WHERE userId = " . $user->getUserId() . ";";
            $result = DAO::$connection->query($sql);
            //if($result == false) return null;
            $row = $result->fetch();

            $retUser = new User($row["userId"], $row["hashedPassword"],
                $row["salt"], $row["token"], $row["expire"], $row["validFrom"]);
        }
        catch(PDOExcepion $e) {
            $e->getMessage();
            return null;
        }

        return $retUser;
    }

    public static function delete(User $user) : bool {

        DAO::connect();
        
        try {

            $sql = "DELETE FROM loginUser WHERE userId = " . $user->getUserId() . ";";
            $rc = DAO::$connection->exec($sql);

            if($rc != 1) return true;
        }
        catch(PDOExcepion $e) {
            $e->getMessage();
            return true;
        }

        return false;
    }

    public static function update(User $user) : bool {

        DAO::connect();
        
        try {

            $sql = "UPDATE loginUser SET 
                hashedPassword = '" . $user->getHashedPassword() . 
                "', salt = '" . $user->getSalt() .
                "', token = '" . $user->getToken() . 
                "', expire = " . $user->getExpire() .
                ", validFrom = " . $user->getValidFrom() .
                " WHERE userId = '" . $user->getUserId() . "';";

            $rc = DAO::$connection->exec($sql);

            if($rc != 1) return true;
        }
        catch(PDOExcepion $e) {
            $e->getMessage();
            return true;
        }

        return false;
    }

    public static function updateToken(User $user) : bool {

        DAO::connect();
        
        try {

            $sql = "UPDATE loginUser SET 
                salt = '" . $user->getSalt() .
                "', token = '" . $user->getToken() . 
                "', expire = " . $user->getExpire() .
                ", validFrom = " . $user->getValidFrom() .
                " WHERE userId = '" . $user->getUserId() . "';";

            $rc = DAO::$connection->exec($sql);

            if($rc != 1) return true;
        }
        catch(PDOExcepion $e) {
            $e->getMessage();
            return true;
        }

        return false;
    }
}

?>