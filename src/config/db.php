<?php
class db{
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    private $dbname = 'servissistem';

    public function connect(){
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str,$this->dbuser,$this->dbpass);
        $dbConnection->exec("set names utf8");

        return $dbConnection;
    }
}
