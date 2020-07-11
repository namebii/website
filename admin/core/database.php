<?php 
class database
{
    var $pdo, $sql, $statement;
    function __construct(){
        try{
            $this->pdo=new PDO('mysql:host=127.0.0.1;dbname=Database Taki', 'root', '123456789', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $this->pdo->query('set names utf8');
        }catch(PDOException $errors){
            exit('DB Error: '.$errors->getMessage()); // Để về return false;  khi hoàn thành dự án.
        }
    }
    function setquery($sql){
        $this->sql=$sql;
        return $this;
    }
    function loadrow($params=[]){
        try{
            $this->statement=$this->pdo->prepare($this->sql);
            $this->statement->execute($params);
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }catch(PDOException $errors){
            exit('SQL Error: '.$errors->getMessage());
        }
    }
    function loadrows($params=[]){
        try{
            $this->statement=$this->pdo->prepare($this->sql);
            $this->statement->execute($params);
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $errors){
            exit('SQL Error: '.$errors->getMessage());
        }
    }
    function save($params=[]){
        try{
            $this->statement=$this->pdo->prepare($this->sql);
            return $this->statement->execute($params);
        }catch(PDOException $errors){
            exit('SQL Error: '.$errors->getMessage());
        }
    }
    function disconnect(){
        $this->pdo=$this->statement = null;
        $this->sql = '';
    }
}
?>