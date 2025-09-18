<?php 

namespace database_config;

use PDO;
use PDOException;

class database_config{

    public $host;
    public $username;
    public $password;
    public $database;
    public $pdo;
    public $err;
    
    public function __construct($host,$username,$password,$database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        try{
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->database}",
                $this->username,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            $this->err = "Couldn't connect to database : " . $e->getMessage();
        }

    }

    public function login($username,$password){
        if (!$this->pdo) return false;

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute([
            ":username" => $username,
            ":password" => $password
        ]);

        return $stmt->rowCount() > 0;

    }

}

?>