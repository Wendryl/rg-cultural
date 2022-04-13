$('#form-contato').submit(function(){
    var nome = $('nome');
    var erro = $('.alert');

    if(nome.val() == ''){
        erro.removeClass('d-none');

        return false;
    }

    // Vai ficar aqui por enquanto
    return false;
});