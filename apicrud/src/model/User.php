<?php 
require_once __DIR__ . "/../config/Database.php";

class User{
    private $conn;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($data){
        $sql = "INSERT INTO users (name, email, cep, logradouro, bairro, localidade, uf) VALUES (:name, :email, :cep, :logradouro, :bairro, :localidade, :uf)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute($data)) {
            return $this->conn->lastInsertId();
        }
        return false;

    }

    public function findById($id){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([":id" =>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll(){
        $stmt = $this->conn->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateById($id, $data){
        $sql = "UPDATE users SET name = :name, email = :email, cep = :cep, logradouro = :logradouro, bairro = :bairro, localidade = :localidade, uf = :uf WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(array_merge($data, [":id" => $id]));
    }

    public function deleteById($id){
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(["id" => $id]);
    }
}
?>
