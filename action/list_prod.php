<?php
include('conn_factory.php');

// SELECT NA TABELA PRODUTOS
$query = "SELECT produtos.IDPROD, produtos.NOME, produtos.COR, preco.IDPRECO, preco.PRECO
          FROM produtos produtos 
          INNER JOIN preco preco ON produtos.IDPROD = preco.IDPRECO";
$result = $conn->query($query);
$result->execute();
