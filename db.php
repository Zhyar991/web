<?php

class Db
{
    private $host = "fdb23.awardspace.net";
    private $user = "3420813_webproject";
    private $password = "QIUweb88";
    private $dbname = "3420813_webproject";


    public function connect()
    {
        $mysql_connect = "mysql:host=$this->host;port=3306;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect, $this->user, $this->password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbConnection;
    }
}


?>
