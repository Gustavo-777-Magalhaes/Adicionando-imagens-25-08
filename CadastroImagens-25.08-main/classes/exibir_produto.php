<?php
require_once 'classes/Produto.class.php';
$produto = new Produto();
$produto->conecta();

$dadosProduto = array();
$dadosImagens = array();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_produto = $_GET['id'];
    $dadosProduto = $produto->buscarProduto($id_produto);
    $dadosImagens = $produto->buscarImagens($id_produto);
} else {
    echo "<script>alert('Faltou o ID do produto!'); history.back();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $dadosProduto['nome_produto']; ?></title>
    <link rel="stylesheet" href="produtos.css">
</head>
<body>
   <section>
        <div>
            <h1><?php echo $dadosProduto['nome_produto']; ?></h1>
            <p><span>Descrição:</span> <?php echo $dadosProduto['descricao']; ?></p>  
            <p><span>Valor:</span> R$ <?php echo number_format($dadosProduto['valor'], 2, ',', '.'); ?></p>  
        </div>

        <?php foreach ($dadosImagens as $dado) { ?>
            <div id="imagens">  
                <img src="imagens/<?php echo $dado['nome_imagem']; ?>">
                <button class="compra verde">Comprar</button>
            </div>
        <?php } ?>
   </section>    
</body>
</html>