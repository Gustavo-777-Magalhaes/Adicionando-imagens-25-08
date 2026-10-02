<?php

class Produto {
    private $pdo;

    public function conecta() {
        $dns = "mysql:dbname=loja_etim;host=localhost";
        $user = "root";
        $pass = "";

        try {
            $this->pdo = new PDO($dns, $user, $pass);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function enviarProduto($nome, $descricao, $valor, $fotos = array()) {
        $sql = "INSERT INTO produtos SET nome_produto = :n, descricao = :d, valor = :v";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":d", $descricao);
        $sql->bindValue(":v", $valor);
        
        $isOk = $sql->execute();

        if ($isOk) {
            $id_produto = $this->pdo->lastInsertId();

            if (count($fotos) > 0) {
                for ($i = 0; $i < count($fotos); $i++) {
                    $nome_foto = $fotos[$i];

                    $sqlImg = "INSERT INTO imagens (nome_imagem, fk_id_produto) VALUES (:n, :fk)";
                    $sqlImg = $this->pdo->prepare($sqlImg);
                    $sqlImg->bindValue(":n", $nome_foto);
                    $sqlImg->bindValue(":fk", $id_produto);
                    $sqlImg->execute();
                }
            }
            return true;
        }
        return false;
    }

    // Busca todos os produtos com a primeira imagem como capa
    public function buscarProdutos() {
        $array = array();
        $sql = "SELECT p.*, (SELECT nome_imagem FROM imagens WHERE fk_id_produto = p.id_produto LIMIT 1) as foto_capa FROM produtos p";
        $sql = $this->pdo->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    // Busca os dados de um único produto pelo ID
    public function buscarProduto($id_produto) {
        $array = array();
        $sql = "SELECT * FROM produtos WHERE id_produto = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id_produto);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    // Busca todas as imagens associadas a um produto
    public function buscarImagens($id_produto) {
        $array = array();
        $sql = "SELECT * FROM imagens WHERE fk_id_produto = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id_produto);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }
}
?>