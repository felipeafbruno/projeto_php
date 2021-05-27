// UTILIZADO A FUNÇÃO deleteRegister NA PROPRIEDADE ONCLICK DO BOTÃO DE DELETE
// NA TABELA PASSADANDO ACTION O IDPROD E O IDPRECO DOS RESPECTIVAS LINHAS
// E POR FIM FAÇO A CHAMADA AJAX PARA EXECUTAR A ACTION PHP delete_prod E APRESENTO UM ALERT() DE CONFIRMAÇÃO
function deleteRegister($action, id_prod, id_preco) {
    $.ajax({
        type: 'POST',
        url: $action,
        data: { IDPROD: id_prod, IDPRECO: id_preco },
        success: function() {
            alert('Dados Excluídos');
            location.reload();
        }
    })
}