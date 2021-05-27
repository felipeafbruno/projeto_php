<?php
include('conn_factory.php');

$id_prod = 0;
$id_preco = 0;
// VERIFICANDO SE EXISTE A VARIÁVEL POST CASO EXISTE VERIFICO SE CONTÉM AS 
// CHAVES IDPROD, IDPRECO PARA UTILIZAR OS VALORES VINDOS NO DELETE 
if (isset($_POST["IDPROD"])) {
    $id_prod = $_POST["IDPROD"];
}
if (isset($_POST["IDPRECO"])) {
    $id_preco = $_POST["IDPRECO"];
}

// QUERY DELETE NA TABELA PRODUTOS COM BASE NO ID
$delete_prod = "DELETE FROM produtos WHERE IDPROD = :IDPROD";
$result_prod = $conn->prepare($delete_prod);
$result_prod->bindParam(":IDPROD", $id_prod, PDO::PARAM_INT);
$result_prod->execute();

// QUERY DELETE NA TABELA PRECO COM BASE NO ID
$delete_preco = "DELETE FROM preco WHERE IDPRECO = :IDPRECO";
$result_preco = $conn->prepare($delete_preco);
$result_preco->bindParam(":IDPRECO", $id_preco, PDO::PARAM_INT);
$result_preco->execute();
