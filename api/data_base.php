<?php 

class DB_connection
{
    private $host = 'localhost';
    private $user = "postgres";
    private $password = 'postgres';
    private $database = "test_db";

    public $con = null;
    
    public function get_session()
    {
        try {
            $this->con = new PDO(
                'postgres:host='.$this->host.';dbname='.$this->database.''.$this->user.''.$this->password
            );
            $this->con->exec('set names utg8');
        } catch(PDOException $e) {
            echo 'some shit happend'.$e->getMessage();
        }
        return $this->con;
    }
}