// UTILIZANDO O AJAX PARA SUBMITER OS DADOS NA BANCO.
// COM O ID FORM DO FORMULÁRIO HTML EXECUTO A FUNÇÃO SUBMIT() DO JQUERY
// PEGO O OBTEJO O FORMULÁRIO POR MEIO DO $(THIS) COM ELE EM MÃOS PEGO A URL NO ATRIBUTO 
// ACTION E METHOD NO ATRIBUTO METHOD E OS DADOS UTILIZANDO SERIALIZE() DO JQUERY
// A URL, METHOD E DATA SÃO ADICIONADOS NA CHAMA AJAX PARA EXECUTAR A ACTION PHP RESPONSÁVEL 
// POR SALVAR OS DADOS E APRESENTO UM ALERT() DE CONFIRMAÇÃO
$(document).ready(function() {
    $('#form').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        let type = form.attr('method');
        let data = form.serialize();

        $.ajax({
            url: url,
            type: type,
            data: data,
            dataType: 'text',
            success: function(response) {
                // console.log(response);
                alert("Dados salvos com sucesso");
                location.reload();
            }
        });
    });
});