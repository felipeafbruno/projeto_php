<?php
include('conn_factory.php');

$produto = "";
$preco = 0;
$cor = "";
// VERIFICANDO SE EXISTE A VARIAVEL POST CASO EXISTE VERIFICA SE CONTEM AS VALORES 
// CHAVES produto, preco E cor PARA POPULAR AS RESPECTIVAS TABELAS PRODUTOS E PRECO 
if (isset($_POST)) {
    $produto = $_POST["produto"];
    $cor = isset($_POST["cor"]) ? $_POST["cor"] : "";
    $preco = $_POST["preco"];
}


if ($_POST["id_produto"] == ""   && $_POST["id_preco"] == "") {
    // QUERY DE INSERÇÃO PARA PRODUTOS
    $query_prod = "INSERT INTO produtos (NOME, COR) VALUES (:NOME, :COR)";
    $result_prod = $conn->prepare($query_prod);
    $result_prod->bindParam(':NOME', $produto);
    $result_prod->bindParam(':COR', $cor);
    $result_prod->execute();

    // PRECO CALCULADO APARTIR DA REGRA DE NEGÓCIO DOS PRECOS
    $precoCalculado = precoCalculado($cor, $preco);

    // QUERY DE INSERÇÃO PARA PRECO
    $query_preco = "INSERT INTO preco (PRECO) VALUES (:PRECO)";
    $result_preco = $conn->prepare($query_preco);
    $result_preco->bindParam(':PRECO', $precoCalculado);
    $result_preco->execute();
} else {

    // COMO COLOQUEI O DESABLED NO HTML DO INPUT DA COR ENTÃO É NECESSÁRIO BUSCAR 
    // O VALOR NOVAMENTE NO BANCO PARA APLICAR A REGRA DE NEGÓCIO
    $prod_cor = "SELECT COR FROM produtos WHERE IDPROD = :IDPROD";
    $result_prod_cor = $conn->prepare($prod_cor);
    $result_prod_cor->bindParam(":IDPROD", $id_prod);
    $result_prod_cor->execute();
    $response = $result_prod_cor->fetch(PDO::FETCH_ASSOC);
    $cor = $response["COR"];

    $id_prod = $_POST["id_produto"];
    $id_preco = $_POST["id_preco"];

    $precoCalculado = precoCalculado($cor, $preco);

    // QUERY DE ATUALIZAÇÃO PARA PRODUTOS
    $update_prod = "UPDATE produtos SET NOME = :NOME WHERE IDPROD = :IDPROD";
    $result_prod = $conn->prepare($update_prod);
    $result_prod->execute(array(
        ":NOME" => $produto,
        "IDPROD" => $id_prod
    ));


    // QUERY DE ATUALIZAÇÃO PARA PRECO
    $update_preco = "UPDATE preco SET PRECO = :PRECO WHERE IDPRECO = :IDPRECO";
    $result_preco = $conn->prepare($update_preco);
    $result_preco->execute(array(
        ':PRECO' => $precoCalculado,
        ':IDPRECO' => $id_preco
    ));
}

function precoCalculado($cor, $preco)
{
    $precoCalculado = 0.0;
    // REGRA DE NEGÓCIO ONDE APLICO OS DESCONTOS COM BASE NAS CORES E O VALOR DO PRODUTO
    /**
     * AZUL OU VERMELHO 20%/0.2
     * AMARELO 10%/0.1
     * VERMELHO E COM VALOR ACIMA DE 50.00 5%/O.5
     */
    if ($cor == "AZUL" || $cor == "VERMELHO") {
        $precoCalculado = floatval($preco) - (floatval($preco) * 0.2);
    } else if ($cor == "AMARELO") {
        $precoCalculado = floatval($preco) - (floatval($preco) * 0.1);
    } else if ($cor == "VERMELHA" && floatval($preco)  > 50) {
        $precoCalculado = floatval($preco) - (floatval($preco) * 0.1);
    } else {
        $precoCalculado = floatval($preco);
    }

    return $precoCalculado;
}
