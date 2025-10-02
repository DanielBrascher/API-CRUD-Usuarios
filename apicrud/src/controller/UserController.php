<?php 
require_once __DIR__ . "/../model/User.php";

class UserController{
    private function json($data, $status = 200){
        http_response_code($status);
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }

    public function createUser(){
        $input = json_decode(file_get_contents("php://input"), true);
        if(!isset($input['name'], $input['email'], $input['cep'])){
            return $this->json(["error" => "Campos obrigatorios nao preenchidos"], 400);
        }

        $cep = preg_replace('/[^0-9]/', '', $input['cep']);
        $cepData = json_decode(file_get_contents("https://viacep.com.br/ws/{$cep}/json/"), true);
        if (isset($cepData['erro'])){
            return $this->json(["error" => "CEP invalido"], 400);
        }

        $user = new User();
        $id = $user->create([
            ":name" => $input['name'],
            ":email" => $input['email'],
            ":cep" => $cep,
            ":logradouro" =>$cepData['logradouro'],
            ":bairro" => $cepData['bairro'],
            ":localidade" => $cepData['localidade'],
            ":uf" => $cepData['uf']
        ]);

        if ($id) {
            $createdUser = $user->findById($id);
            return $this->json($createdUser, 201);
        } else {
            return $this->json(["error" => "Erro ao criar usuario"], 500);
        }
    }

    public function getUser($id){
        $user = new User();
        $data = $user->findById($id);
        $data ? $this->json($data) : $this->json(["error" => "Usuario nao encontrado"], 404);
    }

    public function listUsers(){
        $user = new User();
        $data = $user->findAll();
        $this->json($data);
    }

    public function updateUser($id){
        $input = json_decode(file_get_contents("php://input"), true);
        if (!isset($input['name'], $input['email'], $input['cep'])) {
            return $this->json(["error" => "Campos obrigatorios: name, email, cep"], 400);
        }

        $cep = preg_replace('/[^0-9]/', '', $input['cep']);
        $cepData = json_decode(file_get_contents("https://viacep.com.br/ws/{$cep}/json/"), true);
        if (isset($cepData['erro'])) {
            return $this->json(["error" => "CEP invalido"], 400);
        }

        $user = new User();
        $success = $user->updateById($id, [
            ":name" => $input['name'],
            ":email" => $input['email'],
            ":cep" => $cep,
            ":logradouro" => $cepData['logradouro'],
            ":bairro" => $cepData['bairro'],
            ":localidade" => $cepData['localidade'],
            ":uf" => $cepData['uf']
        ]);

        if ($success) {
            $updatedUser = $user->findById($id);
            return $this->json($updatedUser, 200);
        }
        else {
            return $this->json(["error" => "Erro ao atualizar usuario"], 500);
        }
        
    }

    public function deleteUser($id) {
        $user = new User();
        $success = $user->deleteById($id);
        $success ? $this->json(["message" => "Usuario removido"]) : $this->json(["error" => "Erro ao remover usuario"], 500);
    }
}
?>