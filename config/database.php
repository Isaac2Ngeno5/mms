<?php

class Database
{
    /**
     * Make sure you replace with your configuration
     */

    private $host = "127.0.0.1";
    private $db = "mms";
    private $port = "3306";
    private $user = "root";
    private $pass = "";
    private $charset = "utf8";
    private $pdo;

    /**
     * Get a connection to the database
     *
     * @return null|PDO
     */
    public function getConnection()
    {
        $this->pdo = null;

        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db;port=$this->port;charset=$this->charset";
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_PERSISTENT => true
            ];

            $this->pdo = new PDO($dsn, $this->user, $this->pass, $opt);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->pdo;
    }
}
