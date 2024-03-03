<?php 

class DB_connection
{
    private $host = 'localhost';
    private $user = "postgres";
    private $password = "postgres";
    private $dbname = "postgres";
    private $port = 5432;

    public $conn;
    
    public function get_session()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "pgsql:host=".$this->host." port=".$this->port." dbname=".$this->dbname, $this->user, $this->password, );
            $this->conn->exec("set names 'utf8'");
        } catch(PDOException $e) {
            echo 'Ошибка в полючении к бд '.$e->getMessage();
        }
        return $this->conn;
    }
}