<?php


class DBConnect
{
    
    protected $dbh;
    private $db_host = '127.0.0.1';
    private $db_name = 'workshop';
    private $db_user = 'root';
    private $db_password = '';

    public function getDbh(){
       
        $dsn = 'mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8';
        try{
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_password);
        }catch(PDOException $e){
            die("データベース接続エラーです".$e->getMessage());
        }
    }
}



