<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="produtos.css">
</head>
<body>
    <section>
        <?php
        require_once 'classes/Produto.class.php';
        $produto = new Produto();
        $produto->conecta();
        $dadosProduto = $produto->buscarProdutos();
        
        if (empty($dadosProduto)) {
            echo "<p>Ainda não há produtos cadastrados aqui!</p>";
        } else {
            foreach ($dadosProduto as $value) {
                ?>
                <a href="exibir_produto.php?id=<?php echo $value['id_produto']; ?>">
                    <div>
                        <img src="imagens/<?php echo !empty($value['foto_capa']) ? $value['foto_capa'] : 'padrao.png'; ?>">
                        <h2><?php echo $value['nome_produto']; ?></h2>
                    </div>
                </a>
                <?php
            }
        }
        ?>
    </section>
</body>
</html>