<?php

/**
 * @property string dsn
 */
class database{

    public $dsn;
    public $user;
    public $password;

    public $database;

    public function __construct()
    {
        $this->dsn = 'mysql:dbname=ask;host=127.0.0.1';
        $this->user = 'root';
        $this->password = '';
    }

    public function connec()
    {
        try {

            return $this->database = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    public function select($table){
        $sql = "SELECT * from $table";
        $res = $this->database->runSelectQuery($sql);
        return $res;
    }
}
