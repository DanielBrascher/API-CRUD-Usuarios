# API-CRUD-Usuarios

Este projeto é do Desafio ForgeChat - Backend
Com o objetivo de desenvolver uma API de cadastro simples e integrar com uma API externa de CEP


Para o desenvolvimento da aplicação, utilizei:
- PHP
- MySQL
- XAMPP (Para rodar o servidor do php e MySQL)
- Postman (para testar as requisições)

Como rodar o projeto
1. Clone o repositório
   ```
   git clone https://github.com/DanielBrascher/API-CRUD-Usuarios.git
   ```
   
2. Coloque a pasta "apicrud" dentro do "htdocs" do XAMPP
3. Crie o banco de dados no MySQL
```   
  CREATE DATABASE apicrud;
  USE apicrud;

  CREATE TABLE users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(100) NOT NULL,
      email VARCHAR(100) NOT NULL,
      cep VARCHAR(10) NOT NULL,
      logradouro VARCHAR(150),
      bairro VARCHAR(100),
      localidade VARCHAR(100),
      uf VARCHAR(2)
  );
```
4. Inicie o Apache e o MySQL no XAMPP.
5. Acesse a API no navegador ou Postman
   http://localhost/apicrud/public

Endpoints
  POST /users (criar usuário)
  GET /users/id (buscar usuário por ID)//esse id pode ser qualquer id de um usuario cadastrado
  GET /users (listar usuários)
  PUT /users/id (atualizar usuário) 
  DELETE /users/id (deletar usuário)

Exemplos no Postman

  Criar um usuário (POST /users)
  URL 
  http://localhost/apicrud/public/users

  Body 
  ```
  {
  "name": "João Silva",
  "email": "joao@email.com",
  "cep": "01001000"
  }
   ```

  Resposta
  ```
  {
  "id": 1,
  "name": "João Silva",
  "email": "joao@email.com",
  "cep": "01001000",
  "logradouro": "Praça da Sé",
  "bairro": "Sé",
  "localidade": "São Paulo",
  "uf": "SP"
  }
   ```

  Buscar usuário por ID (GET /users/id)
  URL 
  http://localhost/apicrud/public/users/2

  Resposta
  ```
  {
  "id": 2,
  "name": "Daniel Brascher",
  "email": "daniel@email.com",
  "cep": "26520150",
  "logradouro": "Rua Augusto da Silva",
  "bairro": "Centro",
  "localidade": "Nilópolis",
  "uf": "RJ"
  }
   ```

  Listar usuários (GET /users)
  URL
  http://localhost/apicrud/public/users

  Resposta
  ```
  [
    {
        "id": 1,
        "name": "João Silva",
        "email": "joao@email.com",
        "cep": "01001000",
        "logradouro": "Praça da Sé",
        "bairro": "Sé",
        "localidade": "São Paulo",
        "uf": "SP"
    },
    {
        "id": 2,
        "name": "Daniel Brascher",
        "email": "daniel@email.com",
        "cep": "26520150",
        "logradouro": "Rua Augusto da Silva",
        "bairro": "Centro",
        "localidade": "Nilópolis",
        "uf": "RJ"
    }
  ]
  ```

  Atualizar usuário (PUT /users/id)
  URL
  http://localhost/apicrud/public/users/2

  Body
  ```
  {
    "name": "Daniel do Amaral",
    "email": "amaral@gmail.com",
    "cep": "01001000"
  }
   ```

  Resposta
   ```
  {
    "id": 2,
    "name": "Daniel do Amaral",
    "email": "amaral@gmail.com",
    "cep": "01001000",
    "logradouro": "Praça da Sé",
    "bairro": "Sé",
    "localidade": "São Paulo",
    "uf": "SP"
  }
   ```

  Deletar usuário (DELETE /users/id)
  URL
  http://localhost/apicrud/public/users/2

  Resposta
  ```
  {
    "message": "Usuario removido"
  }
   ```










