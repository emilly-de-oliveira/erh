<?php

class EX {
    private $host = "localhost";
    private $exname = "ex_aula";
    private $port = 3306;
    private $musica = "root";
    private $ex_charset = "utf8";


    public function conn(){
        $conn = "mysql:host=$this->host;exname=$this->exname;port=$this->port";

        return new PDO(
            $conn,
            $this->musica,

            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ". $this->ex_charset]
        );
    }

    public function inserir($dados){
        $conn = $this->conn();
        $sql = "INSERT INTO musica (nome, cantor, data) VALUES (?, ?, ?);";
        $st = $conn->prepare($sql);
        $st->execute([$dados['nome'], $dados['cantor'],$dados['data']]);
    }

    public function atualizar($dados){

        $id = $dados['id'];
        $conn = $this->conn();
        $sql = "UPDATE musica SET nome=?, cantor=?, data=? WHERE id = $id ";
        $st = $conn->prepare($sql);
        $st->execute([$dados['nome'], $dados['cantor'],$dados['data']]);
    }

    public function select(){
        $conn = $this->conn();
        $sql = "SELECT * FROM musica;";
        $st = $conn->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function buscar($id){
        $conn = $this->conn();
        $sql = "SELECT * FROM musica WHERE id=?;";
        $st = $conn->prepare($sql);
        $st->execute([$id]);

        return $st->fetchObject();
    }

    public function deletar($id){
        $conn = $this->conn();
        $sql = "DELETE FROM musica

WHERE id = ?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }
}
