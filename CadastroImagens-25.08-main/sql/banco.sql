CREATE DATABASE IF NOT EXISTS loja_etim;
USE loja_etim;

CREATE TABLE IF NOT EXISTS produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(100),
    descricao TEXT,
    valor DECIMAL(10,2)
);

CREATE TABLE IF NOT EXISTS imagens (
    id_imagem INT AUTO_INCREMENT PRIMARY KEY,
    nome_imagem VARCHAR(100),
    fk_id_produto INT,
    FOREIGN KEY (fk_id_produto) REFERENCES produtos(id_produto)
);