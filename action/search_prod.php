<?php
include('conn_factory.php');

$id_prod = 0;
$id_preco = 0;
if (isset($_GET)) {
    $id_prod = $_GET["IDPROD"];
    $id_preco = $_GET["IDPRECO"];
}

// SELECT NA TABELA PRODUTOS
$query = "SELECT produtos.IDPROD, produtos.NOME, produtos.COR, preco.IDPRECO, preco.PRECO
          FROM produtos produtos 
          INNER JOIN preco preco ON produtos.IDPROD = preco.IDPRECO
          WHERE IDPROD=" . $id_prod . " AND IDPRECO =" . $id_preco;
$result = $conn->query($query);
$result->execute();

echo json_encode($result->fetch(PDO::FETCH_ASSOC));
