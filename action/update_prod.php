<?php
include('conn_factory.php');

$produto = "";
$preco = 0;
$cor = "";
// VERIFICANDO SE EXISTE A VARIAVEL POST CASO EXISTE VERIFICA SE CONTEM AS VALORES 
// CHAVES produto, preco E cor PARA POPULAR AS RESPECTIVAS TABELAS PRODUTOS E PRECO 
if (isset($_POST)) {
    $produto = $_POST["produto"];
    $cor = $_POST["cor"];
    $preco = $_POST["preco"];
}


if (!isset($_POST["id_prod"]) && !isset($_POST["id_preco"])) {
    // QUERY DE INSERÇÃO PARA PRODUTOS
    $query_prod = "INSERT INTO produtos (NOME, COR) VALUES (:NOME, :COR)";
    $result_prod = $conn->prepare($query_prod);
    $result_prod->bindParam(':NOME', $produto);
    $result_prod->bindParam(':COR', $cor);
    $result_prod->execute();

    // REGRA DE NEGÓCIO ONDE APLICO OS DESCONTOS COM BASE NAS CORES E O VALOR DO PRODUTO
    /**
     * AZUL OU VERMELHO 20%/0.2
     * AMARELO 10%/0.1
     * VERMELHO E COM VALOR ACIMA DE 50.00 5%/O.5
     */
    if ($cor == "AZUL" || $cor == "VERMELHO") {
        $preco_calculado = floatval($preco) - (floatval($preco) * 0.2);
    } else if ($cor == "AMARELO") {
        $preco_calculado = floatval($preco) - (floatval($preco) * 0.1);
    } else if ($cor == "VERMELHA" && floatval($preco)  > 50) {
        $preco_calculado = floatval($preco) - (floatval($preco) * 0.1);
    }

    // QUERY DE INSERÇÃO PARA PRECO
    $query_preco = "INSERT INTO preco (PRECO) VALUES (:PRECO)";
    $result_preco = $conn->prepare($query_preco);
    $result_preco->bindParam(':PRECO', $preco_calculado);
    $result_preco->execute();
} else {

    $id_prod = $_POST["id_prod"];
    $id_preco = $_POST["id_preco"];

    // QUERY DE ATUALIZAÇÃO PARA PRODUTOS
    $update_prod = "UPDATE produtos SET NOME = :NOME WHERE IDPROD = :IDPROD";
    $result_prod = $conn->prepare($update_prod);
    $result_prod->bindParam(':NOME', $produto);
    $result_prod->bindParam(':IDPROD', $id_prod);
    $result_prod->execute();

    // REGRA DE NEGÓCIO ONDE APLICO OS DESCONTOS COM BASE NAS CORES E O VALOR DO PRODUTO
    /**
     * AZUL OU VERMELHO 20%/0.2
     * AMARELO 10%/0.1
     * VERMELHO E COM VALOR ACIMA DE 50.00 5%/O.5
     */
    if ($cor == "AZUL" || $cor == "VERMELHO") {
        $preco_calculado = floatval($preco) - (floatval($preco) * 0.2);
    } else if ($cor == "AMARELO") {
        $preco_calculado = floatval($preco) - (floatval($preco) * 0.1);
    } else if ($cor == "VERMELHA" && floatval($preco)  > 50) {
        $preco_calculado = floatval($preco) - (floatval($preco) * 0.1);
    }

    // QUERY DE ATUALIZAÇÃO PARA PRECO
    $update_preco = "UPDATE preco SET PRECO = :PRECO WHERE IDPRECO = :IDPRECO";
    $result_preco = $conn->prepare($update_preco);
    $result_preco->bindParam(':PRECO', $preco_calculado);
    $result_preco->execute();
}
