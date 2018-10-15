<?php

/**
 * @property string dsn
 */
class database{

    public $dsn;
    public $user;
    public $password;
    public $database;
    public $query;
    public $table;

    /**
     * database constructor.
     */
    public function __construct()
    {
        $this->dsn = 'mysql:dbname=council;host=127.0.0.1;charset=UTF8';
        $this->user = 'root';
        $this->password = '';
    }

    /**
     * @return $this
     */
    public function connect()
    {
        try {
            $this->database = new PDO($this->dsn, $this->user, $this->password);
            return $this;
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    /**
     * @param $table
     * @return $this
     */
    public function select($table){
        $this->sql_query = "SELECT * from $table";
        return $this;
    }

    /**
     * @param $query
     */
    public function where(array $condition)
    {
        $this->sql_query = $this->sql_query.' '.'where '.$condition['state'].' = '.$condition['value'];
        return $this;
    }

    /**
     * @return mixed
     */
    public function get(){

        // option 2 => sans les index
        // option 5 => sans les index + resultat sous form std Object
        $this->query =    $this->database->prepare($this->sql_query);
         $this->query->execute();

        return $this->query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $table
     * @param $data
     */
    public function update($table,$data)
    {
        $this->data = $data;

        $this->sql_query = "update $table SET type=:type WHERE id=:id";

        $this->query =  $this->database->prepare($this->sql_query);

        $state = $this->query->execute($data);

        return $state;
    }

    /**
     * @param $table
     * @param $data
     */
    public function insert($table,$data)
    {
        $this->data = $data;

        $this->sql_query = "INSERT INTO $table (`user_id`,`subject_id`,`subject_type`,`type`,`created_at`,`updated_at`) VALUES(:user_id, :subject_id, :subject_type, :type, :created_at, :updated_at)";

        $this->query =  $this->database->prepare( $this->sql_query);

        $this->query->bindValue(':user_id', $data[':user_id']);
        $this->query->bindValue(':subject_id', $data[':subject_id']);
        $this->query->bindValue(':subject_type', $data[':subject_type']);
        $this->query->bindValue(':type', $data[':type']);
        $this->query->bindValue(':created_at', $data[':created_at']);
        $this->query->bindValue(':updated_at', $data[':updated_at']);

        $state = $this->query->execute($data);

        return $state;
    }

    /**
     * delete row by :id array
     * @param $table
     * @param array $where
     */
    public function delete($table,array $id)
    {
        $this->sql_query = "DELETE from $table WHERE id = :id";
        $stm = $this->database->prepare($this->sql_query);

        $stm->bindParam(':id',$id[':id'],PDO::PARAM_STR);
        $state = $stm->execute();

        return $state;
    }
}
