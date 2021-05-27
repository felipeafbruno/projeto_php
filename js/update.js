function updateRegister(id_prod, id_preco) {
    $.ajax({
        type: 'get',
        url: '../action/search_prod.php',
        dataType: 'json',
        data: { IDPROD: id_prod, IDPRECO: id_preco },
        success: function(response) {
            let id_prod = response.IDPROD;
            let nome_prod = response.NOME;
            let cor_prod = response.COR;
            let id_preco = response.IDPRECO;
            let preco = response.PRECO;

            $("#id_prod").val(id_prod);
            $("#produto").val(nome_prod);
            $("#id_preco").val(id_preco);
            $("#preco").val(preco);
            $("#cor").val(cor_prod)
            $("#cor").attr("disabled", "disabled");
        }
    })
}