<?php

class Db
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "showroom";


    public function connect()
    {
        $mysql_connect = "mysql:host=$this->host;port=3307;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect, $this->user, $this->password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbConnection;
    }
}


?>