<?php 
class Database{
    private $host = "localhost";
    private $dbname = "apicrud";
    private $username = "root";
    private $pass = "";
    private $conn;

    public function getConnection(){
        if($this->conn == null){
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname,$this->username,$this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                die("erro na conexão: ". $e->getMessage());
            }
        }
        return $this->conn;
    }
}
?>