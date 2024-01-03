<?php

abstract class DAO {

    protected static ?PDO $connection = null;
    private static string $URL_DB = "sqlite:odbc:appl";

    public static function connect() : void {
        
        if(DAO::$connection == null) {

            try {
                DAO::$connection = new PDO("sqlite:" . __DIR__ ."/appl");
                DAO::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOExcepion $e) {
                $e->getMessage();
            }
        }
    }

    /*
    public abstract static function insert(Object $obj) : int;
    public abstract static function readAll(): ?array;
    public abstract static function read(int $id): ?Object;
    public abstract static function delete(Object $obj) : bool;
    public abstract static function update(Object $obj) : bool;
    */
}

?>