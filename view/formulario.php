<?php
include("../action/list_prod.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <title>Formulário</title>
    <link rel="stylesheet" type="text/css" href="../css/formulario.css">
    <link rel="stylesheet" type="text/css" href="../css/tabela.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/delete.js"></script>
    <script src="../js/add.js"></script>
    <script src="../js/update.js"></script>
</head>

<body>
    <table class="table">
        <tr>
            <th>NOME</th>
            <th>COR</th>
            <th>PREÇO</th>
            <th>AÇÕES</th>
        </tr>
        <?php
        $action = "../action/delete_prod.php";
        while ($prod = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $prod["NOME"] . "</td>";
            echo "<td>" . $prod["COR"] . "</td>";
            echo "<td>R$ " . number_format($prod["PRECO"], 2) . "</td>";
            echo '<td>';
            echo '<button onclick="deleteRegister(' . "'" . $action . "'" . ',' . $prod['IDPROD'] . ',' . $prod['IDPRECO'] . ')" class="btn_delete">EXCLUSÃO</button>';
            echo '<button onclick="updateRegister(' . $prod['IDPROD'] . ',' . $prod['IDPRECO'] . ')" class="btn_update">ATUALIZAÇÃO</button>';
            echo '</td>';
            echo "</tr>";
        }
        ?>
    </table>

    <div class="formulario">
        <form action="../action/save_prod.php" method="post" id="form">
            <input type="hidden" name="id_produto" id="id_prod">
            <div class="item_form">
                <label class="label">Produto:</label>
                <input class="" type="text" name="produto" id="produto">
            </div>

            <input type="hidden" name="id_preco" id="id_preco">
            <div class="item_form">
                <label class="label">Preço:</label>
                <input type="number" step="0.01" name="preco" id="preco">
            </div>

            <div class="item_form">
                <label class="label">Cor:</label>
                <input type="text" name="cor" id="cor">
            </div>

            <button class="button_save" type="submit">Inserção</button>
        </form>
    </div>
</body>

</html>