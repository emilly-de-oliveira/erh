<?php

class EX {
    private $host = "localhost";
    private $xename = "xe_aula";
    private $port = 3306;
    private $usuario = "root";
    private $senha = "";
    private $xe_charset = "utf8";


    public function conn(){
        $conn = "mysql:host=$this->host;xename=$this->xename;port=$this->port";

        return new PDO(
            $conn,
            $this->usuario,
            $this->senha,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ". $this->xe_charset]
        );
    }

    public function inserir($dados){
        $conn = $this->conn();
        $sql = "INSERT INTO usuario (nome, email, telefone) VALUES (?, ?, ?);";
        $st = $conn->prepare($sql);
        $st->execute([$dados['nome'], $dados['email'],$dados['telefone']]);
    }

    public function atualizar($dados){

        $id = $dados['id'];
        $conn = $this->conn();
        $sql = "UPDATE usuario SET nome=?, email=?, telefone=? WHERE id = $id ";
        $st = $conn->prepare($sql);
        $st->execute([$dados['nome'], $dados['email'],$dados['telefone']]);
    }

    public function select(){
        $conn = $this->conn();
        $sql = "SELECT * FROM usuario;";
        $st = $conn->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function buscar($id){
        $conn = $this->conn();
        $sql = "SELECT * FROM usuario WHERE id=?;";
        $st = $conn->prepare($sql);
        $st->execute([$id]);

        return $st->fetchObject();
    }

    public function deletar($id){
        $conn = $this->conn();
        $sql = "DELETE FROM usuario WHERE id = ?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }
}